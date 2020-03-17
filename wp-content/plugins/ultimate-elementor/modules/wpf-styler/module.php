<?php
/**
 * UAEL WpfStyler Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\WpfStyler;

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
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public static function is_enable(){
		if (class_exists('WPForms_Pro') || class_exists('WPForms_Lite')){
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Get Module Name.
	 *
	 * @return string Module name.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-wpf-styler';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'WpfStyler',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
	}
}
