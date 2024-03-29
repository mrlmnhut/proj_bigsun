<?php
/**
 * UAEL WPML compatibility.
 *
 * @package UAEL
 */

namespace UltimateElementor\Compatibility\WPML;

use WPML_Elementor_Module_With_Items;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Business Hours
 *
 * Registers translatable module with items
 *
 * @since 1.2.2
 */
class BusinessHours extends WPML_Elementor_Module_With_Items{

	/**
	 * Get items field
	 *
	 * @return string
	 * @since 1.2.2
	 */
	public function get_items_field(){
		return 'business_days_timings';
	}

	/**
	 * Retrieve the fields inside the repeater
	 *
	 * @return array
	 * @since 1.2.2
	 *
	 */
	public function get_fields(){
		return [
			'enter_day',
			'enter_time',
		];
	}

	/**
	 * Method for setting the title for each translatable field
	 *
	 * @param string $field The name of the field.
	 *
	 * @return string
	 * @since 1.2.2
	 *
	 */
	protected function get_title($field){
		if ('enter_day' === $field){
			return __('BusinessHours: Enter Day', 'uael');
		}

		if ('enter_time' === $field){
			return __('BusinessHours: Enter Time', 'uael');
		}

		return '';
	}

	/**
	 * Method for determining the editor type for each field
	 *
	 * @param string $field Name of the field.
	 *
	 * @return string
	 * @since 1.2.2
	 *
	 */
	protected function get_editor_type($field){

		switch ($field){
			case 'enter_day':
			case 'enter_time':
				return 'LINE';

			default:
				return '';
		}
	}
}
