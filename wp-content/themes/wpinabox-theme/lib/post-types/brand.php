<?php

namespace WPinabox;


class CustomPost extends TimberPost {

	static function register() {

		$labels = array(
			'name' => __( 'CustomPosts', 'wpinabox' ), 
			'singular_name' => __( 'CustomPost', 'wpinabox' ),
			'all_items' => __( 'All CustomPosts', 'wpinabox' ),
			'add_new' => __( 'Add New', 'wpinabox' ),
			'add_new_item' => __( 'Add New CustomPost', 'wpinabox' ),
			'edit' => __( 'Edit', 'wpinabox' ),
			'edit_item' => __( 'Edit CustomPost', 'wpinabox' ),
			'new_item' => __( 'New CustomPost', 'wpinabox' ),
			'view_item' => __( 'View CustomPost', 'wpinabox' ),
			'search_items' => __( 'Search CustomPosts', 'wpinabox' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'wpinabox' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'wpinabox' ),
			'parent_item_colon' => ''
		);

		$options = array(
			'labels' => $labels,
			'description' => __( 'CustomPosts', 'wpinabox' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'rewrite'	=> array( 'slug' => 'custom-post', 'with_front' => false ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'revisions')
		);

		// http://codex.wordpress.org/Function_Reference/register_post_type
		register_post_type( 'custom_post', $options);			

	}

}


?>
