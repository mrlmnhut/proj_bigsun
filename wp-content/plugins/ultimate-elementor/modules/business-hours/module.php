<?php
/**
 * UAEL BusinessHours Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\BusinessHours;

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
	 * @since 0.0.1
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
	 * @since 0.0.1
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-business-hours';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 0.0.1
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'Business_Hours',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
	}
}
