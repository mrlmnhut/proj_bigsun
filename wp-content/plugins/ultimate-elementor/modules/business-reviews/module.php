<?php
/**
 * UAEL BusinessReviews Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\BusinessReviews;

use UltimateElementor\Base\Module_Base;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Class Module.
 */
class Module extends Module_Base{

	/**
	 * Module should load or not.
	 *
	 * @return bool true|false.
	 * @since 1.13.0
	 * @access public
	 *
	 */
	public static function is_enable(){
		return TRUE;
	}

	/**
	 * Get Module Name.
	 *
	 * @return string Module name.
	 * @since 1.13.0
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-business-reviews';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 1.13.0
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'Business_Reviews',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
	}

}
