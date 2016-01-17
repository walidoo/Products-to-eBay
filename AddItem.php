<?php
/*  2008-2013 eBay Inc., All Rights Reserved */
/* Licensed under CDDL 1.0 -  http://opensource.org/licenses/cddl1.php */
?>
<h1 class="push">Push WooCommerce Products to eBay</h1>
<form action="" method="post">
    <p class="p_1">You want to push</p><input type="text" class="no_products" name="numposts" placeholder="number of products" value="" /><p class="p_2">Products from your WooCommerce Products</p>
    <input type="submit" class="btn_get_all button-primary" name="pushproducts" value="Push Now" />
</form>
<?php
$data = $_POST;
if (isset($data["pushproducts"]) && !empty($data["numposts"])) {
    $numposts = $data["numposts"];
    require_once( plugin_dir_path( __FILE__ ) . "includes/eBay.php"); 
    $ebayapi = new eBay();    
    $args = array( 'post_type' => 'product' , 'posts_per_page' => $numposts , 'meta_key' => 'published' , 'meta_value'=> '', 'meta_compare' => 'NOT EXISTS');
    $ebayapi->addItem($args);
}
elseif (isset($data["pushproducts"]) && empty($data["numposts"])) {
	 echo '<div id="message" style="margin-left: 2px;width: 500px;" class="updated notice notice-error below-h2"><p>Please Enter Number of Your Products</p></div>' ;
}

?>
