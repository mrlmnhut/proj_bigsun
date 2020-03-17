<?php
namespace Elementor\Modules\System_Info\Reporters;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Elementor active plugins report.
 *
 * Elementor system report handler class responsible for generating a report for
 * active plugins.
 *
 * @since 1.0.0
 */
class Plugins extends Base{

	/**
	 * Active plugins.
	 *
	 * Holds the sites active plugins list.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var array
	 */
	private $plugins;

	/**
	 * Get active plugins.
	 *
	 * Retrieve the active plugins from the list of all the installed plugins.
	 *
	 * @return array Active plugins.
	 *@since 2.0.0
	 * @access private
	 *
	 */
	private function get_plugins(){
		if (!$this->plugins){
			// Ensure get_plugins function is loaded
			if (!function_exists('get_plugins')){
				include ABSPATH . '/wp-admin/includes/plugin.php';
			}

			$active_plugins = get_option('active_plugins');
			$this->plugins  = array_intersect_key(get_plugins(), array_flip($active_plugins));
		}

		return $this->plugins;
	}

	/**
	 * Get active plugins reporter title.
	 *
	 * Retrieve active plugins reporter title.
	 *
	 * @return string Reporter title.
	 *@since 1.0.0
	 * @access public
	 *
	 */
	public function get_title(){
		return 'Active Plugins';
	}

	/**
	 * Is enabled.
	 *
	 * Whether there are active plugins or not.
	 *
	 * @return bool True if the site has active plugins, False otherwise.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function is_enabled(){
		return !!$this->get_plugins();
	}

	/**
	 * Get active plugins report fields.
	 *
	 * Retrieve the required fields for the active plugins report.
	 *
	 * @return array Required report fields with field ID and field label.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_fields(){
		return [
			'active_plugins' => 'Active Plugins',
		];
	}

	/**
	 * Get active plugins.
	 *
	 * Retrieve the sites active plugins.
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value The active plugins list.
	 * }
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_active_plugins(){
		return [
			'value' => $this->get_plugins(),
		];
	}
}
