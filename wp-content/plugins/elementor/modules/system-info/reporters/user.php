<?php
namespace Elementor\Modules\System_Info\Reporters;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Elementor user report.
 *
 * Elementor system report handler class responsible for generating a report for
 * the user.
 *
 * @since 1.0.0
 */
class User extends Base{

	/**
	 * Get user reporter title.
	 *
	 * Retrieve user reporter title.
	 *
	 * @return string Reporter title.
	 *@since 1.0.0
	 * @access public
	 *
	 */
	public function get_title(){
		return 'User';
	}

	/**
	 * Get user report fields.
	 *
	 * Retrieve the required fields for the user report.
	 *
	 * @return array Required report fields with field ID and field label.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_fields(){
		return [
			'role'   => 'Role',
			'locale' => 'WP Profile lang',
			'agent'  => 'User Agent',
		];
	}

	/**
	 * Get user role.
	 *
	 * Retrieve the user role.
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value The user role.
	 * }
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_role(){
		$role = NULL;

		$current_user = wp_get_current_user();
		if (!empty($current_user->roles)){
			$role = $current_user->roles[0];
		}

		return [
			'value' => $role,
		];
	}

	/**
	 * Get user profile language.
	 *
	 * Retrieve the user profile language.
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value User profile language.
	 * }
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_locale(){
		return [
			'value' => get_locale(),
		];
	}

	/**
	 * Get user agent.
	 *
	 * Retrieve user agent.
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value HTTP user agent.
	 * }
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_agent(){
		return [
			'value' => esc_html($_SERVER['HTTP_USER_AGENT']),
		];
	}
}
