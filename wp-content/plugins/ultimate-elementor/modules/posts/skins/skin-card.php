<?php
/**
 * UAEL Card Skin.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\Posts\Skins;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use UltimateElementor\Modules\Posts\TemplateBlocks\Skin_Init;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Class Skin_Card
 */
class Skin_Card extends Skin_Base{

	/**
	 * Get Skin Slug.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function get_id(){
		return 'card';
	}

	/**
	 * Get Skin Title.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function get_title(){
		return __('Card', 'uael');
	}

	/**
	 * Register controls on given actions.
	 *
	 * @since 1.7.0
	 * @access protected
	 */
	protected function _register_controls_actions(){

		parent::_register_controls_actions();

		add_action('elementor/element/uael-posts/card_section_title_field/before_section_end',
			[$this, 'register_update_title_controls']);

		add_action('elementor/element/uael-posts/card_section_general_field/before_section_end',
			[$this, 'register_update_general_controls']);

		add_action('elementor/element/uael-posts/card_section_image_field/before_section_end',
			[$this, 'register_update_image_controls']);

		add_action('elementor/element/uael-posts/card_section_design_blog/before_section_end',
			[$this, 'register_blog_design_controls']);

		add_action('elementor/element/uael-posts/card_section_design_layout/before_section_end',
			[$this, 'register_update_layout_controls']);
	}

	/**
	 * Register controls callback.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function register_sections(Widget_Base $widget){

		$this->parent = $widget;

		// Content Controls.
		$this->register_content_filters_controls();
		$this->register_content_slider_controls();
		$this->register_content_featured_controls();
		$this->register_content_image_controls();
		$this->register_content_title_controls();
		$this->register_content_meta_controls();
		$this->register_content_excerpt_controls();
		$this->register_content_cta_controls();

		// Style Controls.
		$this->register_style_layout_controls();
		$this->register_style_blog_controls();
		$this->register_style_pagination_controls();
		$this->register_style_featured_controls();
		$this->register_style_title_controls();
		$this->register_style_meta_controls();
		$this->register_style_excerpt_controls();
		$this->register_style_cta_controls();
		$this->register_style_navigation_controls();
	}

	/**
	 * Update General control.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function register_update_general_controls(){

		$this->update_control(
			'post_structure',
			[
				'default' => 'masonry',
			]
		);
	}

	/**
	 * Update Image control.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function register_update_image_controls(){

		$this->update_control(
			'image_position',
			[
				'default' => 'top',
				'options' => [
					'top'  => __('Top', 'uael'),
					'none' => __('None', 'uael'),
				],
			]
		);
		$this->remove_control('image_background_color');
	}

	/**
	 * Update Title control.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function register_update_title_controls(){

		$this->update_control(
			'title_tag',
			[
				'default'   => 'h4',
				'condition' => [
					$this->get_control_id('show_title') => 'yes',
				],
			]
		);
	}

	/**
	 * Update Layout control.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function register_update_layout_controls(){

		$this->update_control(
			'alignment',
			[
				'selectors' => [
					'{{WRAPPER}} .uael-post-wrapper'         => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .uael-post__separator-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_title',
			[
				'label'     => __('Separator', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_separator_height',
			[
				'label'      => __('Separator Width', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'size' => 1,
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-post__separator' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'card_separator_width',
			[
				'label'      => __('Separator Length ( In Percentage )', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default'    => [
					'size' => 100,
					'unit' => '%',
				],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-post__separator' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_spacing',
			[
				'label'     => __('Bottom Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'default'   => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .uael-post__separator' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'card_separator_color',
			[
				'label'     => __('Separator Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-post__separator' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_alignment',
			[
				'label'        => __('Separator Alignment', 'uael'),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => TRUE,
				'options'      => [
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
				'prefix_class' => 'uael-post__separator-',
			]
		);
	}

	/**
	 * Update Blog Design control.
	 *
	 * @since 1.7.0
	 * @access public
	 */
	public function register_blog_design_controls(){

		$this->update_control(
			'blog_bg_color',
			[
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .uael-post__content-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .uael-post__content-wrap',
			]
		);

		$this->add_control(
			'card_max_width',
			[
				'label'      => __('Box Max Width', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default'    => [
					'size' => 92,
					'unit' => '%',
				],
				'range'      => [
					'px' => [
						'min' => 50,
						'max' => 90,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-post__content-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'card_lift_up',
			[
				'label'      => __('Lift Up Box by', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'size' => 50,
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 90,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-post__inner-wrap:not(.uael-post__noimage) .uael-post__content-wrap' => 'margin-top: -{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'card_bottom_margin',
			[
				'label'      => __('Box Bottom Spacing', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default'    => [
					'size' => 15,
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-post__content-wrap'                  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-post__inner-wrap.uael-post__noimage' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wrap_blog_bg_color',
			[
				'label'     => __('Wrap Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f6f6f6',
				'selectors' => [
					'{{WRAPPER}} .uael-post__inner-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);
	}

	/**
	 * Render Main HTML.
	 *
	 * @since 1.7.0
	 * @access protected
	 */
	public function render(){

		$settings = $this->parent->get_settings_for_display();

		$skin = Skin_Init::get_instance($this->get_id());

		echo $skin->render($this->get_id(), $settings, $this->parent->get_id());
	}
}
