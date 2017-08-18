<?php
namespace WPB;
use Timber;

/**
 * Add helper functions for your project here
 */

class Helper extends Timber\Helper {

	/**
	 * Utility function for logging
	 *
	 * @param String $contents
	 * @return void
	 */
	static function log($contents) {
		Timber\Helper::error_log($contents);
	}

}


?>