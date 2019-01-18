<?php
namespace JCP;

class Example extends BasePost {
  static function register() {

		$name_singular = 'Example';
		$name_singular_lc = 'example';
		$name_plural = 'Examples';
		$name_plural_lc = 'examples';

		$labels = array(
			'name' => __( $name_plural, 'even' ), 
			'singular_name' => __( $name_singular, 'even' ),
			'all_items' => __( "All ${name_plural}", 'even' ),
			'add_new' => __( 'Add New', 'even' ),
			'add_new_item' => __( "Add New ${name_singular}", 'even' ),
			'edit' => __( 'Edit', 'even' ),
			'edit_item' => __( "Edit ${name_singular}", 'even' ),
			'new_item' => __( "New ${name_singular}", 'even' ),
			'view_item' => __( "View ${name_singular}", 'even' ),
			'search_items' => __( "Search ${name_plural}", 'even' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'even' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'even' ),
			'parent_item_colon' => ''
		);
		$options = array(
			'labels' => $labels,
			'description' => __( $name_singular, 'even' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			// 'menu_icon' => 'dashicons-format-gallery',
			// 'menu_position' => 4,
			'rewrite'	=> array( 'slug' => false, 'with_front' => false ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'revisions', 'thumbnail', 'excerpt')
		);
		// http://codex.wordpress.org/Function_Reference/register_post_type
		register_post_type( $name_singular_lc, $options);			
  }
}
?>