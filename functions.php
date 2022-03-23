
/**
* @snippet       Remove Sorting Option @ WooCommerce Search
* @how-to        Get secure, fast, and discounted Wordpress hosting at https://turnuphosting.com/wordpress-hosting
* @author        Deedat
*/

add_filter( 'woocommerce_catalog_orderby', 'dee_change_sorting_options_order', 5 );

function dee_change_sorting_options_order( $options ){

$options = array(

'popularity' => __( 'Sort by Best Sellers', 'woocommerce' ),
'menu_order' => __( 'Default sorting', 'woocommerce' ),
'date'       => __( 'Sort by latest', 'woocommerce' ),

'rating'     => 'Sort by average rating', // __() is not necessary
'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),

);

return $options;

}


/**
* @snippet       Remove Sorting Option @ WooCommerce Shop
* @how-to        Get a secure, fast, and discounted Wordpress hosting at https://turnuphosting.com/wordpress-hosting
* @author        Deedat
*/
 

if ( ! function_exists( 'woocommerce_catalog_ordering' ) ) {
/**
* Output the product sorting options.
*/
function woocommerce_catalog_ordering() {
if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
return;
}
$orderby                 = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : apply_filters( 'woocommerce_catalog_orderby', get_option( 'popularity' ) ); // WPCS: sanitization ok, input var ok, CSRF ok.
$show_default_orderby    = 'popularity' === apply_filters( 'woocommerce_catalog_orderby', 'popularity' );
$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(

'popularity' => __( 'Sort by popularity', 'woocommerce' ),
'rating'     => __( 'Sort by average rating', 'woocommerce' ),
'date'       => __( 'Sort by newness', 'woocommerce' ),
'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
) );

$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'popularity' : apply_filters( 'woocommerce_catalog_orderby', 'popularity' );
$orderby         = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : $default_orderby; // WPCS: sanitization ok, input var ok, CSRF ok.

if ( wc_get_loop_prop( 'is_search' ) ) {
$catalog_orderby_options = array_merge( array( 'relevance' => __( 'Relevance', 'woocommerce' ) ), $catalog_orderby_options );

unset( $catalog_orderby_options['menu_order'] );
if ( 'menu_order' === $orderby ) {
$orderby = 'relevance';
}
}

if ( ! $show_default_orderby ) {
unset( $catalog_orderby_options['menu_order'] );
}

if ( ! $show_default_orderby ) {
unset( $catalog_orderby_options['relevance'] );
}

if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
unset( $catalog_orderby_options['rating'] );
}



wc_get_template( 'loop/orderby.php', array(
'catalog_orderby_options' => $catalog_orderby_options,
'orderby'                 => $orderby,
'show_default_orderby'    => $show_default_orderby,
) );
}
}




