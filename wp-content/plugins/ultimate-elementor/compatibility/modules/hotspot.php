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
 * Hotspot
 *
 * Registers translatable module with items.
 *
 * @since 1.9.0
 */
class Hotspot extends WPML_Elementor_Module_With_Items{

	/**
	 * Retrieve the field name.
	 *
	 * @return string
	 * @since 1.9.0
	 */
	public function get_items_field(){

		return 'hotspots_list';
	}

	/**
	 * Retrieve the fields inside the repeater.
	 *
	 * @return array
	 * @since 1.9.0
	 *
	 */
	public function get_fields(){
		return [
			'text',
			'content',
			'marker_link' => ['url'],
		];
	}

	/**
	 * Method for setting the title for each translatable field.
	 *
	 * @param string $field The name of the field.
	 *
	 * @return string
	 * @since 1.9.0
	 *
	 */
	protected function get_title($field){
		if ('text' === $field){
			return __('Hotspot: Marker Text', 'uael');
		}

		if ('content' === $field){
			return __('Hotspot: Tooltip Content', 'uael');
		}

		if ('marker_link' === $field){
			return __('Hotspot: Marker Link', 'uael');
		}

		return '';
	}

	/**
	 * Method for determining the editor type for each field.
	 *
	 * @param string $field Name of the field.
	 *
	 * @return string
	 * @since 1.9.0
	 *
	 */
	protected function get_editor_type($field){

		switch ($field){
			case 'text':
			case 'content':
			case 'marker_link':
				return 'LINE';

			default:
				return '';
		}
	}

}
