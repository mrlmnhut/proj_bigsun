<?php
/**
 * @param $wp_customize
 */
function bigsunCustomizeRegister($wp_customize){

	$wp_customize->add_section('bigsun_options', [
		'title'    => __('Tùy chọn', 'bigsun'),
		'priority' => 10,
	]);

	$wp_customize->add_setting('bcolor', [
		'default' => '#333',
	]);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'main_color', [
				'label'    => __('Primary Color', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'bcolor'
			]
		)
	);

	$wp_customize->add_setting('bnav-bg', [
		'default' => '',
	]);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'bnav-bg', [
				'label'    => __('Background Menu', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'bnav-bg',
			]
		)
	);

	$wp_customize->add_setting('blogo', [
		'default' => '',
	]);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'blogo', [
				'label'    => __('Upload a logo', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'blogo',
			]
		)
	);

	$wp_customize->add_setting('bheader', [
		'default' => '',
	]);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'xheader', [
				'label'    => __('Header Image', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'bheader',
			]
		)
	);
	$wp_customize->add_setting('header_text_logo', [
		'default' => '',
	]);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'header_text_logo', [
				'label'    => __('Header text logo', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'header_text_logo',
				'type'     => 'textarea',
			]
		)
	);

	$wp_customize->add_setting('footer_text', [
		'default' => '',
	]);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'footer_text', [
				'label'    => __('Footer text', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'footer_text',
				'type'     => 'textarea',
			]
		)
	);

	$wp_customize->add_setting('custom_styles', [
		'default' => '',
	]);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'custom_styles', [
				'label'    => __('Custom Styles', 'bigsun'),
				'section'  => 'bigsun_options',
				'settings' => 'custom_styles',
				'type'     => 'textarea',
			]
		)
	);
}

add_action('customize_register', 'bigsunCustomizeRegister');


/*==============Nhung file css================*/
function addThemeScripts(){

	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('reset-style', get_template_directory_uri() . '/assets/css/reset.css', 'all');
	wp_enqueue_style('lineawesome-style',
		get_template_directory_uri() . '/fonts/line-awesome/css/line-awesome.css', 'all');
	wp_enqueue_style('bootstrap-style',
		get_template_directory_uri() . '/assets/css/bootstrap.min.css', 'all');
	wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css', 'all');
	wp_enqueue_script('jquery-script',
		get_template_directory_uri() . '/assets/js/jquery-3.4.1.min.js');
	wp_enqueue_script('bootstrap-script',
		get_template_directory_uri() . '/assets/js/bootstrap.min.js');

}

add_action('wp_enqueue_scripts', 'addThemeScripts');


define('THEME_URL', get_stylesheet_directory());

if (!function_exists('themeSetup')){
	function themeSetup(){

		/* Them link RSS */
		add_theme_support('automatic-feed-links');

		/* Them post thumbnails */
		add_theme_support('post-thumbnails');

		/* Them post formats */
		add_theme_support('post-formats', [
			'aside',
			'gallery']);

		/* Them title tag */
		add_theme_support('title-tag');


		$args = [
			'name'          => __('Main Sidebar', 'bigsun'),
			'id'            => 'sidebar',
			'description'   => 'Main left sidebar',
			'class'         => '',
			'before_widget' => '<div class="box">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		];
		register_sidebar($args);
	}

	add_action('init', 'themeSetup');
}

/*
 * Thiết lập hàm hiển thị menu
 * menu( $slug )
 */
if (!function_exists('menu')){
	/**
	 * @param $slug
	 */
	function menu($slug){
		$menu = [
			'theme_location' => $slug,
			'container'      => 'false',
			'menu_class'     => 'navbar-nav ml-auto'
		];
		wp_nav_menu($menu);
	}
}