<?php
/**
 * UAEL WooCommerce Products - Template.
 *
 * @package UAEL
 */

use UltimateElementor\Classes\UAEL_Woo_Helper;

if (!defined('ABSPATH')){
	exit; // Exit if accessed directly.
}

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()){
	return;
}
?>

<?php

$post_id    = $product->get_id();
$class      = [];
$classes    = [];
$classes[]  = 'post-' . $post_id;
$wc_classes = esc_attr(implode(' ', wc_product_post_class($classes, $class, $post_id)));

$sale_flash      = $this->get_instance_value('show_sale');
$quick_view_type = $this->get_instance_value('quick_view_type');

$out_of_stock        = get_post_meta($post_id, '_stock_status', TRUE);
$out_of_stock_string = apply_filters('uael_woo_out_of_stock_string', __('Out of stock', 'uael'));

?>
<li class=" <?php echo $wc_classes; ?>">
    <div class="uael-woo-product-wrapper">
		<?php

		echo '<div class="uael-woo-products-thumbnail-wrap">';

		if ('yes' === $sale_flash){

			echo '<div class="uael-flash-container">';
			include UAEL_MODULES_DIR . 'woocommerce/templates/loop/sale-flash.php';
			echo '</div>';
		}

		woocommerce_template_loop_product_link_open();

		if ('yes' === $this->get_instance_value('show_image')){
			woocommerce_template_loop_product_thumbnail();
		}

		if ('swap' === $settings['products_hover_style']){
			UAEL_Woo_Helper::get_instance()->woo_shop_product_flip_image();
		}

		woocommerce_template_loop_product_link_close();

		/* Out of stock */
		if ('outofstock' === $out_of_stock){
			echo '<span class="uael-out-of-stock">' . esc_html($out_of_stock_string) . '</span>';
		}


		/* Product Actions */
		echo '<div class="uael-product-actions">';
		if ('show' === $quick_view_type){

			echo '<div class="uael-action-item-wrap uael-quick-view-btn" data-product_id="' . $post_id . '">';

			echo '<span class="uael-action-item fa fa-eye"></span>';
			echo '<span class="uael-action-tooltip">' . __('Quick View', 'uael') . '</span>';
			echo '</div>';

		}

		if ('yes' === $this->get_instance_value('show_add_cart')){

			$cart_class = $product->is_purchasable() && $product->is_in_stock() ? 'uael-add-to-cart-btn' : '';


			echo '<a href=' . $product->add_to_cart_url() . ' class="uael-action-item-wrap uael-cart-section ' . $cart_class . ' product_type_' . $product->get_type() . '" data-product_id="' . $post_id . '">';
			echo '<span class="uael-action-item uael-ajax-add-cart-icon fa fa-shopping-cart"></span>';
			echo '<span class="uael-action-tooltip">' . $product->add_to_cart_text() . '</span>';
			echo '</a>';
		}
		echo '</div>';

		if ('image' === $quick_view_type && 'yes' === $this->get_instance_value('show_image')){
			echo '<div class="uael-quick-view-data" data-product_id="' . $post_id . '"></div>';
		}
		echo '</div>';

		$shop_structure = [];

		if ('yes' === $this->get_instance_value('show_category')){

			$shop_structure[] = 'category';
		}
		if ('yes' === $this->get_instance_value('show_title')){

			$shop_structure[] = 'title';
		}
		if ('yes' === $this->get_instance_value('show_ratings')){

			$shop_structure[] = 'ratings';
		}
		if ('yes' === $this->get_instance_value('show_price')){

			$shop_structure[] = 'price';
		}
		if ('yes' === $this->get_instance_value('show_short_desc')){

			$shop_structure[] = 'short_desc';
		}

		$shop_structure = apply_filters(
			'uael_woo_products_content_structure',
			$shop_structure,
			$settings
		);

		if (is_array($shop_structure) && !empty($shop_structure)){

			do_action('uael_woo_products_before_summary_wrap', $post_id, $settings);
			echo '<div class="uael-woo-products-summary-wrap">';
			do_action('uael_woo_products_summary_wrap_top', $post_id, $settings);

			foreach ($shop_structure as $value){

				switch ($value){
					case 'title':
						/**
						 * Add Product Title on shop page for all products.
						 */
						do_action('uael_woo_products_title_before', $post_id, $settings);
						echo '<a href="' . esc_url(apply_filters('uael_woo_title_link',
								get_the_permalink())) . '" class="uael-loop-product__link">';
						woocommerce_template_loop_product_title();
						echo '</a>';
						do_action('uael_woo_products_title_after', $post_id, $settings);
						break;
					case 'price':
						/**
						 * Add Product Price on shop page for all products.
						 */
						do_action('uael_woo_products_price_before', $post_id, $settings);
						woocommerce_template_loop_price();
						do_action('uael_woo_products_price_after', $post_id, $settings);
						break;
					case 'ratings':
						/**
						 * Add rating on shop page for all products.
						 */
						do_action('uael_woo_products_rating_before', $post_id, $settings);
						woocommerce_template_loop_rating();
						do_action('uael_woo_products_rating_after', $post_id, $settings);
						break;
					case 'short_desc':
						do_action('uael_woo_products_short_description_before', $post_id,
							$settings);
						UAEL_Woo_Helper::get_instance()->woo_shop_short_desc();
						do_action('uael_woo_products_short_description_after', $post_id, $settings);
						break;
					case 'add_cart':
						do_action('uael_woo_products_add_to_cart_before', $post_id, $settings);
						woocommerce_template_loop_add_to_cart();
						do_action('uael_woo_products_add_to_cart_after', $post_id, $settings);
						break;
					case 'category':
						/**
						 * Add and/or Remove Categories from shop archive page.
						 */
						do_action('uael_woo_products_category_before', $post_id, $settings);
						UAEL_Woo_Helper::get_instance()->woo_shop_parent_category();
						do_action('uael_woo_products_category_after', $post_id, $settings);
						break;
					default:
						break;
				}
			}

			do_action('uael_woo_products_summary_wrap_bottom', $post_id, $settings);
			echo '</div>';
			do_action('uael_woo_products_after_summary_wrap', $post_id, $settings);
		}
		?>
    </div>
</li>
