<?php
/**
 * UAEL Login Form Module.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\LoginForm;

use UltimateElementor\Base\Module_Base;
use UltimateElementor\Classes\UAEL_Helper;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Class Module.
 */
class Module extends Module_Base{

	/**
	 * Module should load or not.
	 *
	 * @return bool true|false.
	 * @since 1.20.0
	 * @access public
	 *
	 */
	public static function is_enable(){
		return TRUE;
	}

	/**
	 * Get Module Name.
	 *
	 * @return string Module name.
	 * @since 1.20.0
	 * @access public
	 *
	 */
	public function get_name(){
		return 'uael-login-form';
	}

	/**
	 * Get Widgets.
	 *
	 * @return array Widgets.
	 * @since 1.20.0
	 * @access public
	 *
	 */
	public function get_widgets(){
		return [
			'LoginForm',
		];
	}

	/**
	 * Constructor.
	 */
	public function __construct(){
		parent::__construct();

		add_action('init', [$this, 'uael_login_submission']);

		add_action('wp_ajax_uael_login_form_submit', [$this, 'get_form_data']);
		add_action('wp_ajax_nopriv_uael_login_form_submit', [$this, 'get_form_data']);

		add_action('wp_ajax_uael_login_form_facebook', [$this, 'get_facebook_data']);
		add_action('wp_ajax_nopriv_uael_login_form_facebook', [$this, 'get_facebook_data']);

		add_action('wp_ajax_uael_login_form_google', [$this, 'get_google_data']);
		add_action('wp_ajax_nopriv_uael_login_form_google', [$this, 'get_google_data']);
	}

	/**
	 * Attempt to login user when login form is submitted.
	 *
	 * @since  1.21.0
	 * @access public
	 */
	public function uael_login_submission(){

		if (isset($_POST['uael-login-nonce']) && wp_verify_nonce($_POST['uael-login-nonce'],
				'uael-login')){
			if (isset($_POST['uael-login-submit'])){

				if (!session_id() && !headers_sent()){
					session_start();
				}

				$data = $_POST;

				$username   = !empty($data['username']) ? $data['username'] : '';
				$password   = !empty($data['password']) ? $data['password'] : '';
				$rememberme = !empty($data['rememberme']) ? $data['rememberme'] : '';

				$user_data = wp_signon(
					[
						'user_login'    => $username,
						'user_password' => $password,
						'remember'      => ('forever' === $rememberme) ? TRUE : FALSE,
					]
				);

				if (is_wp_error($user_data)){

					if (isset($user_data->errors['invalid_email'][0])){

						$_SESSION['uael_error'] = 'invalid_email';

					}elseif (isset($user_data->errors['invalid_username'][0])){

						$_SESSION['uael_error'] = 'invalid_username';

					}elseif (isset($user_data->errors['incorrect_password'][0])){

						$_SESSION['uael_error'] = 'incorrect_password';
					}
				}else{
					wp_set_current_user($user_data->ID, $username);
					do_action('wp_login', $user_data->user_login, $user_data);
					if (isset($data['redirect_to']) && '' !== $data['redirect_to']){
						wp_redirect($data['redirect_to']);
						exit();
					}
				}
			}
		}
	}

