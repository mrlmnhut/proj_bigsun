<?php
namespace Elementor\Modules\System_Info\Reporters;

use Elementor\Modules\System_Info\Helpers\Model_Helper;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Elementor base reporter.
 *
 * A base abstract class that provides the needed properties and methods to
 * manage and handle reporter in inheriting classes.
 *
 * @since 2.9.0
 * @abstract
 */
abstract class Base{

	/**
	 * Reporter properties.
	 *
	 * Holds the list of all the properties of the report.
	 *
	 * @access protected
	 * @static
	 *
	 * @var array
	 */
	protected $_properties;

	/**
	 * Get report title.
	 *
	 * Retrieve the title of the report.
	 *
	 * @since 2.9.0
	 * @access public
	 * @abstract
	 */
	abstract public function get_title();

	/**
	 * Get report fields.
	 *
	 * Retrieve the required fields for the report.
	 *
	 * @since 2.9.0
	 * @access public
	 * @abstract
	 */
	abstract public function get_fields();

	/**
	 * Is report enabled.
	 *
	 * Whether the report is enabled.
	 *
	 * @return bool Whether the report is enabled.
	 * @since 2.9.0
	 * @access public
	 *
	 */
	public function is_enabled(){
		return TRUE;
	}

	/**
	 * Get report.
	 *
	 * Retrieve the report with all it's containing fields.
	 *
	 * @return \WP_Error | array {
	 *    Report fields.
	 *
	 *    @type string $name Field name.
	 * @type string $label Field label.
	 * }
	 * @since 2.9.0
	 * @access public
	 *
	 */
	final public function get_report($format = ''){
		$result = [];

		$format = (empty($format)) ? '' : $format . '_';

		foreach ($this->get_fields() as $field_name => $field_label){
			$method = 'get_' . $format . $field_name;

			if (!method_exists($this, $method)){
				$method = 'get_' . $field_name;
				//fallback:
				if (!method_exists($this, $method)){
					return new \WP_Error(sprintf("Getter method for the field '%s' wasn't found in %s.",
						$field_name, get_called_class()));
				}
			}

			$reporter_field = [
				'name'  => $field_name,
				'label' => $field_label,
			];

			$reporter_field      = array_merge($reporter_field, $this->$method());
			$result[$field_name] = $reporter_field;
		}

		return $result;
	}

	/**
	 * Get properties keys.
	 *
	 * Retrieve the keys of the properties.
	 *
	 * @return array {
	 *    Property keys.
	 *
	 * @type string $name   Property name.
	 *    @type string $fields Property fields.
	 * }
	 * @since 2.9.0
	 * @access public
	 * @static
	 *
	 */
	public static function get_properties_keys(){
		return [
			'name',
			'format',
			'fields',
		];
	}

	/**
	 * Filter possible properties.
	 *
	 * Retrieve possible properties filtered by property keys.
	 *
	 * @param array $properties Properties to filter.
	 *
	 * @return array Possible properties filtered by property keys.
	 * @since 2.9.0
	 * @access public
	 * @static
	 *
	 */
	final public static function filter_possible_properties($properties){
		return Model_Helper::filter_possible_properties(self::get_properties_keys(), $properties);
	}

	/**
	 * Set properties.
	 *
	 * Add/update properties to the report.
	 *
	 * @param array $key Property key.
	 * @param array $value Optional. Property value. Default is `null`.
	 *
	 *@since 2.9.0
	 * @access public
	 *
	 */
	final public function set_properties($key, $value = NULL){
		if (is_array($key)){
			$key = self::filter_possible_properties($key);

			foreach ($key as $sub_key => $sub_value){
				$this->set_properties($sub_key, $sub_value);
			}

			return;
		}

		if (!in_array($key, self::get_properties_keys(), TRUE)){
			return;
		}

		$this->_properties[$key] = $value;
	}

	/**
	 * Reporter base constructor.
	 *
	 * Initializing the reporter base class.
	 *
	 * @param array $properties Optional. Properties to filter. Default is `null`.
	 *
	 * @since 2.9.0
	 * @access public
	 *
	 */
	public function __construct($properties = NULL){
		$this->_properties = array_fill_keys(self::get_properties_keys(), NULL);

		if ($properties){
			$this->set_properties($properties, NULL);
		}
	}
}
