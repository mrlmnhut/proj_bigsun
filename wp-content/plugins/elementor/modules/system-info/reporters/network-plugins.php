<?php
namespace Elementor\Modules\System_Info\Reporters;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Elementor network plugins report.
 *
 * Elementor system report handler class responsible for generating a report for
 * network plugins.
 *
 * @since 1.0.0
 */
class Network_Plugins extends Base{

	/**
	 * Network plugins.
	 *
	 * Holds the sites network plugins list.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @var array
	 */
	private $plugins;

	/**
	 * Get network plugins reporter title.
	 *
	 * Retrieve network plugins reporter title.
	 *
	 * @return string Reporter title.
	 *@since 1.0.0
	 * @access public
	 *
	 */
	public function get_title(){
		return 'Network Plugins';
	}

	/**
	 * Get active network plugins.
	 *
	 * Retrieve the active network plugins from the list of active site-wide plugins.
	 *
	 * @return array Active network plugins.
	 * @since 2.0.0
	 * @access private
	 *
	 */
	private function get_network_plugins(){
		if (!$this->plugins){
			$active_plugins = get_site_option('active_sitewide_plugins');
			$this->plugins  = array_intersect_key(get_plugins(), $active_plugins);
		}

		return $this->plugins;
	}

	/**
	 * Is enabled.
	 *
	 * Whether there are active network plugins or not.
	 *
	 * @return bool True if the site has active network plugins, False otherwise.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function is_enabled(){
		if (!is_multisite()){
			return FALSE;
		};

		return !!$this->get_network_plugins();
	}

	/**
	 * Get network plugins report fields.
	 *
	 * Retrieve the required fields for the network plugins report.
	 *
	 * @return array Required report fields with field ID and field label.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_fields(){
		return [
			'network_active_plugins' => 'Network Plugins',
		];
	}

	/**
	 * Get active network plugins.
	 *
	 * Retrieve the sites active network plugins.
	 *
	 * @return array {
	 *    Report data.
	 *
	 *    @type string $value The active network plugins list.
	 * }
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_network_active_plugins(){
		return [
			'value' => $this->get_network_plugins(),
		];
	}
}
