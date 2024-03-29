<?php
/**
 * Astra Sites Notices
 *
 * Closing notice on click on `astra-notice-close` class.
 *
 * If notice has the data attribute `data-repeat-notice-after="%2$s"` then notice close for that
 * SPECIFIC TIME. If notice has NO data attribute `data-repeat-notice-after="%2$s"` then notice
 * close for the CURRENT USER FOREVER.
 *
 * > Create custom close notice link in the notice markup. E.g.
 * `<a href="#" data-repeat-notice-after="<?php echo MONTH_IN_SECONDS; ?>"
 * class="astra-notice-close">` It close the notice for 30 days.
 *
 * @package Astra Sites
 * @since 1.4.0
 */

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

if (!class_exists('Astra_Notices')) :

	/**
	 * Astra_Notices
	 *
	 * @since 1.4.0
	 */
	class Astra_Notices{

		/**
		 * Notices
		 *
		 * @access private
		 * @var array Notices.
		 * @since 1.4.0
		 */
		private static $version = '1.1.5';

		/**
		 * Notices
		 *
		 * @access private
		 * @var array Notices.
		 * @since 1.4.0
		 */
		private static $notices = [];

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 * @since 1.4.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object initialized object of class.
		 * @since 1.4.0
		 */
		public static function get_instance(){
			if (!isset(self::$instance)){
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.4.0
		 */
		public function __construct(){
			add_action('admin_notices', [$this, 'show_notices'], 30);
			add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
			add_action('wp_ajax_astra-notice-dismiss', [$this, 'dismiss_notice']);
			add_filter('wp_kses_allowed_html', [$this, 'add_data_attributes'], 10, 2);
		}

		/**
		 * Filters and Returns a list of allowed tags and attributes for a given context.
		 *
		 * @param Array $allowedposttags Array of allowed tags.
		 * @param String $context Context type (explicit).
		 *
		 * @return Array
		 * @since 1.4.0
		 */
		public function add_data_attributes($allowedposttags, $context){
			$allowedposttags['a']['data-repeat-notice-after'] = TRUE;

			return $allowedposttags;
		}

		/**
		 * Add Notice.
		 *
		 * @param array $args Notice arguments.
		 *
		 * @return void
		 * @since 1.4.0
		 */
		public static function add_notice($args = []){
			self::$notices[] = $args;
		}

		/**
		 * Dismiss Notice.
		 *
		 * @return void
		 * @since 1.4.0
		 */
		public function dismiss_notice(){
			$notice_id           = (isset($_POST['notice_id'])) ? sanitize_key($_POST['notice_id']) : '';
			$repeat_notice_after = (isset($_POST['repeat_notice_after'])) ? absint($_POST['repeat_notice_after']) : '';
			$nonce               = (isset($_POST['nonce'])) ? sanitize_key($_POST['nonce']) : '';

			if (FALSE === wp_verify_nonce($nonce, 'astra-notices')){
				wp_send_json_error(_e('WordPress Nonce not validated.', 'uael'));
			}

			// Valid inputs?
			if (!empty($notice_id)){

				if (!empty($repeat_notice_after)){
					set_transient($notice_id, TRUE, $repeat_notice_after);
				}else{
					update_user_meta(get_current_user_id(), $notice_id, 'notice-dismissed');
				}

				wp_send_json_success();
			}

			wp_send_json_error();
		}

		/**
		 * Enqueue Scripts.
		 *
		 * @return void
		 * @since 1.4.0
		 */
		public function enqueue_scripts(){

			wp_register_script('astra-notices', self::_get_uri() . 'notices.js', ['jquery'],
				self::$version, TRUE);
			wp_enqueue_style('uael-notice-settings',
				UAEL_URL . 'admin/assets/uael-admin-notice.css', []);
			wp_localize_script(
				'astra-notices',
				'astraNotices',
				[
					'_notice_nonce' => wp_create_nonce('astra-notices'),
				]
			);
		}

		/**
		 * Rating priority sort
		 *
		 * @param array $array1 array one.
		 * @param array $array2 array two.
		 *
		 * @return array
		 * @since 1.5.2
		 */
		public function sort_notices($array1, $array2){
			if (!isset($array1['priority'])){
				$array1['priority'] = 10;
			}
			if (!isset($array2['priority'])){
				$array2['priority'] = 10;
			}

			return $array1['priority'] - $array2['priority'];
		}

		/**
		 * Notice Types
		 *
		 * @return void
		 * @since 1.4.0
		 */
		public function show_notices(){

			$defaults = [
				'id'                         => '',      // Optional, Notice ID. If empty it set `astra-notices-id-<$array-index>`.
				'type'                       => 'info',  // Optional, Notice type. Default `info`. Expected [info, warning, notice, error].
				'message'                    => '',      // Optional, Message.
				'show_if'                    => TRUE,    // Optional, Show notice on custom condition. E.g. 'show_if' => if( is_admin() ) ? true, false, .
				'repeat-notice-after'        => '',      // Optional, Dismiss-able notice time. It'll auto show after given time.
				'display-notice-after'       => FALSE,      // Optional, Dismiss-able notice time. It'll auto show after given time.
				'class'                      => '',      // Optional, Additional notice wrapper class.
				'priority'                   => 10,      // Priority of the notice.
				'display-with-other-notices' => TRUE,    // Should the notice be displayed if other notices  are being displayed from Astra_Notices.
				'is_dismissible'             => TRUE,
			];

			// Count for the notices that are rendered.
			$notices_displayed = 0;

			// sort the array with priority.
			usort(self::$notices, [$this, 'sort_notices']);

			foreach (self::$notices as $key => $notice){

				$notice = wp_parse_args($notice, $defaults);

				$notice['id'] = self::get_notice_id($notice, $key);

				$notice['classes'] = self::get_wrap_classes($notice);

				// Notices visible after transient expire.
				if (isset($notice['show_if']) && TRUE === $notice['show_if']){

					// don't display the notice if it is not supposed to be displayed with other notices.
					if (0 !== $notices_displayed && FALSE === $notice['display-with-other-notices']){
						continue;
					}

					if (self::is_expired($notice)){

						self::markup($notice);
						++ $notices_displayed;
					}
				}
			}

		}

		/**
		 * Markup Notice.
		 *
		 * @param array $notice Notice markup.
		 *
		 * @return void
		 * @since 1.4.0
		 */
		public static function markup($notice = []){

			wp_enqueue_script('astra-notices');

			do_action('astra_notice_before_markup');

			do_action("astra_notice_before_markup_{$notice['id']}");

			?>
            <div id="<?php echo esc_attr($notice['id']); ?>" class="<?php echo esc_attr($notice['classes']); ?>" data-repeat-notice-after="<?php echo esc_attr($notice['repeat-notice-after']); ?>">
                <div class="notice-container">
					<?php do_action("astra_notice_inside_markup_{$notice['id']}"); ?><?php echo wp_kses_post($notice['message']); ?>
                </div>
            </div>
			<?php

			do_action("astra_notice_after_markup_{$notice['id']}");

			do_action('astra_notice_after_markup');

		}

		/**
		 * Notice classes.
		 *
		 * @param array $notice Notice arguments.
		 *
		 * @return array       Notice wrapper classes.
		 * @since 1.4.0
		 *
		 */
		private static function get_wrap_classes($notice){
			$classes = ['astra-notice', 'notice'];

			if ($notice['is_dismissible']){
				$classes[] = 'is-dismissible';
			}

			$classes[] = $notice['class'];
			if (isset($notice['type']) && '' !== $notice['type']){
				$classes[] = 'notice-' . $notice['type'];
			}

			return esc_attr(implode(' ', $classes));
		}

		/**
		 * Get Notice ID.
		 *
		 * @param array $notice Notice arguments.
		 * @param int $key Notice array index.
		 *
		 * @return string       Notice id.
		 * @since 1.4.0
		 *
		 */
		private static function get_notice_id($notice, $key){
			if (isset($notice['id']) && !empty($notice['id'])){
				return $notice['id'];
			}

			return 'astra-notices-id-' . $key;
		}

		/**
		 * Is notice expired?
		 *
		 * @param array $notice Notice arguments.
		 *
		 * @return boolean
		 * @since 1.4.0
		 *
		 */
		private static function is_expired($notice){
			$transient_status = get_transient($notice['id']);

			if (FALSE === $transient_status){

				if (isset($notice['display-notice-after']) && FALSE !== $notice['display-notice-after']){

					if ('delayed-notice' !== get_user_meta(get_current_user_id(), $notice['id'],
							TRUE) &&
					    'notice-dismissed' !== get_user_meta(get_current_user_id(), $notice['id'],
						    TRUE)){
						set_transient($notice['id'], 'delayed-notice',
							$notice['display-notice-after']);
						update_user_meta(get_current_user_id(), $notice['id'], 'delayed-notice');

						return FALSE;
					}
				}

				// Check the user meta status if current notice is dismissed or delay completed.
				$meta_status = get_user_meta(get_current_user_id(), $notice['id'], TRUE);

				if (empty($meta_status) || 'delayed-notice' === $meta_status){
					return TRUE;
				}
			}

			return FALSE;
		}

		/**
		 * Get URI
		 *
		 * @return mixed URL.
		 */
		public static function _get_uri(){
			$path       = wp_normalize_path(dirname(__FILE__));
			$theme_dir  = wp_normalize_path(get_template_directory());
			$plugin_dir = wp_normalize_path(WP_PLUGIN_DIR);

			if (strpos($path, $theme_dir) !== FALSE){
				return trailingslashit(get_template_directory_uri() . str_replace($theme_dir, '',
						$path));
			}elseif (strpos($path, $plugin_dir) !== FALSE){
				return plugin_dir_url(__FILE__);
			}elseif (strpos($path, dirname(plugin_basename(__FILE__))) !== FALSE){
				return plugin_dir_url(__FILE__);
			}

			return;
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Astra_Notices::get_instance();

endif;
