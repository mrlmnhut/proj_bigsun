<?php
/**
 * UAEL Config.
 *
 * @package UAEL
 */

namespace UltimateElementor\Classes;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Class UAEL_Config.
 */
class UAEL_Config{


	/**
	 * Widget List
	 *
	 * @var widget_list
	 */
	public static $widget_list = NULL;

	/**
	 * Post skins List
	 *
	 * @var post_skins_list
	 */
	public static $post_skins_list = NULL;

	/**
	 * Get Widget List.
	 *
	 * @return array The Widget List.
	 * @since 0.0.1
	 *
	 */
	public static function get_widget_list(){
		if (NULL === self::$widget_list){
			self::$widget_list = [
				'Advanced_Heading'  => [
					'slug'      => 'uael-advanced-heading',
					'title'     => __('Advanced Heading', 'uael'),
					'keywords'  => ['uael', 'heading', 'advanced'],
					'icon'      => 'uael-icon-adv-heading',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/advanced-heading/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'BaSlider'          => [
					'slug'      => 'uael-ba-slider',
					'title'     => __('Before After Slider', 'uael'),
					'keywords'  => ['uael', 'slider', 'before', 'after'],
					'icon'      => 'uael-icon-before-after',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/before-after-slider/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin',
				],
				'Business_Hours'    => [
					'slug'      => 'uael-business-hours',
					'title'     => __('Business Hours', 'uael'),
					'keywords'  => ['uael', 'business', 'hours', 'schedule'],
					'icon'      => 'uael-icon-business-hours',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/business-hours/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'CfStyler'          => [
					'slug'      => 'uael-cf7-styler',
					'title'     => __('Contact Form 7 Styler', 'uael'),
					'keywords'  => ['uael', 'form', 'cf7', 'contact', 'styler'],
					'icon'      => 'uael-icon-cf7-form',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/contact-form-7-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'ContentToggle'     => [
					'slug'      => 'uael-content-toggle',
					'title'     => __('Content Toggle', 'uael'),
					'keywords'  => ['uael', 'toggle', 'content', 'show', 'hide'],
					'icon'      => 'uael-icon-content-toggle',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/content-toggle/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Dual_Heading'      => [
					'slug'      => 'uael-dual-color-heading',
					'title'     => __('Dual Color Heading', 'uael'),
					'keywords'  => ['uael', 'dual', 'heading', 'color'],
					'icon'      => 'uael-icon-dual-col',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/dual-color-heading/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin',
				],
				'Fancy_Heading'     => [
					'slug'      => 'uael-fancy-heading',
					'title'     => __('Fancy Heading', 'uael'),
					'keywords'  => ['uael', 'fancy', 'heading', 'ticking', 'animate'],
					'icon'      => 'uael-icon-fancy-text',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/fancy-heading/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'GoogleMap'         => [
					'slug'         => 'uael-google-map',
					'title'        => __('Google Map', 'uael'),
					'keywords'     => ['uael', 'google', 'map', 'location', 'address'],
					'icon'         => 'uael-icon-google-map',
					'title_url'    => '#',
					'default'      => TRUE,
					'setting_url'  => admin_url('options-general.php?page=' . UAEL_SLUG . '&action=integration'),
					'setting_text' => __('Settings', 'uael'),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/google-maps/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'GfStyler'          => [
					'slug'      => 'uael-gf-styler',
					'title'     => __('Gravity Form Styler', 'uael'),
					'keywords'  => ['uael', 'form', 'gravity', 'gf', 'styler'],
					'icon'      => 'uael-icon-gravity-form',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/gravity-form-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Image_Gallery'     => [
					'slug'      => 'uael-image-gallery',
					'title'     => __('Image Gallery', 'uael'),
					'keywords'  => ['uael', 'image', 'gallery', 'carousel', 'slider', 'layout'],
					'icon'      => 'uael-icon-img-gallery',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/image-gallery/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Retina_Image'      => [
					'slug'      => 'uael-retina-image',
					'title'     => __('Retina Image', 'uael'),
					'keywords'  => ['uael', 'retina', 'image', '2ximage'],
					'icon'      => 'uael-icon-retina-image-1',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/retina-image/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Infobox'           => [
					'slug'      => 'uael-infobox',
					'title'     => __('Info Box', 'uael'),
					'keywords'  => ['uael', 'info', 'box', 'bar'],
					'icon'      => 'uael-icon-info-box',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/info-box/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Modal_Popup'       => [
					'slug'      => 'uael-modal-popup',
					'title'     => __('Modal Popup', 'uael'),
					'keywords'  => ['uael', 'modal', 'popup', 'lighbox'],
					'icon'      => 'uael-icon-popup',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/modal-popup/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'CafStyler'         => [
					'slug'      => 'uael-caf-styler',
					'title'     => __('Caldera Form Styler', 'uael'),
					'keywords'  => ['uael', 'caldera', 'form', 'styler'],
					'icon'      => 'uael-icon-caldera-form',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/caldera-form-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Buttons'           => [
					'slug'      => 'uael-buttons',
					'title'     => __('Multi Buttons', 'uael'),
					'keywords'  => ['uael', 'buttons', 'multi', 'call to action', 'cta'],
					'icon'      => 'uael-icon-button',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/multi-buttons/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Price_Table'       => [
					'slug'      => 'uael-price-table',
					'title'     => __('Price Box', 'uael'),
					'keywords'  => ['uael', 'price', 'table', 'box', 'pricing'],
					'icon'      => 'uael-icon-price-table',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/price-box/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Price_List'        => [
					'slug'      => 'uael-price-list',
					'title'     => __('Price List', 'uael'),
					'keywords'  => ['uael', 'price', 'list', 'pricing'],
					'icon'      => 'uael-icon-price-list',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/price-list/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Table'             => [
					'slug'      => 'uael-table',
					'title'     => __('Table', 'uael'),
					'keywords'  => ['uael', 'table', 'sort', 'search'],
					'icon'      => 'uael-icon-table',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/table/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Table_of_Contents' => [
					'slug'      => 'uael-table-of-contents',
					'title'     => __('Table of Contents', 'uael'),
					'keywords'  => ['uael', 'table of contents', 'content', 'list', 'toc', 'index'],
					'icon'      => 'uael-icon-toc-2',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/table-of-contents/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Woo_Add_To_Cart'   => [
					'slug'      => 'uael-woo-add-to-cart',
					'title'     => __('Woo - Add To Cart', 'uael'),
					'keywords'  => ['uael', 'woo', 'cart', 'add to cart', 'products'],
					'icon'      => 'uael-icon-woo-cart',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/woo-add-to-cart/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Woo_Categories'    => [
					'slug'      => 'uael-woo-categories',
					'title'     => __('Woo - Categories', 'uael'),
					'keywords'  => ['uael', 'woo', 'categories', 'taxomonies', 'products'],
					'icon'      => 'uael-icon-woo-cat',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/woo-categories/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Woo_Products'      => [
					'slug'      => 'uael-woo-products',
					'title'     => __('Woo - Products', 'uael'),
					'keywords'  => ['uael', 'woo', 'products'],
					'icon'      => 'uael-icon-woo-grid',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/woo-products/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Hotspot'           => [
					'slug'      => 'uael-hotspot',
					'title'     => __('Hotspot', 'uael'),
					'keywords'  => ['uael', 'hotspot', 'tour'],
					'icon'      => 'uael-icon-hotspot',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/hotspot/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Posts'             => [
					'slug'         => 'uael-posts',
					'title'        => __('Posts', 'uael'),
					'keywords'     => ['uael', 'post', 'grid', 'masonry', 'carousel', 'content grid', 'content'],
					'icon'         => 'uael-icon-post-grid',
					'title_url'    => '#',
					'default'      => TRUE,
					'setting_url'  => admin_url('options-general.php?page=' . UAEL_SLUG . '&action=post'),
					'setting_text' => __('Settings', 'uael'),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/posts/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Timeline'          => [
					'slug'      => 'uael-timeline',
					'title'     => __('Timeline', 'uael'),
					'keywords'  => ['uael', 'timeline', 'history', 'scroll', 'post', 'content timeline'],
					'icon'      => 'uael-icon-timeline',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/timeline/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Video_Gallery'     => [
					'slug'      => 'uael-video-gallery',
					'title'     => __('Video Gallery', 'uael'),
					'keywords'  => ['uael', 'video', 'youtube', 'wistia', 'gallery', 'vimeo'],
					'icon'      => 'uael-icon-video-gallery',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/video-gallery/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Video'             => [
					'slug'      => 'uael-video',
					'title'     => __('Video', 'uael'),
					'keywords'  => ['uael', 'video', 'youtube', 'vimeo', 'wistia', 'sticky', 'drag', 'float', 'subscribe'],
					'icon'      => 'uael-icon-video',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/video/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'WpfStyler'         => [
					'slug'      => 'uael-wpf-styler',
					'title'     => __('WPForms Styler', 'uael'),
					'keywords'  => ['uael', 'form', 'wp', 'wpform', 'styler'],
					'icon'      => 'uael-icon-cf7-form',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/wpforms-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Countdown'         => [
					'slug'      => 'uael-countdown',
					'title'     => __('Countdown Timer', 'uael'),
					'keywords'  => ['uael', 'count', 'timer', 'countdown'],
					'icon'      => 'uael-icon-timer',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/countdown-timer/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Business_Reviews'  => [
					'slug'         => 'uael-business-reviews',
					'keywords'     => ['uael', 'reviews', 'wp reviews', 'business', 'wp business', 'google', 'rating', 'social', 'yelp'],
					'title'        => __('Business Reviews', 'uael'),
					'icon'         => 'uael-icon-business-reviews',
					'title_url'    => '#',
					'default'      => TRUE,
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/business-reviews/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
					'setting_url'  => admin_url('options-general.php?page=' . UAEL_SLUG . '&action=integration'),
					'setting_text' => __('Settings', 'uael'),
				],
				'Offcanvas'         => [
					'slug'      => 'uael-offcanvas',
					'title'     => __('Off - Canvas', 'uael'),
					'keywords'  => ['uael', 'off', 'offcanvas', 'off-canvas', 'canvas', 'template', 'floating'],
					'icon'      => 'uael-icon-off-canvas',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/off-canvas/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Marketing_Button'  => [
					'slug'      => 'uael-marketing-button',
					'title'     => __('Marketing Button', 'uael'),
					'keywords'  => ['uael', 'button', 'marketing', 'call to action', 'cta'],
					'icon'      => 'uael-icon-marketing-button',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/marketing-button/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Team_Member'       => [
					'slug'      => 'uael-team-member',
					'title'     => __('Team Member', 'uael'),
					'keywords'  => ['uael', 'team', 'member'],
					'icon'      => 'uael-icon-team-member',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/team-member/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Particles'         => [
					'slug'      => 'uael-particles',
					'title'     => __('Particle Backgrounds', 'uael'),
					'keywords'  => [],
					'icon'      => '',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/particles-background-extension/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'RegistrationForm'  => [
					'slug'         => 'uael-registration-form',
					'title'        => __('User Registration Form', 'uael'),
					'keywords'     => ['uael', 'form', 'register', 'registration', 'user'],
					'icon'         => 'uael-icon-registration-form',
					'title_url'    => '#',
					'default'      => TRUE,
					'setting_url'  => admin_url('options-general.php?page=' . UAEL_SLUG . '&action=integration'),
					'setting_text' => __('Settings', 'uael'),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/user-registration-form/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'Nav_Menu'          => [
					'slug'      => 'uael-nav-menu',
					'title'     => __('Navigation Menu', 'uael'),
					'keywords'  => ['uael', 'menu', 'nav', 'navigation', 'mega'],
					'icon'      => 'uael-icon-navigation-menu-4',
					'title_url' => '#',
					'default'   => TRUE,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/navigation-menu/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
				'LoginForm'         => [
					'slug'         => 'uael-login-form',
					'title'        => __('Login Form', 'uael'),
					'keywords'     => ['uael', 'form', 'login', 'facebook', 'google', 'user', 'fblogin'],
					'icon'         => 'uael-icon-uae-login-form-01',
					'title_url'    => '#',
					'default'      => TRUE,
					'setting_text' => __('Settings', 'uael'),
					'setting_url'  => admin_url('options-general.php?page=' . UAEL_SLUG . '&action=integration'),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/login-form/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				],
			];
		}

		return self::$widget_list;
	}

	/**
	 * Get Post skins.
	 *
	 * @return array Post skins.
	 * @since 1.21.0
	 *
	 */
	public static function get_post_skin_list(){

		if (NULL === self::$post_skins_list){
			self::$post_skins_list = [
				'Skin_Card'     => [
					'slug'    => 'uael-skin-card',
					'title'   => __('Card Skin', 'uael'),
					'default' => TRUE,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-card.png',
				],
				'Skin_Feed'     => [
					'slug'    => 'uael-skin-feed',
					'title'   => __('Creative Feed Skin', 'uael'),
					'default' => TRUE,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-feed.png',
				],
				'Skin_News'     => [
					'slug'    => 'uael-skin-news',
					'title'   => __('News Skin', 'uael'),
					'default' => TRUE,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-news.png',
				],
				'Skin_Business' => [
					'slug'    => 'uael-skin-business',
					'title'   => __('Business Skin', 'uael'),
					'default' => TRUE,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-business.png',
				],
			];
		}

		return self::$post_skins_list;
	}

	/**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_script(){
		$folder = UAEL_Helper::get_js_folder();
		$suffix = UAEL_Helper::get_js_suffix();

		$js_files = [
			'uael-frontend-script'   => [
				'path'      => 'assets/' . $folder . '/uael-frontend' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-cookie-lib'        => [
				'path'      => 'assets/' . $folder . '/js_cookie' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-modal-popup'       => [
				'path'      => 'assets/' . $folder . '/uael-modal-popup' . $suffix . '.js',
				'dep'       => ['jquery', 'uael-cookie-lib'],
				'in_footer' => TRUE,
			],
			'uael-offcanvas'         => [
				'path'      => 'assets/' . $folder . '/uael-offcanvas' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-twenty-twenty'     => [
				'path'      => 'assets/' . $folder . '/jquery_twentytwenty' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-move'              => [
				'path'      => 'assets/' . $folder . '/jquery_event_move' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-fancytext-typed'   => [
				'path'      => 'assets/' . $folder . '/typed' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-fancytext-slidev'  => [
				'path'      => 'assets/' . $folder . '/rvticker' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-google-maps'       => [
				'path'      => 'assets/' . $folder . '/uael-google-map' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-hotspot'           => [
				'path'      => 'assets/' . $folder . '/tooltipster' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-posts'             => [
				'path'      => 'assets/' . $folder . '/uael-posts' . $suffix . '.js',
				'dep'       => ['jquery', 'imagesloaded'],
				'in_footer' => TRUE,
			],
			'uael-business-reviews'  => [
				'path'      => 'assets/' . $folder . '/uael-business-reviews' . $suffix . '.js',
				'dep'       => ['jquery', 'imagesloaded'],
				'in_footer' => TRUE,
			],
			'uael-isotope'           => [
				'path'      => 'assets/js/isotope.pkgd.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-woocommerce'       => [
				'path'      => 'assets/' . $folder . '/uael-woocommerce' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-datatable'         => [
				'path'      => 'assets/js/jquery.datatables.min.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-table'             => [
				'path'      => 'assets/' . $folder . '/uael-table' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-table-of-contents' => [
				'path'      => 'assets/' . $folder . '/uael-table-of-contents' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-particles'         => [
				'path'      => 'assets/' . $folder . '/uael-particles' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-registration'      => [
				'path'      => 'assets/' . $folder . '/uael-registration' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			/* Libraries */
			'uael-element-resize'    => [
				'path'      => 'assets/lib/jquery-element-resize/jquery_resize.min.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-isotope'           => [
				'path'      => 'assets/lib/isotope/isotope.min.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-infinitescroll'    => [
				'path'      => 'assets/lib/infinitescroll/jquery.infinitescroll.min.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-fancybox'          => [
				'path'      => 'assets/lib/fancybox/jquery_fancybox.min.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-justified'         => [
				'path'      => 'assets/lib/justifiedgallery/justifiedgallery.min.js',
				'dep'       => ['jquery', 'uael-frontend-script'],
				'in_footer' => TRUE,
			],
			'uael-countdown'         => [
				'path'      => 'assets/' . $folder . '/uael-countdown' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
			'uael-nav-menu'          => [
				'path'      => 'assets/' . $folder . '/uael-nav-menu' . $suffix . '.js',
				'dep'       => ['jquery'],
				'in_footer' => TRUE,
			],
		];

		return $js_files;
	}

	/**
	 * Returns Style array.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_style(){
		$folder = UAEL_Helper::get_css_folder();
		$suffix = UAEL_Helper::get_css_suffix();

		if (UAEL_Helper::is_script_debug()){
			$css_files = [
				'uael-info-box'          => [
					'path' => 'assets/css/modules/info-box.css',
					'dep'  => [],
				],
				'uael-heading'           => [
					'path' => 'assets/css/modules/heading.css',
					'dep'  => [],
				],
				'uael-ba-slider'         => [
					'path' => 'assets/css/modules/ba-slider.css',
					'dep'  => [],
				],
				'uael-buttons'           => [
					'path' => 'assets/css/modules/buttons.css',
					'dep'  => [],
				],
				'uael-modal-popup'       => [
					'path' => 'assets/css/modules/modal-popup.css',
					'dep'  => [],
				],
				'uael-offcanvas'         => [
					'path' => 'assets/css/modules/offcanvas.css',
					'dep'  => [],
				],
				'uael-content-toggle'    => [
					'path' => 'assets/css/modules/content-toggle.css',
					'dep'  => [],
				],
				'uael-caf-styler'        => [
					'path' => 'assets/css/modules/caf-styler.css',
					'dep'  => [],
				],
				'uael-business-hours'    => [
					'path' => 'assets/css/modules/business-hours.css',
					'dep'  => [],
				],
				'uael-cf7-styler'        => [
					'path' => 'assets/css/modules/cf-styler.css',
					'dep'  => [],
				],
				'uael-gf-styler'         => [
					'path' => 'assets/css/modules/gform-styler.css',
					'dep'  => [],
				],
				'uael-hotspot'           => [
					'path' => 'assets/css/modules/hotspot.css',
					'dep'  => [],
				],
				'uael-post'              => [
					'path' => 'assets/css/modules/post.css',
					'dep'  => [],
				],
				'uael-post-card'         => [
					'path' => 'assets/css/modules/post-card.css',
					'dep'  => [],
				],
				'uael-post-event'        => [
					'path' => 'assets/css/modules/post-event.css',
					'dep'  => [],
				],
				'uael-post-feed'         => [
					'path' => 'assets/css/modules/post-feed.css',
					'dep'  => [],
				],
				'uael-post-news'         => [
					'path' => 'assets/css/modules/post-news.css',
					'dep'  => [],
				],
				'uael-post-carousel'     => [
					'path' => 'assets/css/modules/post-carousel.css',
					'dep'  => [],
				],
				'uael-post-business'     => [
					'path' => 'assets/css/modules/post-business.css',
					'dep'  => [],
				],
				'uael-video-gallery'     => [
					'path' => 'assets/css/modules/video-gallery.css',
					'dep'  => [],
				],
				'uael-fancybox'          => [
					'path' => 'assets/css/modules/jquery.fancybox.min.css',
					'dep'  => [],
				],
				'uael-price-list'        => [
					'path' => 'assets/css/modules/price-list.css',
					'dep'  => [],
				],
				'uael-price-table'       => [
					'path' => 'assets/css/modules/price-table.css',
					'dep'  => [],
				],
				'uael-table'             => [
					'path' => 'assets/css/modules/table.css',
					'dep'  => [],
				],
				'uael-table-of-contents' => [
					'path' => 'assets/css/modules/table-of-contents.css',
					'dep'  => [],
				],
				'uael-image-gallery'     => [
					'path' => 'assets/css/modules/image-gallery.css',
					'dep'  => [],
				],
				'uael-common'            => [
					'path' => 'assets/css/modules/common.css',
					'dep'  => [],
				],
				'uael-timeline'          => [
					'path' => 'assets/css/modules/timeline.css',
					'dep'  => [],
				],
				'uael-video'             => [
					'path' => 'assets/css/modules/video.css',
					'dep'  => [],
				],
				'uael-team-member'       => [
					'path' => 'assets/css/modules/team-member.css',
					'dep'  => [],
				],
				'uael-wpf-styler'        => [
					'path' => 'assets/css/modules/wpf-styler.css',
					'dep'  => [],
				],
				'uael-countdown'         => [
					'path' => 'assets/css/modules/countdown.css',
					'dep'  => [],
				],
				'uael-business-reviews'  => [
					'path' => 'assets/css/modules/business-reviews.css',
					'dep'  => [],
				],
				'uael-particles'         => [
					'path' => 'assets/css/modules/particles.css',
					'dep'  => [],
				],
				'uael-registration-form' => [
					'path' => 'assets/css/modules/registration-form.css',
					'dep'  => [],
				],
				'uael-google-maps'       => [
					'path' => 'assets/css/modules/google-map.css',
					'dep'  => [],
				],
				'uael-login-form'        => [
					'path' => 'assets/css/modules/login-form.css',
					'dep'  => [],
				],
				'uael-nav-menu'          => [
					'path' => 'assets/css/modules/nav-menu.css',
					'dep'  => [],
				],
			];
		}else{
			$css_files = [
				'uael-frontend' => [
					'path' => 'assets/min-css/uael-frontend.min.css',
					'dep'  => [],
				],
			];
		}

		if (is_rtl()){
			$css_files = [
				'uael-frontend' => [
					// This is autogenerated rtl file.
					'path' => 'assets/min-css/uael-frontend-rtl.min.css',
					'dep'  => [],
				],
			];
		}

		if (class_exists('WooCommerce')){
			$css_files['uael-woocommerce'] = [
				'path' => 'assets/' . $folder . '/uael-woocommerce' . $suffix . '.css',
				'dep'  => [],
			];
		}

		return $css_files;
	}
}
