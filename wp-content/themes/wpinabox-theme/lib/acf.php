<?php
 

// enable options page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();   
} 


function wpb_save_acf_json( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/lib/acf/';
    // return
    return $path;
}


function wpb_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/lib/acf/';
    // return
    return $paths; 
}

add_filter('acf/settings/save_json', 'asb_save_acf_json');
add_filter('acf/settings/load_json', 'asb_acf_json_load_point');

?>