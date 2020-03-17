<?php
/**
 * UAEL VideoGallery Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\VideoGallery;

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
	 * @since 1.6.0
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
	 * @since 1.6.0
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-video-gallery';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 1.6.0
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'Video_Gallery',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
	}
}

