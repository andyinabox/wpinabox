<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();

// page
if(is_page()) {
  $context['post'] = new WPB\Page();
  $templates = array( 'page.twig' );
// single post
} else if (is_single()) {
  $context['post'] = new WPB\Post();
  $templates = array( 'post.twig' );
// multiple posts
} else {
  $context['posts'] = new Timber\PostQuery();
  $templates = array( 'archive.twig' );
}

Timber::render( $templates, $context );