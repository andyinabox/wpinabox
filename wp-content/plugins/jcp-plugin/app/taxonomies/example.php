<?php
namespace WPB;
/**
 * @package Example Taxonomy
 * @version 1.0
 */
// Register the Custom Taxonomy

class ExampleTaxonomy {

	static function register() {
		$name_singular = 'Example';
		$name_singular_lc = 'example';
		$name_plural = 'Examples';
		$name_plural_lc = 'examples';

		$tax_labels = array(
			'name'                       => _x( $name_plural, 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( $name_singular, 'Taxonomy Singular Name', 'text_domain'),
			'menu_name'                  => __( $name_plural, 'text_domain' ),
			'all_items'                  => __( "All ${name_plural}", 'text_domain' ),
			'parent_item'                => __( "Parent ${name_singular}", 'text_domain' ),
			'parent_item_colon'          => __( "Parent ${name_singular}:", 'text_domain' ),
			'new_item_name'              => __( "Add New ${name_singular}", 'text_domain' ),
			'edit_item'                  => __( "Edit ${name_singular}", 'text_domain' ),
			'update_item'                => __( "Update ${name_singular}", 'text_domain' ),
			'separate_items_with_commas' => __( "Separate ${name_plural_lc} with commas", 'text_domain' ),
			'search_items'               => __( "Search ${name_plural_lc}", 'text_domain' ),
			'add_or_remove_items'        => __( "Add or remove ${name_plural_lc}", 'text_domain' ),
			'choose_from_most_used'      => __( "Choose from the most used ${name_plural_lc}", 'text_domain' )
		);
		$tax_args = array(
			'labels'                     => $tax_labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'snow_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'query_var'                  => true,
			'rewrite'                    => false
		);


		$class = get_called_class();
		register_taxonomy( $name_singular_lc, 'post', $tax_args );
	}
}

