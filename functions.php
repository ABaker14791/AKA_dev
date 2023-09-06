<?php

/* Adding css & JS */
function woocommerce_custom_theme() {
    wp_register_style( 'custom_css', get_template_directory_uri() . '/css/style.css', false, '1.0.0' );
    wp_register_style( 'montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap', false, '1.0.0' );
    wp_register_style( 'crimson', 'https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&display=swap', false, '1.0.0' );

    wp_enqueue_style( 'custom_css', 2.0 );
    wp_enqueue_style( 'montserrat' );
    wp_enqueue_style( 'crimson' );


}
add_action( 'wp_enqueue_scripts', 'woocommerce_custom_theme' );

/* Creating custom menu */
function woocommerce_custom_menu(){
    register_nav_menu( 'top-menu',__( 'Woocommerce Custom Menu', 'woocommercecustommenu' ));
}
add_action( 'init', 'woocommerce_custom_menu');

/* WooCommerce */
if (class_exists( 'WooCommerce' )) {

    /* WooCommerce Support */
    function akaautomotive_add_woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
    add_action( 'after_setup_theme', 'akaautomotive_add_woocommerce_support' );

     /* remove WooCommerce Styles */
    //  add_filter( 'woocommerce_enqueue_styles', '__return_false' );

    // Remove Shop Title
    add_filter( 'woocommerce_show_page_title', '__return_false' );

    // Add Support
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['reviews'] ); 			// Remove the reviews tab


    return $tabs;
}

add_filter('jpeg_quality', function($arg){return 75;});




/**
 * Add the product's short description (excerpt) to the WooCommerce shop/category pages. The description displays after the product's name, but before the product's price.
 *
 * Ref: https://gist.github.com/om4james/9883140
 *
 * Put this snippet into a child theme's functions.php file
 */
function woocommerce_after_shop_loop_item_title_short_description() {
	global $product;

	if ( ! $product->post->post_excerpt ) return;
	?>
	<div itemprop="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
	</div>
	<?php 
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);


add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_display_sold_out_loop_woocommerce' );
 
function bbloomer_display_sold_out_loop_woocommerce() {
    global $product;
    if ( ! $product->is_in_stock() ) {
        echo '<span class="soldout">Sold</span>';
    }
} 

function store_mall_wc_empty_cart_redirect_url() {
    $url = 'https://akaautomotive.co.uk/'; // change this to the -all catagories- page once complete
    return esc_url( $url );
}
add_filter( 'woocommerce_return_to_shop_redirect', 'store_mall_wc_empty_cart_redirect_url' );
