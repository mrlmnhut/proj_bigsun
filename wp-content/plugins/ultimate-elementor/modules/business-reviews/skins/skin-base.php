<?php
/**
 * UAEL Business Reviews Skin - Base.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\BusinessReviews\Skins;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Skin_Base as Elementor_Skin_Base;
use Elementor\Widget_Base;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Class Skin_Base
 *
 * @property Reviews $parent
 */
abstract class Skin_Base extends Elementor_Skin_Base{

	/**
	 * Register control actions.
	 *
	 * @since 1.13.0
	 * @access protected
	 */
	protected function _register_controls_actions(){

		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_info_controls'], 20);
		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_date_controls'], 20);
		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_rating_controls'], 20);
		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_content_controls'], 20);

		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_box_style_controls'], 20);
		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_spacing_controls'], 20);
		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_navigation_controls'], 20);
		add_action('elementor/element/uael-business-reviews/section_filters_controls/after_section_end',
			[$this, 'register_typography_controls'], 20);
	}

	/**
	 * Register Business Reviews Image Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_info_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_info_controls',
			[
				'label' => __('Reviewer Info', 'uael'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'reviewer_image',
			[
				'label'        => __('<b>Reviewer Image</b>', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'prefix_class' => 'uael-review-image-enable-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'image_align',
			[
				'label'     => __('Image Position', 'uael'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'top'      => __('Above Name', 'uael'),
					'left'     => __('Left of Name', 'uael'),
					'all_left' => __('Left of all content', 'uael'),
				],
				'condition' => [
					$this->get_control_id('reviewer_image') => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label'     => __('Image Size', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 60,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 130,
					],
				],
				'condition' => [
					$this->get_control_id('reviewer_image') => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// This Overall alignment control in case of image top alignment condition.
		$this->add_control(
			'overall_align',
			[
				'label'        => __('Overall Alignment', 'uael'),
				'type'         => Controls_Manager::CHOOSE,
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
				'default'      => 'center',
				'toggle'       => FALSE,
				'condition'    => [
					$this->get_control_id('image_align') => 'top',
				],
				'prefix_class' => 'uael-reviews-align-',
			]
		);

		// This Overall alignment control in case of image left and all left alignment condition.
		$this->add_control(
			'overall_alignment_left',
			[
				'label'        => __('Overall Alignment', 'uael'),
				'type'         => Controls_Manager::CHOOSE,
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
				'default'      => 'center',
				'toggle'       => FALSE,
				'condition'    => [
					$this->get_control_id('reviewer_image') . '!' => 'yes',
					$this->get_control_id('image_align') . '!'    => 'top',
				],
				'prefix_class' => 'uael-reviews-align-',
			]
		);

		$this->add_control(
			'reviewer_name',
			[
				'label'        => __('<b>Reviewer Name</b>', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'reviewer_name_link',
			[
				'label'        => __('Link Name', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'uael'),
				'label_off'    => __('No', 'uael'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					$this->get_control_id('reviewer_name') => 'yes',
				],
			]
		);

		$this->add_control(
			'reviewer_name_color',
			[
				'label'     => __('Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-reviewer-name a, {{WRAPPER}} .uael-reviewer-name' => 'color: {{VALUE}}',
				],
				'condition' => [
					$this->get_control_id('reviewer_name') => 'yes',
				],
			]
		);

		$this->add_control(
			'review_source_icon',
			[
				'label'        => __('<b>Review Source Icon</b>', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
				'render_type'  => 'template',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Business Reviews Date Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_date_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_date_controls',
			[
				'label' => __('Review Date', 'uael'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'review_date',
			[
				'label'        => __('Review Date', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'review_date_type',
			[
				'label'     => __('Select Type', 'uael'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'relative',
				'options'   => [
					'default'  => __('Numeric', 'uael'),
					'relative' => __('Relative', 'uael'),
				],
				'condition' => [
					$this->get_control_id('review_date') => 'yes',
					'review_type'                        => 'google',
				],
			]
		);

		$this->add_control(
			'reviewer_date_color',
			[
				'label'     => __('Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'default'   => '#adadad',
				'selectors' => [
					'{{WRAPPER}} .uael-review-time' => 'color: {{VALUE}}',
				],
				'condition' => [
					$this->get_control_id('review_date') => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Register Business Reviews Star Rating Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_rating_controls(Widget_Base $widget){
		$this->parent = $widget;

		$this->start_controls_section(
			'section_rating_controls',
			[
				'label' => __('Rating', 'uael'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'review_rating',
			[
				'label'        => __('Star Rating', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'select_star_style',
			[
				'label'     => __('Star Icon Style', 'uael'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'custom',
				'options'   => [
					'default' => __('Default', 'uael'),
					'custom'  => __('Custom', 'uael'),
				],
				'condition' => [
					$this->get_control_id('review_rating') => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __('Icon Size', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review .uael-star-full, {{WRAPPER}} .uael-review .uael-star-empty' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$this->get_control_id('review_rating')     => 'yes',
					$this->get_control_id('select_star_style') => 'custom',
				],
			]
		);

		$this->add_control(
			'stars_color',
			[
				'label'     => __('Icon Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-review .uael-star-full' => 'color: {{VALUE}}',
				],
				'condition' => [
					$this->get_control_id('review_rating')     => 'yes',
					$this->get_control_id('select_star_style') => 'custom',
				],
			]
		);

		$this->add_control(
			'stars_unmarked_color',
			[
				'label'     => __('Unmarked Icon Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-review .uael-star-empty' => 'color: {{VALUE}}',
				],
				'condition' => [
					$this->get_control_id('review_rating')     => 'yes',
					$this->get_control_id('select_star_style') => 'custom',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Business Reviews Star Rating Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_content_controls(Widget_Base $widget){
		$this->parent = $widget;

		$this->start_controls_section(
			'section_content_controls',
			[
				'label' => __('Review Text', 'uael'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'review_content',
			[
				'label'        => __('Review Text', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'reviewer_content_color',
			[
				'label'     => __('Text Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					$this->get_control_id('review_content') => 'yes',
				],
			]
		);

		$this->add_control(
			'review_content_length',
			[
				'label'     => __('Text Length', 'uael'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 25,
				'condition' => [
					$this->get_control_id('review_content') => 'yes',
				],
			]
		);

		$this->add_control(
			'yelp_review_length_doc',
			[
				'type'            => Controls_Manager::RAW_HTML,
				/* translators: %s admin link */
				'raw'             => __('Yelp API allows fetching maximum 160 characters from a review.',
					'uael'),
				'content_classes' => 'uael-editor-doc',
				'condition'       => [
					'review_type!' => 'google',
				],
			]
		);

		$this->add_control(
			'read_more',
			[
				'label'     => __('Read More Text', 'uael'),
				'default'   => __('Read More »', 'uael'),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => TRUE,
				],
				'condition' => [
					$this->get_control_id('review_content') => 'yes',
				],
			]
		);

		$this->add_control(
			'reviewer_readmore_color',
			[
				'label'     => __('Read More Text Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.uael-reviews-read-more' => 'color: {{VALUE}};',
				],
				'condition' => [
					$this->get_control_id('review_content')  => 'yes',
					$this->get_control_id('read_more') . '!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Spacing Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_spacing_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_spacing',
			[
				'label' => __('Spacing', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label'     => __('Columns Gap', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 25,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review-wrap' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'     => __('Rows Gap', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 25,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'review_structure!' => 'carousel',
				],
			]
		);

		$this->add_responsive_control(
			'reviewer_image_spacing',
			[
				'label'     => __('Image Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .uael-review-image'                                                                                     => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-review-image-left .uael-review-image, {{WRAPPER}} .uael-review-image-all_left .uael-review-image' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: 0px;',
				],
				'condition' => [
					$this->get_control_id('reviewer_image') => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'reviewer_name_spacing',
			[
				'label'     => __('Name Bottom Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-reviewer-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'star_spacing',
			[
				'label'     => __('Star Rating Bottom Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-star-rating__wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_spacing',
			[
				'label'     => __('Review Date Bottom Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-review-time' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					$this->get_control_id('review_date') => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Business Reviews Date Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_box_style_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_styling',
			[
				'label' => __('Box', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'block_bg_color',
			[
				'label'     => __('Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .uael-review' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'block_padding',
			[
				'label'      => __('Padding', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => '30',
					'bottom' => '30',
					'right'  => '30',
					'left'   => '30',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'block_radius',
			[
				'label'      => __('Border Radius', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => '5',
					'bottom' => '5',
					'right'  => '5',
					'left'   => '5',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register carousel navigation controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_navigation_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_navigation',
			[
				'label'     => __('Navigation', 'uael'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation'       => ['arrows', 'dots', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label'     => __('Arrows', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation'       => ['arrows', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'        => __('Arrows Position', 'uael'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'outside',
				'options'      => [
					'inside'  => __('Inside', 'uael'),
					'outside' => __('Outside', 'uael'),
				],
				'prefix_class' => 'uael-reviews-carousel-arrow-',
				'condition'    => [
					'navigation'       => ['arrows', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'     => __('Arrows Size', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slider .slick-prev:before, {{WRAPPER}} .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation'       => ['arrows', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Arrows Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-slider .slick-prev:before, {{WRAPPER}} .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation'       => ['arrows', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __('Dots', 'uael'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation'       => ['dots', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __('Dots Size', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation'       => ['dots', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __('Dots Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation'       => ['dots', 'both'],
					'review_structure' => 'carousel',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Typography Controls.
	 *
	 * @param Widget_Base $widget Current Widget object.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function register_typography_controls(Widget_Base $widget){

		$this->parent = $widget;

		$this->start_controls_section(
			'section_typography',
			[
				'label' => __('Typography', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'label'    => __('Reviewer Name', 'uael'),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uael-reviewer-name a, {{WRAPPER}} .uael-reviewer-name',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_time_typography',
				'label'    => __('Review Date', 'uael'),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-review-time',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => __('Review Content', 'uael'),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .uael-review-content',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_typography',
				'label'    => __('Read More Text', 'uael'),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .uael-reviews-read-more',
			]
		);

		$this->end_controls_section();
	}

}
