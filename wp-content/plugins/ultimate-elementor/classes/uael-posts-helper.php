<?php
/**
 * UAEL Posts Helper.
 *
 * @package UAEL
 */

namespace UltimateElementor\Classes;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

/**
 * Class UAEL_Posts_Helper.
 */
class UAEL_Posts_Helper{

	/**
	 * Get Post Types.
	 *
	 * @since 1.5.2
	 * @access public
	 */
	public static function get_post_types(){

		$post_types = get_post_types(
			[
				'public' => TRUE,
			],
			'objects'
		);

		$options = [];

		foreach ($post_types as $post_type){
			$options[$post_type->name] = $post_type->label;
		}

		return apply_filters('uael_loop_post_types', $options);
	}

	/**
	 * Get Post Taxonomies.
	 *
	 * @param string $post_type Post type.
	 *
	 * @access public
	 * @since 1.5.2
	 */
	public static function get_taxonomy($post_type){

		$taxonomies = get_object_taxonomies($post_type, 'objects');
		$data       = [];

		foreach ($taxonomies as $tax_slug => $tax){

			if (!$tax->public || !$tax->show_ui){
				continue;
			}

			$data[$tax_slug] = $tax;
		}

		return apply_filters('uael_post_loop_taxonomies', $data, $taxonomies, $post_type);
	}

	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @return array $sizes Data for all currently-registered image sizes.
	 * @uses   get_intermediate_image_sizes()
	 * @link   https://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
	 * @since 1.5.2
	 * @global $_wp_additional_image_sizes
	 */
	public static function get_image_sizes(){

		global $_wp_additional_image_sizes;

		$sizes  = get_intermediate_image_sizes();
		$result = [];

		foreach ($sizes as $size){
			if (in_array($size, ['thumbnail', 'medium', 'medium_large', 'large'], TRUE)){
				$result[$size] = ucwords(trim(str_replace(['-', '_'], [' ', ' '], $size)));
			}else{
				$result[$size] = sprintf(
					'%1$s (%2$sx%3$s)',
					ucwords(trim(str_replace(['-', '_'], [' ', ' '], $size))),
					$_wp_additional_image_sizes[$size]['width'],
					$_wp_additional_image_sizes[$size]['height']
				);
			}
		}

		$result = array_merge(
			[
				'full' => esc_html__('Full', 'uael'),
			],
			$result
		);

		$result['custom'] = esc_html__('Custom', 'uael');

		$result = apply_filters('uael_post_featured_image_sizes', $result);

		return $result;
	}

	/**
	 * Get list of users.
	 *
	 * @return array $users Data for all users.
	 * @link   https://codex.wordpress.org/Function_Reference/get_users
	 * @since 1.5.2
	 * @uses   get_users()
	 */
	public static function get_users(){

		$users     = get_users(['role__in' => ['administrator', 'editor', 'author', 'contributor']]);
		$user_list = [];

		if (empty($users)){
			return $user_list;
		}

		foreach ($users as $key => $value){
			$user_list[$value->ID] = $value->data->user_login;
		}

		return apply_filters('uael_post_loop_user_list', $user_list);
	}
}