	/**
	 * Get Form Data via AJAX call.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	public function get_form_data(){

		check_ajax_referer('uael-form-nonce', 'nonce');

		$data     = [];
		$error    = [];
		$response = [];

		if (isset($_POST['data'])){

			$data = $_POST['data'];

			$username   = !empty($data['username']) ? sanitize_user($data['username']) : '';
			$password   = !empty($data['password']) ? $data['password'] : '';
			$rememberme = !empty($data['rememberme']) ? sanitize_text_field($data['rememberme']) : '';

			$user_data = wp_signon(
				[
					'user_login'    => $username,
					'user_password' => $password,
					'remember'      => ('forever' === $rememberme) ? TRUE : FALSE,
				]
			);

			if (is_wp_error($user_data)){

				if (isset($user_data->errors['invalid_email'][0])){

					wp_send_json_error('invalid_email');

				}elseif (isset($user_data->errors['invalid_username'][0])){

					wp_send_json_error('invalid_username');

				}elseif (isset($user_data->errors['incorrect_password'][0])){

					wp_send_json_error('incorrect_password');

				}
			}else{
				wp_set_current_user($user_data->ID, $username);
				do_action('wp_login', $user_data->user_login, $user_data);

				wp_send_json_success();
			}
		}
	}

	/**
	 * Get Facebook Form Data via AJAX call.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	public function get_facebook_data(){
		check_ajax_referer('uael-form-nonce', 'nonce');

		$data      = [];
		$response  = [];
		$user_data = [];
		$result    = '';

		if (isset($_POST['data'])){

			$data = $_POST['data'];

			$fb_user_id   = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
			$access_token = filter_input(INPUT_POST, 'security_string', FILTER_SANITIZE_STRING);

			$integration_options     = UAEL_Helper::get_integrations_options();
			$uae_facebook_app_id     = $integration_options['facebook_app_id'];
			$uae_facebook_app_secret = $integration_options['facebook_app_secret'];

			$rest_data = $this->get_user_profile_info_facebook($access_token, $uae_facebook_app_id,
				$uae_facebook_app_secret);

			if (empty($fb_user_id) || empty($rest_data) || empty($uae_facebook_app_id) || empty($uae_facebook_app_secret) || ($fb_user_id !== $rest_data['data']['user_id']) || ($uae_facebook_app_id !== $rest_data['data']['app_id']) || (!$rest_data['data']['is_valid'])){
				wp_send_json_error('Invalid Authorization');
			}

			$name       = sanitize_user($data['name']);
			$first_name = sanitize_user($data['first_name']);
			$last_name  = sanitize_user($data['last_name']);
			$send_email = $data['send_email'];

			$verified_email = $this->get_user_email_facebook($rest_data['data']['user_id'],
				$access_token);

			if ((!is_null($data['email']) || isset($data['email']) || !empty($data['email']))){

				if ($data['email'] === $verified_email['email']){
					$email = sanitize_email($verified_email['email']);
				}else{
					wp_send_json_error('Invalid Authorization');
				}
			}else{
				$email = $rest_data['data']['user_id'] . '@facebook.com';
			}

			$user_data = get_user_by('email', $email);

			if (!empty($user_data) && FALSE !== $user_data){

				$user_ID    = $user_data->ID;
				$user_email = $user_data->user_email;
				wp_set_auth_cookie($user_ID);
				wp_set_current_user($user_ID, $name);
				do_action('wp_login', $user_data->user_login, $user_data);

				$response['success'] = TRUE;

			}else{

				$password = wp_generate_password(12, TRUE, FALSE);

				$facebook_array = [
					'user_login' => $name,
					'user_pass'  => $password,
					'user_email' => $email,
					'first_name' => isset($first_name) ? $first_name : $name,
					'last_name'  => $last_name,
				];

				if (username_exists($name)){
					// Generate something unique to append to the username in case of a conflict with another user.
					$suffix = '-' . zeroise(wp_rand(0, 9999), 4);
					$name   .= $suffix;

					$facebook_array['user_login'] = strtolower(preg_replace('/\s+/', '', $name));
				}

				$result = wp_insert_user($facebook_array);

				if ('no' !== $send_email){
					$this->send_user_email($result, $send_email);
				}

				$user_data = get_user_by('email', $email);

				if ($user_data){
					$user_ID    = $user_data->ID;
					$user_email = $user_data->user_email;

					$user_meta = [
						'login_source' => 'facebook',
					];

					update_user_meta($user_ID, 'uael_login_form', $user_meta);

					if (wp_check_password($password, $user_data->user_pass, $user_data->ID)){
						wp_set_auth_cookie($user_ID);
						wp_set_current_user($user_ID, $name);
						do_action('wp_login', $user_data->user_login, $user_data);
						$response['success'] = TRUE;
					}
				}
			}

			echo wp_send_json($response);
		}else{
			die;
		}
	}

	/**
	 * Get Google Form Data via AJAX call.
	 *
	 * @since 1.20.0
	 * @access public
	 */
	public function get_google_data(){

		check_ajax_referer('uael-form-nonce', 'nonce');

		$data      = [];
		$response  = [];
		$user_data = [];
		$result    = '';

		if (isset($_POST['data'])){

			$id_token            = filter_input(INPUT_POST, 'id_token', FILTER_SANITIZE_STRING);
			$integration_options = UAEL_Helper::get_integrations_options();

			$verified_data = $this->verify_user_data($id_token,
				$integration_options['google_client_id']);

			$data       = $_POST['data'];
			$name       = isset($verified_data['name']) ? $verified_data['name'] : '';
			$email      = isset($verified_data['email']) ? $verified_data['email'] : '';
			$send_email = $data['send_email'];

			// Check if email is verified with Google.
			if (empty($verified_data) || ($verified_data['aud'] !== $integration_options['google_client_id']) || (isset($verified_data['email']) && $verified_data['email'] !== $email)){
				wp_send_json_error(
					[
						'error' => __('Unauthorized access', 'uael'),
					]
				);
			}

			$user_data = get_user_by('email', $email);

			$response['username'] = $name;

			if (!empty($user_data) && FALSE !== $user_data){

				$user_ID    = $user_data->ID;
				$user_email = $user_data->user_email;
				wp_set_auth_cookie($user_ID);
				wp_set_current_user($user_ID, $name);
				do_action('wp_login', $user_data->user_login, $user_data);
				$response['success'] = TRUE;

			}else{

				$password = wp_generate_password(12, TRUE, FALSE);

				if (username_exists($name)){
					// Generate something unique to append to the username in case of a conflict with another user.
					$suffix = '-' . zeroise(wp_rand(0, 9999), 4);
					$name   .= $suffix;

					$user_array = [
						'user_login' => strtolower(preg_replace('/\s+/', '', $name)),
						'user_pass'  => $password,
						'user_email' => $email,
						'first_name' => $verified_data['name'],
					];
					$result     = wp_insert_user($user_array);
				}else{
					$result = wp_create_user($name, $password, $email);
				}

				if ('no' !== $send_email){
					$this->send_user_email($result, $send_email);
				}

				$user_data = get_user_by('email', $email);

				if ($user_data){

					$user_ID    = $user_data->ID;
					$user_email = $user_data->user_email;

					$user_meta = [
						'login_source' => 'google',
					];

					update_user_meta($user_ID, 'uael_login_form', $user_meta);

					if (wp_check_password($password, $user_data->user_pass, $user_data->ID)){

						wp_set_auth_cookie($user_ID);
						wp_set_current_user($user_ID, $name);
						do_action('wp_login', $user_data->user_login, $user_data);
						$response['success'] = TRUE;
					}
				}
			}

			echo wp_send_json($response);

		}else{
			die;
		}
	}

