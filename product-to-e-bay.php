<?php
/**
 * @package push products to eBay
 */
/*
  Plugin Name: Push WooCommerce Products to Ebay
  Plugin URI: https://github.com/walidoo
  Description: for pushing WooCommerce Products to eBay
  Author: Walid Rezk
  Version: 0.1.5 Beta
  Author URI: https://github.com/walidoo
 */
defined('ABSPATH') or die('No script kiddies please!');
function products_ebay_actions() {
    //the last parameter of this function is the name of function that used for build adminstration page of our plugin
    //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    // URL : http://codex.wordpress.org/Function_Reference/add_menu_page
    add_menu_page("products-to-ebay", "WooCommerce to eBay", 1, "products-to-ebay", "products_to_ebay_fn", "dashicons-megaphone", 36);
    //first parameter refers to menu_slug in primary menu page
    add_submenu_page( 'products-to-ebay', 'setting', 'setting', 1, 'setting', 'my_cool_plugin_settings_page' );
}

add_action('admin_menu', 'products_ebay_actions');

/* build the administration page of our plugin */
function products_to_ebay_fn() {
  $plugin_name = "woocommerce/woocommerce.php";
if(is_plugin_active($plugin_name)) {
    require_once('AddItem.php');
  }
  else {
    require_once('inactive_woocommerce.php');
  }
}

function plugin_helper_scripts() {   
    wp_enqueue_style('style_push_product', plugins_url('/css/push.css' , __FILE__));
}

add_action('admin_init', 'plugin_helper_scripts');

/*Add new field [published] to product table*/
add_filter( 'manage_edit-product_columns', 'show_product_publishedtype',15 );
function show_product_publishedtype($columns){
   //add column
   $columns['published'] = 'Published'; 

   return $columns;
}

add_action( 'manage_product_posts_custom_column', 'wpso23858236_product_column_published', 10, 2 );
function wpso23858236_product_column_published( $column, $postid  ) {
    if ( $column == 'published' ) {
        echo get_post_meta( $postid , 'published', true );
    }
}

/* build an admin page fot setting page */
function my_cool_plugin_settings_page() {
  require_once('settingpage.php');
  settingpage_main();
}

/**
 * [get_ebay_option description]
 * @param  [type] $option_name [description]
 * @return Mixed              [description]
 */
function get_ebay_option( $option_name = null ){
  $option = get_option('product_to_ebay');
  if ( empty( $option_name ) ) return $option;
  return $option[$option_name];
}
