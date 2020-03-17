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
 * Table
 *
 * Registers translatable module with items.
 *
 * @since 1.2.2
 */
class Timeline extends WPML_Elementor_Module_With_Items{

	/**
	 * Retrieve the field name.
	 *
	 * @return string
	 * @since 1.2.2
	 */
	public function get_items_field(){
		return 'timelines';
	}

	/**
	 * Retrieve the fields inside the repeater.
	 *
	 * @return array
	 * @since 1.2.2
	 *
	 */
	public function get_fields(){
		return [
			'timeline_single_date',
			'timeline_single_heading',
			'timeline_single_content',
			'timeline_single_link' => ['url'],
		];
	}

	/**
	 * Method for setting the title for each translatable field.
	 *
	 * @param string $field The name of the field.
	 *
	 * @return string
	 * @since 1.2.2
	 *
	 */
	protected function get_title($field){
		if ('timeline_single_date' === $field){
			return __('Timeline: Date', 'uael');
		}
		if ('timeline_single_heading' === $field){
			return __('Timeline: Heading', 'uael');
		}
		if ('timeline_single_content' === $field){
			return __('Timeline: Description', 'uael');
		}
		if ('timeline_single_link' === $field){
			return __('Timeline: Link', 'uael');
		}

		return '';
	}

	/**
	 * Method for determining the editor type for each field.
	 *
	 * @param string $field Name of the field.
	 *
	 * @return string
	 * @since 1.2.2
	 *
	 */
	protected function get_editor_type($field){

		switch ($field){
			case 'timeline_single_date':
			case 'timeline_single_heading':
			case 'timeline_single_content':
			case 'timeline_single_link':
				return 'LINE';

			default:
				return '';
		}
	}

}