	/**
	 * Send email after social user registered.
	 *
	 * @param array $result Details of the newly created user.
	 * @param string $notify Type of notification that should happen. See
	 *     wp_send_new_user_notifications() for more information on possible values.
	 *
	 * @access public
	 * @since 1.21.0
	 */
	public function send_user_email($result, $notify){

		/**
		 * Fires after a new user has been created.
		 *
		 * @param array $result Details of the newly created user.
		 * @param string $notify Type of notification that should happen. See wp_send_new_user_notifications()
		 *                       for more information on possible values.
		 *
		 * @since 1.21.0
		 *
		 */
		do_action('edit_user_created_user', $result, $notify);

	}

	/**
	 * Get access token info.
	 *
	 * @param string $id_token ID token.
	 * @param string $uae_google_client_id settings page client ID.
	 *
	 * @return array
	 * @since 1.20.1
	 * @access public
	 */
	public function verify_user_data($id_token, $uae_google_client_id){

		require_once UAEL_MODULES_DIR . 'login-form/includes/vendor/autoload.php';

		// Get $id_token via HTTPS POST.
		$client = new \Google_Client(['client_id' => $uae_google_client_id]);  //PHPCS:ignore:PHPCompatibility.PHP.ShortArray.Found

		$verified_data = $client->verifyIdToken($id_token);

		if ($verified_data){
			return $verified_data;
		}else{
			wp_send_json_error(
				[
					'error' => __('Unauthorized access', 'uael'),
				]
			);
		}

	}

	/**
	 * Function that authenticates Facebook user.
	 *
	 * @param string $access_token Access Token.
	 * @param string $uae_facebook_app_id App ID.
	 * @param string $uae_facebook_app_secret Secret token.
	 *
	 * @since 1.20.1
	 */
	public function get_user_profile_info_facebook(
		$access_token,
		$uae_facebook_app_id,
		$uae_facebook_app_secret){

		$fb_url = 'https://graph.facebook.com/oauth/access_token';
		$fb_url = add_query_arg(
			[
				'client_id'     => $uae_facebook_app_id,
				'client_secret' => $uae_facebook_app_secret,
				'grant_type'    => 'client_credentials',
			],
			$fb_url
		);

		$fb_response = wp_remote_get($fb_url);

		if (is_wp_error($fb_response)){
			wp_send_json_error();
		}

		$fb_app_response = json_decode(wp_remote_retrieve_body($fb_response), TRUE);

		$app_token = $fb_app_response['access_token'];

		$url = 'https://graph.facebook.com/debug_token';
		$url = add_query_arg(
			[
				'input_token'  => $access_token,
				'access_token' => $app_token,
			],
			$url
		);

		$response = wp_remote_get($url);

		if (is_wp_error($response)){
			wp_send_json_error();
		}

		return json_decode(wp_remote_retrieve_body($response), TRUE);
	}

	/**
	 * Function that retrieves authenticatated Facebook email.
	 *
	 * @param string $user_id User ID.
	 * @param string $access_token User Access Token.
	 *
	 * @since 1.21.0
	 */
	public function get_user_email_facebook($user_id, $access_token){

		$fb_email_url = 'https://graph.facebook.com/' . $user_id;
		$fb_email_url = add_query_arg(
			[
				'fields'       => 'email',
				'access_token' => $access_token,
			],
			$fb_email_url
		);

		$email_response = wp_remote_get($fb_email_url);

		if (is_wp_error($email_response)){
			wp_send_json_error();
		}

		return json_decode(wp_remote_retrieve_body($email_response), TRUE);

	}

}
