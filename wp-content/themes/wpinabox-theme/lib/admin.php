<?php
/**
 * Remove extra admin menu items
 *
 * https://isabelcastillo.com/remove-menu-items-wordpress-dashboard
 */
function wpb_remove_menus() {

	// Comments
	// remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'wpb_remove_menus', 999 ); 


?>
