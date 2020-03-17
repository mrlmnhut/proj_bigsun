<?php
/**
 * UAEL Retina Image Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\RetinaImage;

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
	 * @since 1.17.0
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
	 * @since 1.17.0
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-retina';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 1.17.0
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'Retina_Image',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
		add_filter('upload_mimes', [$this, 'uae_svg_mime_types']);
	}

	/**
	 * Provide the SVG support for Retina Image widget.
	 *
	 * @param array $mimes which return mime type.
	 *
	 * @return $mimes.
	 * @since  1.17.0
	 */
	public function uae_svg_mime_types($mimes){

		// New allowed mime types.
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
}
