<?php

/**
 * Includes
 */
$function_includes = [
  'lib/acf.php',
  'lib/timber.php',
  'lib/utilities.php',
  'lib/admin.php',
  'lib/post-types/image.php',
  'lib/post-types/brand.php',
  'lib/post-types/person.php',
  'lib/post-types/press.php',
  'lib/post-types/workshop.php',
  'lib/post-types/page.php'
];
foreach ($function_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath)

?>
