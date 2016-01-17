<style>

input.no_products {
	height: 38px;
    width: 73px;
    padding: 10px;
    border: 0;
    border-radius: 20px;
    position: absolute;
	margin-left: 123px;
    margin-top: -43px;
}

p.p_1 {
	font-size: 14px;
}

p.p_2 {
    margin-left: 207px;
    margin-top: -35px;
    margin-bottom: 45px;
    font-size: 14px;
}

/*#message .push {
    margin-top: 50px !important;
}
*/

</style>
<?php
/*  2008-2013 eBay Inc., All Rights Reserved */
/* Licensed under CDDL 1.0 -  http://opensource.org/licenses/cddl1.php */
?>
<div id="message" style="margin-left: 2px;width: 500px;" class="updated notice error notice-error below-h2">
 	 <p>You Can't Push Products To eBay Because WooCommerce Plugin is inactive</p>
</div>
<h1>Pushing Woocommerce Products to eBay</h1>
<form action="" method="post">
    <p class="p_1">You want to push</p><input type="text" class="no_products" name="numposts" placeholder="number of products" value="" /><p class="p_2">Products from your Woocommerce Products</p>
    <input type="submit" class="btn_get_all button-primary" name="pushproducts" value="Push Now" disabled="disabled" />
</form>