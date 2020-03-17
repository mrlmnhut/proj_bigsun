<?php
/**
 * UAEL GfStyler Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\GfStyler;

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
		if (class_exists('GFForms')){
			return TRUE;
		}

		return FALSE;
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
		return 'uael-gf-styler';
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
			'GfStyler',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
		if (!wp_script_is('jquery', 'enqueued')){
			wp_enqueue_script('jquery');
		}
	}
}
