<?php
/**
 * UAEL WPForms Styler.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\WpfStyler\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use UltimateElementor\Base\Common_Widget;

// UltimateElementor Classes.

if (!defined('ABSPATH')){
	exit;   // Exit if accessed directly.
}

/**
 * Class WpfStyler.
 */
class WpfStyler extends Common_Widget{

	/**
	 * Retrieve WPForms Styler Widget name.
	 *
	 * @return string Widget name.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_name(){
		return parent::get_widget_slug('WpfStyler');
	}

	/**
	 * Retrieve WPForms Styler Widget title.
	 *
	 * @return string Widget title.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_title(){
		return parent::get_widget_title('WpfStyler');
	}

	/**
	 * Retrieve WPForms Styler Widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_icon(){
		return parent::get_widget_icon('WpfStyler');
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @return string Widget icon.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_keywords(){
		return parent::get_widget_keywords('WpfStyler');
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 * @since 1.15.0
	 * @access public
	 *
	 */
	public function get_script_depends(){
		return ['uael-frontend-script'];
	}

	/**
	 * Function to integrate WP Forms.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function get_wp_forms(){

		$field_options = [];

		if (class_exists('WPForms_Pro') || class_exists('WPForms_Lite')){

			$args               = [
				'post_type'      => 'wpforms',
				'posts_per_page' => - 1,
			];
			$forms              = get_posts($args);
			$field_options['0'] = 'Select';

			if ($forms){
				foreach ($forms as $form){
					$field_options[$form->ID] = $form->post_title;
				}
			}
		}

		if (empty($field_options)){
			$field_options = [
				'-1' => __('You have not added any WPForms yet.', 'uael'),
			];
		}

		return $field_options;
	}

	/**
	 * Register WPForms Styler controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function _register_controls(){

		$this->register_general_content_controls();
		$this->register_input_style_controls();
		$this->register_radio_content_controls();
		$this->register_button_content_controls();
		$this->register_error_content_controls();
		$this->register_spacing_controls();
		$this->register_typography_controls();
		$this->register_helpful_information();
	}

	/**
	 * Register WPForms Styler General Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_general_content_controls(){
		$this->start_controls_section(
			'section_general',
			[
				'label' => __('General', 'uael'),
			]
		);

		$this->add_control(
			'select_form',
			[
				'label'   => __('Select Form', 'uael'),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_wp_forms(),
				'default' => '0',
			]
		);

		$this->add_control(
			'form_title_option',
			[
				'label'       => __('Title & Description', 'uael'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'default',
				'label_block' => FALSE,
				'options'     => [
					'default' => __('From WPForms', 'uael'),
					'custom'  => __('Enter Your Own', 'uael'),
					'none'    => __('None', 'uael'),
				],
			]
		);

		$this->add_control(
			'form_title',
			[
				'label'     => __('Form Title', 'uael'),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'form_title_option' => 'custom',
				],
				'dynamic'   => [
					'active' => TRUE,
				],

			]
		);

		$this->add_control(
			'form_desc',
			[
				'label'     => __('Form Description', 'uael'),
				'type'      => Controls_Manager::TEXTAREA,
				'condition' => [
					'form_title_option' => 'custom',
				],
				'dynamic'   => [
					'active' => TRUE,
				],
			]
		);

		$this->add_responsive_control(
			'form_title_desc_align',
			[
				'label'     => __('Title & Description </br>Alignment', 'uael'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __('Left', 'uael'),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'uael'),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __('Right', 'uael'),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'condition' => [
					'form_title_option!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-description, {{WRAPPER}} .uael-wpf-style .wpforms-title' => 'text-align: {{VALUE}};',
				],
				'toggle'    => FALSE,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register WPForms Styler Input Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_input_style_controls(){
		$this->start_controls_section(
			'section_input_fields',
			[
				'label' => __('Form Fields', 'uael'),
			]
		);

		$this->add_control(
			'wpf_style',
			[
				'label'        => __('Field Style', 'uael'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'box',
				'options'      => [
					'box'       => __('Box', 'uael'),
					'underline' => __('Underline', 'uael'),
				],
				'prefix_class' => 'uael-wpf-style-',
			]
		);

		$this->add_control(
			'input_size',
			[
				'label'        => __('Field Size', 'uael'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'sm',
				'options'      => [
					'xs' => __('Extra Small', 'uael'),
					'sm' => __('Small', 'uael'),
					'md' => __('Medium', 'uael'),
					'lg' => __('Large', 'uael'),
					'xl' => __('Extra Large', 'uael'),
				],
				'prefix_class' => 'uael-wpf-input-size-',
			]
		);

		$this->add_responsive_control(
			'wpf_input_padding',
			[
				'label'      => __('Field Padding', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
						{{WRAPPER}} .uael-wpf-style .wpforms-container-full .wpforms-form ul.wpforms-image-choices-modern label'         => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before' => 'height: {{BOTTOM}}{{UNIT}}; width: {{BOTTOM}}{{UNIT}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before'             => 'font-size: calc( {{BOTTOM}}{{UNIT}} / 1.2 );',
				],
			]
		);

		$this->add_control(
			'wpf_input_bgcolor',
			[
				'label'     => __('Field Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
						{{WRAPPER}} .uael-wpf-style .wpforms-container-full .wpforms-form ul.wpforms-image-choices-modern label,
						{{WRAPPER}} .uael-wpf-container select option'                                                    => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}} .uael-wpf-style input[type="radio"] + label:before'               => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .uael-wpf-style input[type="radio"]:checked + label:before'                              => 'background-color: #7a7a7a;',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"]:checked + label:before' => 'box-shadow:inset 0px 0px 0px 4px {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_label_color',
			[
				'label'     => __('Label Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-label, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator-steps, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-divider,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-divider h3,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-radio li label, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-payment-multiple li label,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-single-item-price,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-checkbox li label,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-payment-total,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator-page-title,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-captcha .wpforms-field-label,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-likert_scale .wpforms-field-label,
						{{WRAPPER}} .uael-wpf-style .wpforms-field-file-upload input[type=file]' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_input_color',
			[
				'label'     => __('Input Text / Placeholder Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input::placeholder, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea::placeholder, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-likert_scale tbody tr th'                                                                                                                                                                        => 'color: {{VALUE}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field.wpforms-field-radio input[type="radio"]:checked + label:before, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field.wpforms-field-payment-multiple input[type="radio"]:checked + label:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_input_desc_color',
			[
				'label'     => __('Sublabel / Description Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-sublabel,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-html,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-likert_scale thead tr th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_required_color',
			[
				'label'     => __('Required Asterisk Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-required-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_style',
			[
				'label'       => __('Border Style', 'uael'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'solid',
				'label_block' => FALSE,
				'options'     => [
					'none'   => __('None', 'uael'),
					'solid'  => __('Solid', 'uael'),
					'double' => __('Double', 'uael'),
					'dotted' => __('Dotted', 'uael'),
					'dashed' => __('Dashed', 'uael'),
				],
				'condition'   => [
					'wpf_style' => 'box',
				],
				'selectors'   => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select'                                                         => 'border-style: {{VALUE}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before,
						{{WRAPPER}} .uael-wpf-style .wpforms-container-full .wpforms-form ul.wpforms-image-choices-modern label,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_size',
			[
				'label'      => __('Border Width', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'    => '1',
					'bottom' => '1',
					'left'   => '1',
					'right'  => '1',
					'unit'   => 'px',
				],
				'condition'  => [
					'wpf_style'           => 'box',
					'input_border_style!' => 'none',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description'                     => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before,
						{{WRAPPER}} .uael-wpf-style .wpforms-form ul.wpforms-image-choices-modern label,
						{{WRAPPER}} .uael-wpf-style .wpforms-form ul.wpforms-image-choices-modern label:hover,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label'     => __('Border Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'wpf_style'           => 'box',
					'input_border_style!' => 'none',
				],
				'default'   => '#eaeaea',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before,
						{{WRAPPER}} .uael-wpf-style .wpforms-form ul.wpforms-image-choices-modern label,
						{{WRAPPER}} .uael-wpf-style .wpforms-form ul.wpforms-image-choices-modern label:hover,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator.circles'       => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wpf_border_bottom',
			[
				'label'      => __('Border Size', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'default'    => [
					'size' => '2',
					'unit' => 'px',
				],
				'condition'  => [
					'wpf_style' => 'underline',
				],
				'selectors'  => [
					'{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field select, 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field textarea,
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field-description.wpforms-disclaimer-description'       => 'border-width: 0 0 {{SIZE}}{{UNIT}} 0; border-style: solid;',
					'{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field input[type="radio"] + label:before,
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form ul.wpforms-image-choices-modern label,
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form ul.wpforms-image-choices-modern label:hover' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid; box-sizing: content-box;',
				],
			]
		);

		$this->add_control(
			'wpf_border_color',
			[
				'label'     => __('Border Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'wpf_style' => 'underline',
				],
				'default'   => '#c4c4c4',
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field select, 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field textarea'                                         => 'border-color: {{VALUE}};',
					'{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field input[type="radio"] + label:before, 
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-container-full .wpforms-form ul.wpforms-image-choices-modern label,
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-form ul.wpforms-image-choices-modern label:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_ipborder_active',
			[
				'label'     => __('Border Active Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]):focus, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select:focus, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea:focus'                                                                       => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"]:checked + label:before,
						{{WRAPPER}} .uael-wpf-style .wpforms-container-full .wpforms-form ul.wpforms-image-choices-modern .wpforms-selected label' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'wpf_input_radius',
			[
				'label'      => __('Rounded Corners', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
						{{WRAPPER}}.uael-wpf-style-underline .wpforms-container-full .wpforms-form ul.wpforms-image-choices-modern label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '0',
					'bottom' => '0',
					'left'   => '0',
					'right'  => '0',
					'unit'   => 'px',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'fields_box_shadow',
				'label'     => __('Box Shadow', 'uael'),
				'condition' => [
					'wpf_style!' => 'underline',
				],
				'selector'  => '{{WRAPPER}} .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
									{{WRAPPER}} .wpforms-form .wpforms-field select, 
									{{WRAPPER}} .wpforms-form .wpforms-field textarea,
									{{WRAPPER}} .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
									{{WRAPPER}} .wpforms-form ul.wpforms-image-choices-modern label',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register WPForms Styler Radio Input & Checkbox Input Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_radio_content_controls(){
		$this->start_controls_section(
			'wpf_radio_check_style',
			[
				'label' => __('Radio & Checkbox', 'uael'),
			]
		);
		$this->add_control(
			'wpf_radio_check_custom',
			[
				'label'        => __('Override Current Style', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'uael'),
				'label_off'    => __('No', 'uael'),
				'return_value' => 'yes',
				'default'      => '',
				'prefix_class' => 'uael-wpf-check-',
			]
		);

		$this->add_control(
			'wpf_radio_check_size',
			[
				'label'      => _x('Size', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'condition'  => [
					'wpf_radio_check_custom!' => '',
				],
				'default'    => [
					'unit' => 'px',
					'size' => 16,
				],
				'range'      => [
					'px' => [
						'min' => 15,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, {{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before'                                                                                                         => 'font-size: calc( {{SIZE}}{{UNIT}} / 1.2 );',
				],
			]
		);

		$this->add_control(
			'wpf_radio_check_bgcolor',
			[
				'label'     => __('Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'wpf_radio_check_custom!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before, {{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"]:checked + label:before'                                                                                                            => 'box-shadow:inset 0px 0px 0px 4px {{VALUE}};',
				],
				'default'   => '#fafafa',
			]
		);

		$this->add_control(
			'wpf_selected_color',
			[
				'label'     => __('Selected Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'wpf_radio_check_custom!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before' => 'color: {{VALUE}};',
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"]:checked + label:before'    => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_select_color',
			[
				'label'     => __('Label Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'wpf_radio_check_custom!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field-checkbox li label,
						{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field-radio li label, 
						{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field-payment-multiple li label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_check_border_color',
			[
				'label'     => __('Border Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeaea',
				'condition' => [
					'wpf_radio_check_custom!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before,{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_check_border_width',
			[
				'label'      => __('Border Width', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default'    => [
					'size' => '1',
					'unit' => 'px',
				],
				'condition'  => [
					'wpf_radio_check_custom!' => '',
				],
				'selectors'  => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before,{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="radio"] + label:before' => 'border-width: {{SIZE}}{{UNIT}}; border-style: solid;',
				],
			]
		);

		$this->add_control(
			'wpf_check_border_radius',
			[
				'label'      => __('Checkbox Rounded Corners', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'condition'  => [
					'wpf_radio_check_custom!' => '',
				],
				'selectors'  => [
					'{{WRAPPER}}.uael-wpf-check-yes .uael-wpf-style .wpforms-form .wpforms-field input[type="checkbox"] + label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '0',
					'bottom' => '0',
					'left'   => '0',
					'right'  => '0',
					'unit'   => 'px',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register WPForms Styler Button Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_button_content_controls(){

		$this->start_controls_section(
			'wpf_submit_button',
			[
				'label' => __('Submit Button', 'uael'),
			]
		);
		$this->add_responsive_control(
			'wpf_button_align',
			[
				'label'        => __('Button Alignment', 'uael'),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => __('Left', 'uael'),
						'icon'  => 'fa fa-align-left',
					],
					'center'  => [
						'title' => __('Center', 'uael'),
						'icon'  => 'fa fa-align-center',
					],
					'right'   => [
						'title' => __('Right', 'uael'),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'uael'),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'default'      => 'left',
				'prefix_class' => 'uael%s-wpf-button-',
				'toggle'       => FALSE,
			]
		);

		$this->add_control(
			'btn_size',
			[
				'label'        => __('Size', 'uael'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'sm',
				'options'      => [
					'xs' => __('Extra Small', 'uael'),
					'sm' => __('Small', 'uael'),
					'md' => __('Medium', 'uael'),
					'lg' => __('Large', 'uael'),
					'xl' => __('Extra Large', 'uael'),
				],
				'prefix_class' => 'uael-wpf-btn-size-',
			]
		);

		$this->add_responsive_control(
			'wpf_button_padding',
			[
				'label'      => __('Padding', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit],
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'uael'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __('Text Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit], {{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit]:hover, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'btn_background_color',
				'label'          => __('Background Color', 'uael'),
				'types'          => ['classic', 'gradient'],
				'fields_options' => [
					'color' => [
						'scheme' => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						],
					],
				],
				'selector'       => '{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit], {{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit]:hover, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'btn_border',
				'label'       => __('Border', 'uael'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit], {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button',
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => __('Border Radius', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit], {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit], {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'uael'),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label'     => __('Text Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit]:hover, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background_hover_color',
				'label'    => __('Background Color', 'uael'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit]:hover, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button:hover',
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __('Border Hover Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit]:hover, {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register WPForms Styler Error Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_error_content_controls(){

		$this->start_controls_section(
			'wpf_error_field',
			[
				'label' => __('Success / Error Message', 'uael'),
			]
		);

		$this->add_control(
			'wpf_validation_message',
			[
				'label' => __('Field Validation', 'uael'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'wpf_highlight_style',
			[
				'label'        => __('Message Style', 'uael'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => [
					'default'      => __('Default', 'uael'),
					'bottom_right' => __('Custom', 'uael'),
				],
				'prefix_class' => 'uael-wpf-highlight-style-',
			]
		);

		$this->add_control(
			'wpf_message_color',
			[
				'label'     => __('Message Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ff0000',
				'condition' => [
					'wpf_highlight_style' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style label.wpforms-error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_message_highlight_color',
			[
				'label'     => __('Message Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'condition' => [
					'wpf_highlight_style' => 'bottom_right',
				],
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-highlight-style-bottom_right label.wpforms-error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_message_bgcolor',
			[
				'label'     => __('Message Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(255, 0, 0, 0.6)',
				'condition' => [
					'wpf_highlight_style' => 'bottom_right',
				],
				'selectors' => [
					'{{WRAPPER}}.uael-wpf-highlight-style-bottom_right label.wpforms-error' => 'background-color: {{VALUE}}; padding: 0.1em 0.8em;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'wpf_message_typo',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-wpf-style label.wpforms-error',
			]
		);

		$this->add_control(
			'wpf_success_validation_message',
			[
				'label'     => __('Form Success Message', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wpf_success_message_color',
			[
				'label'     => __('Message Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-confirmation-container-full' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_success_message_bgcolor',
			[
				'label'     => __('Message Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-confirmation-container-full' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'wpf_success_border_color',
			[
				'label'     => __('Message Border Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-confirmation-container-full' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'wpf_validation_typo',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-confirmation-container-full',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register WPForms Styler spacing Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_spacing_controls(){

		$this->start_controls_section(
			'form_spacing',
			[
				'label' => __('Spacing', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_desc_spacing_heading',
			[
				'label'     => __('Title & Description', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'form_title_option!' => 'none',
				],
			]
		);

		$this->add_responsive_control(
			'form_title_margin_bottom',
			[
				'label'      => __('Form Title Bottom Margin', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'condition'  => [
					'form_title_option!' => 'none',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_desc_margin_bottom',
			[
				'label'      => __('Form Description Bottom Margin', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'form_title_option!' => 'none',
				],
				'separator'  => 'after',
			]
		);

		$this->add_control(
			'input_spacing_heading',
			[
				'label' => __('Form Fields', 'uael'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'form_fields_margin',
			[
				'label'      => __('Space Between Two Fields', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field,
						{{WRAPPER}} .uael-wpf-style .wpforms-field-address .wpforms-field-row'                             => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-container.inline-fields .wpforms-field-container .wpforms-field' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_label_margin_bottom',
			[
				'label'      => __('Label Bottom Spacing', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-label, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator-steps,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-divider h3'                                                                           => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-wpf-style div.wpforms-container-full .wpforms-form .wpforms-page-indicator.progress .wpforms-page-indicator-page-progress-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_desc_margin_top',
			[
				'label'      => __('Sublabel / Description Top Spacing', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-sublabel' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'check_radio_items_spacing',
			[
				'label'      => __('Radio & Checkbox Items Spacing', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-radio li:not(:last-child), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-checkbox ul li:not(:last-child),
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-payment-multiple li:not(:last-child)'                           => 'margin-bottom: {{SIZE}}{{UNIT}} !important; margin-right: 0{{UNIT}};',
					'{{WRAPPER}} .uael-wpf-style .wpforms-field-radio.wpforms-list-inline ul li:not(:last-child),
						{{WRAPPER}} .uael-wpf-style .wpforms-field-checkbox.wpforms-list-inline ul li:not(:last-child),
						{{WRAPPER}} .uael-wpf-style .wpforms-field-payment-multiple.wpforms-list-inline li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}} !important; margin-bottom: 0{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'submit_spacing',
			[
				'label'      => __('Submit Button Top Spacing', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit],
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-pagebreak'                                                     => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-uael-wpf-styler .uael-wpf-style .wpforms-container.inline-fields button[type=submit]'         => 'margin-top: 0px;',
					'(mobile){{WRAPPER}}.elementor-widget-uael-wpf-styler .uael-wpf-style .wpforms-container.inline-fields button[type=submit]' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register WPForms Styler Typography Controls.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_typography_controls(){

		$this->start_controls_section(
			'form_typo',
			[
				'label' => __('Typography', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_title_typo',
			[
				'label'     => __('Form Title', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'form_title_option!' => 'none',
				],
			]
		);

		$this->add_control(
			'form_title_tag',
			[
				'label'     => __('HTML Tag', 'uael'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'h1'  => __('H1', 'uael'),
					'h2'  => __('H2', 'uael'),
					'h3'  => __('H3', 'uael'),
					'h4'  => __('H4', 'uael'),
					'h5'  => __('H5', 'uael'),
					'h6'  => __('H6', 'uael'),
					'div' => __('div', 'uael'),
					'p'   => __('p', 'uael'),
				],
				'condition' => [
					'form_title_option' => 'custom',
				],
				'default'   => 'h3',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .uael-wpf-style .wpforms-title',
				'condition' => [
					'form_title_option!' => 'none',
				],

			]
		);
		$this->add_control(
			'form_title_color',
			[
				'label'     => __('Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'condition' => [
					'form_title_option!' => 'none',
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-title' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'form_desc_typo',
			[
				'label'     => __('Form Description', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'form_title_option!' => 'none',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'desc_typography',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
				'selector'  => '{{WRAPPER}} .uael-wpf-style .wpforms-description',
				'condition' => [
					'form_title_option!' => 'none',
				],
			]
		);

		$this->add_control(
			'form_desc_color',
			[
				'label'     => __('Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'form_title_option!' => 'none',
				],
				'default'   => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .uael-wpf-style .wpforms-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_input_typo',
			[
				'label' => __('Form Fields', 'uael'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'form_label_typography',
				'label'    => 'Label Typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-label,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-radio li label, 
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-checkbox li label,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator-steps,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-payment-multiple li label,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-single-item-price,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-payment-total,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-divider,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-html,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-divider h3,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator-steps,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-indicator-page-title,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-captcha .wpforms-field-label,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-likert_scale .wpforms-field-label,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-file-upload input[type=file]',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_typography',
				'label'    => 'Input Text Typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input:not([type=submit]):not([type=image]):not([type=button]):not([type=file]):not([type=radio]):not([type=checkbox]), 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field input::placeholder, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field textarea::placeholder, 
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field select,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description.wpforms-disclaimer-description,
						{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-likert_scale tbody tr th',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_desc_typography',
				'label'    => 'Sublabel / Description Typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-description,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-sublabel,
									{{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-field-likert_scale thead tr th',
			]
		);

		$this->add_control(
			'btn_typography_label',
			[
				'label'     => __('Button Typography', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typography',
				'label'    => __('Typography', 'uael'),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .uael-wpf-style .wpforms-form button[type=submit], {{WRAPPER}} .uael-wpf-style .wpforms-form .wpforms-page-button',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Helpful Information.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function register_helpful_information(){

		if (parent::is_internal_links()){
			$this->start_controls_section(
				'section_helpful_info',
				[
					'label' => __('Helpful Information', 'uael'),
				]
			);

			$this->add_control(
				'help_doc_1',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf(__('%1$s Getting started article » %2$s', 'uael'),
						'<a href="https://uaelementor.com/docs/wpforms-styler-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);

			$this->add_control(
				'help_doc_3',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s Doc Link */
					'raw'             => sprintf(__('%1$s Styling Checkbox / Radio / Acceptance controls » %2$s',
						'uael'),
						'<a href="https://uaelementor.com/docs/styling-controls-in-wpforms-styler-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);

			$this->add_control(
				'help_doc_2',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s Doc Link */
					'raw'             => sprintf(__('%1$s Unable to see WPForms Styler widget? » %2$s',
						'uael'),
						'<a href="https://uaelementor.com/docs/unable-to-see-wpforms-styler-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);

			$this->add_control(
				'help_doc_4',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s Doc Link */
					'raw'             => sprintf(__('%1$s How to display your form in a single Line? » %2$s',
						'uael'),
						'<a href="https://uaelementor.com/docs/how-to-display-your-form-in-a-single-line/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);

			$this->end_controls_section();
		}
	}

	/**
	 * Render WPForms Styler output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.15.0
	 * @access protected
	 */
	protected function render(){

		if ((!class_exists('WPForms_Pro')) && (!class_exists('WPForms_Lite'))){
			return;
		}

		$settings      = $this->get_settings_for_display();
		$field_options = [];

		$forms = $this->get_wp_forms();

		$html = '';

		if (!empty($forms) && !isset($forms[- 1])){
			if ('0' === $settings['select_form']){
				$html = __('Please select a WPForm.', 'uael');
			}else{
				?>
                <div class="uael-wpf-container">
                    <div class="uael-wpf uael-wpf-style elementor-clickable">
						<?php
						if ($settings['select_form']) {

						$title       = FALSE;
						$description = FALSE;

						if ('default' === $settings['form_title_option']) {
							$title       = TRUE;
							$description = TRUE;
						} elseif ('custom' === $settings['form_title_option']) {

						if ('' !== $settings['form_title']) {
						?>
                        <<?php echo $settings['form_title_tag']; ?> class="wpforms-title"><?php echo $settings['form_title']; ?></<?php echo $settings['form_title_tag']; ?>>
					<?php
					}

					if ('' !== $settings['form_desc']){
						?>
                        <div class="wpforms-description"><?php echo $settings['form_desc']; ?></div>
						<?php
					}
					}

					echo do_shortcode('[wpforms id=' . $settings['select_form'] . ' title="' . $title . '" description="' . $description . '"]');
					}
					?>
                </div>                </div>
				<?php
			}
		}else{
			$html = __('You have not added any WPForms yet.', 'uael');
		}
		echo $html;
	}
}
