<?php
/**
 * UAEL WooCommerce Products - Pagination.
 *
 * @package UAEL
 */

if (!defined('ABSPATH')){
	exit;
}

$total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%',
	remove_query_arg('add-to-cart', get_pagenum_link(999999999, FALSE))));
$format  = isset($format) ? $format : '';

if ($total <= 1){
	return;
}
?>
<nav class="uael-woocommerce-pagination">
	<?php
	echo paginate_links(
		apply_filters(
			'uael_woocommerce_pagination_args',
			[ // WPCS: XSS ok.
				'base'      => $base,
				'format'    => $format,
				'add_args'  => FALSE,
				'current'   => max(1, $current),
				'total'     => $total,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				'type'      => 'list',
				'end_size'  => 3,
				'mid_size'  => 3,
			]
		)
	);
	?>
</nav>
