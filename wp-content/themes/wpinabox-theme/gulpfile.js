const gulp = require('gulp');
const sass = require('gulp-sass');
const svgo = require('gulp-svgo');
const sourcemaps = require('gulp-sourcemaps');
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');

const browserify = require('browserify');
const uglify = require('gulp-uglify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');

const postcss = require('gulp-postcss');
const cssclean = require('postcss-clean');
const autoprefixer = require('autoprefixer');

const browserSync = require('browser-sync').create();

const src = 'assets/src/';
const dest = 'assets/dist/'

const errorHandler = notify.onError("Error: <%= error.message %>");
const plumb = {
	errorHandler: errorHandler
}


gulp.task('img', function() {

	// svgo options
	const svgOpts = {	
		plugins: [
			{ removeDoctype: true },
			{ removeXMLProcInst: true }
		]
	}

	return gulp.src(src+'img/**')
		.pipe(plumber(plumb))
		.pipe(svgo(svgOpts))
		.pipe(gulp.dest(dest+'img/'))
		.pipe(browserSync.stream())
});

gulp.task('js', function() {

	return browserify(src + 'js/main.js')
		.transform(['babelify'])
		.bundle().on('error', errorHandler)
    .pipe(source('main.js'))
		.pipe(plumber(plumb))
		.pipe(buffer())
		.pipe(sourcemaps.init({loadMaps: true}))
		  .pipe(uglify())
		.pipe(sourcemaps.write('../maps', {
      sourceRoot: '../src/js'
    }))
		.pipe(gulp.dest(dest))
});


// create a task that ensures the `js` task is complete before
// reloading browsers
gulp.task('js-watch', ['js'], function (done) {
    browserSync.reload();
    done();
});

// https://gist.github.com/jdsteinbach/40494937cf6000fe0c9f
gulp.task('sass', function() {
  return gulp.src(src + 'scss/main.scss')
    .pipe(plumber(plumb))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(sourcemaps.write('../maps', {
      includeContent: false,
      sourceRoot: '../src/scss'
    }))
    .pipe(gulp.dest(dest));
});

gulp.task('postcss', function() {
  return gulp.src(dest + 'main.css')
    .pipe(plumber(plumb))
    .pipe(postcss([autoprefixer, cssclean]))
    .pipe(gulp.dest(dest))
});

gulp.task('css', ['sass', 'postcss'], function() {
  return gulp.src(dest + 'main.css')
    .pipe(browserSync.stream({match: '**/*.css'}));
});

gulp.task('fonts', function() {
	return gulp.src(src + 'fonts/Fonts/*')
		.pipe(gulp.dest(dest + 'fonts/Fonts/'))
		.pipe(browserSync.stream())

});

gulp.task('watch', function () {
  browserSync.init({
    files: ['lib/**/*.php', '*.php', 'tpl/**/*.twig'],
    proxy: 'http://assembledbrands.dev',
    snippetOptions: {
      whitelist: ['/wp-admin/admin-ajax.php'],
      blacklist: ['/wp-admin/**']
    },
    logLevel: "debug",
    browser: "google chrome"
	});

  gulp.watch([src + '**/*.scss'], ['css']);
  gulp.watch([src + '**/*.js'], ['js-watch']);
  gulp.watch([src + 'img/**'], ['img']);
  gulp.watch([src + 'fonts/**'], ['fonts']);
});

gulp.task('build', ['css', 'js', 'img', 'fonts']);
gulp.task('dev', ['build', 'watch']);

gulp.task('default', ['build']);