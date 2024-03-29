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
class PriceTable extends WPML_Elementor_Module_With_Items{

	/**
	 * Retrieve the field name.
	 *
	 * @return string
	 * @since 1.2.2
	 */
	public function get_items_field(){
		return 'features_list';
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
			'item_text',
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
		if ('item_text' === $field){
			return __('Price Table: Feature Title', 'uael');
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
			case 'item_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
