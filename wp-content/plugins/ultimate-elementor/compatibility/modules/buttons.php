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
 * Buttons
 *
 * Registers translatable module with items.
 *
 * @since 1.2.2
 */
class Buttons extends WPML_Elementor_Module_With_Items{

	/**
	 * Retrieve the field name.
	 *
	 * @return string
	 * @since 1.2.2
	 */
	public function get_items_field(){
		return 'buttons';
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
			'text',
			'link' => ['url'],
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
		if ('text' === $field){
			return __('Buttons: Text', 'uael');
		}

		if ('url' === $field){
			return __('Buttons: Link', 'uael');
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
			case 'text':
			case 'url':
				return 'LINE';

			default:
				return '';
		}
	}

}
