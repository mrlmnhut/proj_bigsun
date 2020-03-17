<?php
/**
 * UAEL PriceList Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\PriceList;

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
		return 'uael-price-list';
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
			'Price_List',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
	}
}
