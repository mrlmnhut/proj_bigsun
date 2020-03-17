<?php
/**
 * UAEL Table of Contents.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\TableOfContents\Widgets;


// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use UltimateElementor\Base\Common_Widget;

// UltimateElementor Classes.

if (!defined('ABSPATH')){
	exit;   // Exit if accessed directly.
}

/**
 * Class Table of contents.
 */
class Table_Of_Contents extends Common_Widget{

	/**
	 * Table Of Contents class var.
	 *
	 * @var $settings array.
	 */
	public $settings = [];

	/**
	 * Retrieve Table Of Contents Widget name.
	 *
	 * @return string Widget name.
	 * @since 1.19.0
	 * @access public
	 *
	 */
	public function get_name(){
		return parent::get_widget_slug('Table_of_Contents');
	}

	/**
	 * Retrieve Table Widget title.
	 *
	 * @return string Widget title.
	 * @since 1.19.0
	 * @access public
	 *
	 */
	public function get_title(){
		return parent::get_widget_title('Table_of_Contents');
	}

	/**
	 * Retrieve Table Widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.19.0
	 * @access public
	 *
	 */
	public function get_icon(){
		return parent::get_widget_icon('Table_of_Contents');
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @return string Widget icon.
	 * @since 1.19.0
	 * @access public
	 *
	 */
	public function get_keywords(){
		return parent::get_widget_keywords('Table_of_Contents');
	}

	/**
	 * Retrieve the list of scripts the toc widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 * @since 1.19.0
	 * @access public
	 *
	 */
	public function get_script_depends(){
		return ['uael-table-of-contents'];

	}

	/**
	 * Register controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function _register_controls(){

		$this->register_table_of_contents_controls();
		$this->register_heading_to_display_controls();
		$this->register_exclude_content_controls();
		$this->register_hide_button_controls();
		$this->register_scroll_heading_controls();
		$this->register_helpful_information();

		$this->register_general_controls();
		$this->register_heading_controls();
		$this->register_separator_controls();
		$this->register_contents_controls();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_table_of_contents_controls(){

		$this->start_controls_section(
			'section_heading_fields',
			[
				'label' => __('Title', 'uael'),
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label'       => __('Enter Title Text', 'uael'),
				'default'     => __('Table of Contents', 'uael'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => TRUE,
				],
				'label_block' => TRUE,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_heading_to_display_controls(){
		$this->start_controls_section(
			'section_contents_fields',
			[
				'label' => __('Content', 'uael'),
			]
		);

		$this->add_control(
			'heading_select',
			[
				'label'       => __('Select heading tags to display', 'uael'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => TRUE,
				'options'     => [
					'h1' => __('H1', 'uael'),
					'h2' => __('H2', 'uael'),
					'h3' => __('H3', 'uael'),
					'h4' => __('H4', 'uael'),
					'h5' => __('H5', 'uael'),
					'h6' => __('H6', 'uael'),
				],
				'default'     => ['h1', 'h2', 'h3'],
				'label_block' => TRUE,

			]
		);

		$this->add_control(
			'bullet_icon',
			[
				'label'       => __('List Icon Style', 'uael'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'unordered_list',
				'label_block' => FALSE,
				'options'     => [
					'none'           => __('None', 'uael'),
					'unordered_list' => __('Bullets', 'uael'),
					'ordered_list'   => __('Numbers', 'uael'),
				],
			]
		);

		$this->add_control(
			'heading_separator_style',
			[
				'label'        => __('Separator', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'heading_title!' => '',
				],
			]
		);

		$this->end_controls_section();

	}


	/**
	 * Register Advanced Heading Separator Controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_exclude_content_controls(){

		$this->start_controls_section(
			'exclude_headings',
			[
				'label' => __('Exclude Headings', 'uael'),
			]
		);

		$this->add_control(
			'exclude_headings_doc',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __('Add the CSS class <b>uae-toc-hide-heading</b> to the heading you want to exclude from the table.',
					'uael'),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		if (parent::is_internal_links()){
			$this->add_control(
				'exclude_doc_link',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf(__('%1$s Learn More » %2$s', 'uael'),
						'<a href="https://uaelementor.com/docs/exclude-specific-headings-from-table/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);
		}

		$this->end_controls_section();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_hide_button_controls(){

		$this->start_controls_section(
			'hide_button',
			[
				'label'     => __('Collapsible', 'uael'),
				'condition' => [
					'heading_title!' => '',
				],
			]
		);
		$this->add_control(
			'collapsible',
			[
				'label'        => __('Make Content Collapsible', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'uael'),
				'label_off'    => __('No', 'uael'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'auto_collapsible',
			[
				'label'        => __('Keep Collapsed Initially', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'uael'),
				'label_off'    => __('No', 'uael'),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'collapsible' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'toc_icon_size',
			[
				'label'      => __('Icon Size', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'default'    => [
					'size' => 20,
					'unit' => 'px',
				],
				'condition'  => [
					'collapsible' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-toc-switch .uael-icon:before' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}; text-align: center;',
				],
			]
		);

		$this->add_control(
			'toc_switch_icon_color',
			[
				'label'     => __('Icon Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-toc-header .uael-toc-switch .uael-icon:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'collapsible' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Registers all controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_scroll_heading_controls(){

		$this->start_controls_section(
			'scroll',
			[
				'label' => __('Scroll', 'uael'),
			]
		);

		$this->add_control(
			'scroll_to_top',
			[
				'label'        => __('Scroll to Top', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'uael'),
				'label_off'    => __('Hide', 'uael'),
				'description'  => __('This will add a Scroll to Top arrow at the bottom of page.',
					'uael'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'scroll_to_top_size',
			[
				'label'      => __('Size', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['em'],
				'range'      => [
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition'  => [
					'scroll_to_top' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-scroll-top-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; font-size: calc( {{SIZE}}px / 2 );',
				],
			]
		);

		$this->add_control(
			'scroll_to_top_color',
			[
				'label'     => __('Icon Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-scroll-top-icon, {{WRAPPER}} a.uael-scroll-top-icon:hover, {{WRAPPER}} a.uael-scroll-top-icon:focus' => 'color: {{VALUE}};',
				],
				'condition' => [
					'scroll_to_top' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_to_top_bgcolor',
			[
				'label'     => __('Background Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uael-scroll-top-icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'scroll_to_top' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_toc',
			[
				'label'        => __('Smooth Scroll', 'uael'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('YES', 'uael'),
				'label_off'    => __('NO', 'uael'),
				'description'  => __('Smooth scroll upto destination.', 'uael'),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'scroll_time',
			[
				'label'      => __('Scroll Animation Delay (ms)', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'max' => 2000,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 500,
				],
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'scroll_toc',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'scroll_to_top',
							'operator' => '==',
							'value'    => 'yes',
						],
					],
				],

			]
		);

		$this->add_responsive_control(
			'scroll_offset',
			[
				'label'      => __('Smooth Scroll Offset (px)', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'max' => 100,
					],
				],
				'condition'  => [
					'scroll_toc' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Helpful Information.
	 *
	 * @since 1.19.0
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
						'<a href="https://uaelementor.com/docs/introducing-table-of-contents-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);

			$this->add_control(
				'help_doc_2',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf(__('%1$s How to exclude specific headings Table of Contents? » %2$s',
						'uael'),
						'<a href="https://uaelementor.com/docs/exclude-specific-headings-from-table/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">',
						'</a>'),
					'content_classes' => 'uael-editor-doc',
				]
			);

			$this->end_controls_section();
		}
	}


	/**
	 * Registers general style controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_general_controls(){
		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Container', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'toc_padding',
			[
				'label'      => __('Padding', 'uael'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '40',
					'bottom' => '40',
					'left'   => '40',
					'right'  => '40',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-toc-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Registers heading style controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_heading_controls(){

		$this->start_controls_section(
			'content_heading',
			[
				'label' => __('Title', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_text_align',
			[
				'label'        => __('Alignment', 'uael'),
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
				'default'      => 'left',
				'selectors'    => [
					'{{WRAPPER}} .uael-toc-heading' => 'text-align: {{VALUE}};',
				],
				'prefix_class' => 'uael%s-heading-align-',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => __('Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-toc-heading, {{WRAPPER}} .uael-toc-switch .uael-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uael-toc-heading, {{WRAPPER}} .uael-toc-heading a',
			]
		);

		$this->add_responsive_control(
			'heading_bottom_space',
			[
				'label'     => __('Title Bottom Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-toc-header'                                     => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-toc-auto-collapse .uael-toc-header,
					{{WRAPPER}} .uael-toc-hidden .uael-toc-header' => 'margin-bottom: 0px;',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Advanced Heading Image/Icon Controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_separator_controls(){

		$this->start_controls_section(
			'section_separator_line_style',
			[
				'label'      => __('Separator', 'uael'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'heading_separator_style',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'heading_title',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'heading_line_style',
			[
				'label'       => __('Style', 'uael'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'solid',
				'label_block' => FALSE,
				'options'     => [
					'solid'  => __('Solid', 'uael'),
					'dashed' => __('Dashed', 'uael'),
					'dotted' => __('Dotted', 'uael'),
					'double' => __('Double', 'uael'),
				],
				'condition'   => [
					'heading_separator_style' => 'yes',
				],
				'selectors'   => [
					'{{WRAPPER}} .uael-separator' => 'border-top-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_line_color',
			[
				'label'     => __('Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'condition' => [
					'heading_separator_style' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .uael-separator' => 'border-top-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_line_thickness',
			[
				'label'      => __('Thickness', 'uael'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'default'    => [
					'size' => 1,
					'unit' => 'px',
				],
				'condition'  => [
					'heading_separator_style' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .uael-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'separator_bottom_space',
			[
				'label'     => __('Separator Bottom Spacing', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-separator-parent' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Registers all controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_contents_controls(){

		$this->start_controls_section(
			'content',
			[
				'label' => __('Content', 'uael'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .uael-toc-content-wrapper, {{WRAPPER}} .uael-toc-empty-note',
			]
		);

		$this->add_responsive_control(
			'content_between_space',
			[
				'label'     => __('Spacing Between Content', 'uael'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'   => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .uael-toc-list li'                   => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-toc-content-wrapper #toc-li-0' => 'margin-top: 0px;',
				],
			]
		);

		$this->start_controls_tabs('content_tabs_style');

		$this->start_controls_tab(
			'content_normal',
			[
				'label' => __('Normal', 'uael'),
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __('Text Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-toc-content-wrapper a, {{WRAPPER}} .uael-toc-list li, {{WRAPPER}} .uael-toc-empty-note' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_hover',
			[
				'label' => __('Hover', 'uael'),
			]
		);

		$this->add_control(
			'content_hover_color',
			[
				'label'     => __('Hover Color', 'uael'),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .uael-toc-content-wrapper a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Display Separator.
	 *
	 * @param object $settings for settings.
	 *
	 * @since 1.19.0
	 * @access public
	 */
	public function render_separator($settings){
		if ('yes' === $settings['heading_separator_style'] && '' !== $settings['heading_title']){
			?>
            <div class="uael-separator-parent">
                <div class="uael-separator"></div>
            </div>
			<?php
		}
	}

	/**
	 * Render Woo Product Grid output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function render(){

		$settings = $this->get_settings_for_display();

		$head_data   = $settings['heading_select'];
		$hideshow    = $settings['collapsible'];
		$displayicon = '';

		$head_data = implode(',', $head_data);

		$this->add_inline_editing_attributes('heading_title', 'basic');

		$this->add_render_attribute(
			'parent-wrapper',
			[
				'class'         => 'uael-toc-main-wrapper',
				'data-headings' => $head_data,
			]
		);

		$this->add_render_attribute('list-parent-wrapper', 'data-scroll',
			$settings['scroll_time']['size']);

		if ('' !== $settings['scroll_offset_mobile']['size']){
			$this->add_render_attribute('list-parent-wrapper', 'data-scroll-offset-mobile',
				$settings['scroll_offset_mobile']['size']);
		}

		if ('' !== $settings['scroll_offset_tablet']['size']){
			$this->add_render_attribute('list-parent-wrapper', 'data-scroll-offset-tablet',
				$settings['scroll_offset_tablet']['size']);
		}

		if ('' !== $settings['scroll_offset']['size']){
			$this->add_render_attribute('list-parent-wrapper', 'data-scroll-offset',
				$settings['scroll_offset']['size']);
		}

		$this->add_render_attribute('hide-show-wrapper', 'data-hideshow', $hideshow);

		if ('yes' === $settings['collapsible']){
			$this->add_render_attribute('hide-show-wrapper', 'data-is-collapsible', 'yes');

			if ('yes' === $settings['auto_collapsible']){
				$this->add_render_attribute('parent-wrapper', 'class', 'uael-toc-auto-collapse');
			}else{
				$this->add_render_attribute('parent-wrapper', 'class', 'content-show');
			}
		}
		?>
        <div <?php echo $this->get_render_attribute_string('parent-wrapper'); ?> >
            <div class="uael-toc-wrapper">
                <div class="uael-toc-header">
                    <span class="uael-toc-heading elementor-inline-editing" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display('heading_title'); ?></span>
					<?php if ('yes' === $settings['collapsible']){ ?>
                        <div class="uael-toc-switch" <?php echo $this->get_render_attribute_string('hide-show-wrapper'); ?>>
                            <span class="uael-icon fa"></span>
                        </div>
					<?php } ?>
                </div>
				<?php $this->render_separator($settings); ?>
                <div class="uael-toc-toggle-content">
                    <div class="uael-toc-content-wrapper">
						<?php
						if ('unordered_list' === $settings['bullet_icon']){
							?>

                            <ul data-toc-headings="headings" class="uael-toc-list uael-toc-list-disc" <?php echo $this->get_render_attribute_string('list-parent-wrapper'); ?> ></ul>
						<?php }elseif ('ordered_list' === $settings['bullet_icon']){ ?>

                            <ol data-toc-headings="headings" class="uael-toc-list" <?php echo $this->get_render_attribute_string('list-parent-wrapper'); ?> ></ol>

						<?php }else{ ?>

                            <ul data-toc-headings="headings" class="uael-toc-list uael-toc-list-none" <?php echo $this->get_render_attribute_string('list-parent-wrapper'); ?> ></ul>
						<?php } ?>
                    </div>
                </div>
                <div class="uael-toc-empty-note">
                    <span><?php echo __('Add a header to begin generating the table of contents',
							'uael'); ?></span>
                </div>
            </div>
			<?php if ('yes' === $settings['scroll_to_top']){ ?>
                <a id="uael-scroll-top" class="uael-scroll-top-icon">
                    <span class="screen-reader-text">Scroll to Top</span>
                </a>
			<?php } ?>
        </div>
		<?php
	}

	/**
	 * Render TOC widgets output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function _content_template(){
		?>
        <#        function render_separator() {            if ( 'yes' === settings.heading_separator_style && '' !== settings.heading_title ) {            #>
        <div class="uael-separator-parent">
            <div class="uael-separator"></div>
        </div>            <#            }        }        var head_data = settings.heading_select;

        view.addRenderAttribute( 'parent-wrapper', {            'class': 'uael-toc-main-wrapper',            'data-headings': head_data.join()        });

        view.addRenderAttribute( 'list-parent-wrapper', 'data-scroll', settings.scroll_time.size );

        if ( '' !== settings.scroll_offset_mobile.size ) {            view.addRenderAttribute( 'list-parent-wrapper', 'data-scroll-offset-mobile', settings.scroll_offset_mobile.size );        }

        if ( '' !== settings.scroll_offset_tablet.size ) {            view.addRenderAttribute( 'list-parent-wrapper', 'data-scroll-offset-tablet', settings.scroll_offset_tablet.size );        }

        if ( '' !== settings.scroll_offset.size ) {            view.addRenderAttribute( 'list-parent-wrapper', 'data-scroll-offset', settings.scroll_offset.size );        }

        view.addRenderAttribute( 'hide-show-wrapper', 'data-hideshow', 'settings.collapsible' );

        if ( 'yes' === settings.collapsible ) {            view.addRenderAttribute( 'hide-show-wrapper', 'data-is-collapsible', 'yes' );

        if ( 'yes' === settings.auto_collapsible ) {                view.addRenderAttribute( 'parent-wrapper', 'class', 'uael-toc-auto-collapse' );            } else {                view.addRenderAttribute( 'parent-wrapper', 'class', 'content-show' );            }        }

        #>

        <div {{{ view.getRenderAttributeString( 'parent-wrapper' ) }}} >
        <div class="uael-toc-wrapper">
            <div class="uael-toc-header">
                <span class="uael-toc-heading elementor-inline-editing" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic">{{{ settings.heading_title }}}</span>
                <# if ( 'yes' === settings.collapsible ) { #>
                <div class="uael-toc-switch" {{{ view.getRenderAttributeString(
                'hide-show-wrapper' ) }}} >
                <span class="uael-icon fa"></span>
            </div>
            <# } #>
        </div>

        <# render_separator(); #>

        <div class="uael-toc-toggle-content">
            <div class="uael-toc-content-wrapper">
                <# if ( 'unordered_list' === settings.bullet_icon ) { #>
                <ul data-toc-headings="headings" class="uael-toc-list uael-toc-list-disc" {{{ view.getRenderAttributeString(
                'list-parent-wrapper' ) }}} ></ul>
                <# } else if ( 'ordered_list' === settings.bullet_icon ) { #>

                <ol data-toc-headings="headings" class="uael-toc-list" {{{ view.getRenderAttributeString(
                'list-parent-wrapper' ) }}} ></ol>

                <# } else { #>
                <ul data-toc-headings="headings" class="uael-toc-list uael-toc-list-none" {{{ view.getRenderAttributeString(
                'list-parent-wrapper' ) }}} ></ul>
                <# } #>
            </div>
        </div>

        <div class="uael-toc-empty-note">
            <span><?php echo __('Add a header to begin generating the table of contents',
					'uael'); ?></span>
        </div>

        </div>            <# if ( 'yes' === settings.scroll_to_top ) { #>
        <a id="uael-scroll-top" class="uael-scroll-top-icon">
            <span class="screen-reader-text">Scroll to Top</span>
        </a>            <# } #>        </div>

		<?php
	}
}
