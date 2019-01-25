<?php
namespace WPB;
use Timber;

/**
 * Shortcodes
 */

class Shortcodes {
  
  static function register() { 
    $self = get_called_class();

    // add_shortcode( 'example', array($self, 'letter'));
  
  }

  /**
   * [example]
   * example shortcode that uses a twig template
   * keep in mind that the template path will be based on Timber settings,
   * which will probably put it in the theme
   */
  // static function example($attributes, $content = null) {
  //   $atts = shortcode_atts(array(
  //     'content' => do_shortcode(wpautop($content))
  //   ), $attributes);

  //   $context = array_merge(Timber::get_context(), $atts);
  //   return Timber::compile('shortcodes/example.twig', $context);
  // }
}
?>