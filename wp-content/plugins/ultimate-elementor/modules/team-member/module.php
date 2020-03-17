<?php
/**
 * UAEL Team Member Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\TeamMember;

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
	 * @since 1.16.0
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
	 * @since 1.16.0
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-team-member';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 1.16.0
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'Team_Member',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();
	}
}
