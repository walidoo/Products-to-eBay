<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>
body {
  padding-top: 0px;  /* 60px to make the container go all the way to the bottom of the topbar */
  padding-bottom: 10px;
  position: relative; 
  background: #f4f4f4;
}
</style>
</head>
<h1 class="setting_page">Setting Page</h1>
<!-- Notes -->
<div class="div_user_notes">
<h4 class="header_notes">Notes</h4>
<div class="user_notes">
  <p class="p_notes">Sandbox</p>
  <p>if "true" The Sandbox will use testing databases that do not contain live items and data on ebay sandbox ,if "false" will
   use the live databases containing items currently listed on eBay.</p>
     <p class="p_notes">compatiblity level</p>
  <p>The eBay release version that your application supports.</p>
     <p class="p_notes">Paypal E-mail</p>
  <p>Your Paypal e-mail like "example@example.com".</p>
     <p class="p_notes">site url</p>
  <p>site url for eBay that matching with sandbox value.</p>
     <p class="p_notes">Developer ID</p>
  <p>This is the developer ID (DevID) as registered with the eBay Developers Program.</p>
     <p class="p_notes">Application ID</p>
  <p>This is the application ID (AppID) as registered with the eBay Developers Program.</p>
     <p class="p_notes">Certification ID</p>
  <p>This is the certification ID (CertID) as registered with the eBay Developers Program.</p>
     <p class="p_notes">Authontication Token</p>
  <p>This is the authontication ID (authID) as registered with the eBay Developers Program.</p>
     <p class="p_notes">Site ID</p>
  <p>The numeric value for the eBay site with the items you want information about , ex: "0" for "eBay United States".</p>
</div>
</div>
<!-- End of notes -->
<div class="container">
<?php
// create custom plugin settings menu

function settingpage_main() {
$plugin_name = "woocommerce/woocommerce.php";
if(is_plugin_active($plugin_name)) {
?>
<form class="form-horizontal" method="post" action="">
  <?php wp_nonce_field('Oakplugin') ;?>
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="is_sandbox">SandBox</label>
  <div class="col-md-5">
    <select id="is_sandbox" name="is_sandbox" class="form-control" value="<?php echo esc_attr( get_ebay_option('issandbox') ); ?>">
      <option value="true" <?php if(get_ebay_option('issandbox') == 'true') echo 'selected="selected"'; ?>>true</option>
      <option value="false" <?php if(get_ebay_option('issandbox') == 'false') echo 'selected="selected"'; ?>>false</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="compat_level">compatiblity level</label>  
  <div class="col-md-5">
  <input id="compat_level" name="compat_level" type="text" placeholder="compatiblity level" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('compat_level') ); ?>" required="">
    
  </div>
</div>

<!-- paypal email -->
<div class="form-group">
  <label class="col-md-4 control-label" for="paypal_email">Paypal E-mail</label>  
  <div class="col-md-5">
  <input id="paypal_email" name="paypal_email" type="email" placeholder="Your Paypal Email" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('paypal_email') ); ?>" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="api_endpoint">site url</label>  
  <div class="col-md-5">
  <input id="api_endpoint" name="api_endpoint" type="text" placeholder="site url for api" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('api_endpoint') ); ?>" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dev_id">Developer ID</label>  
  <div class="col-md-5">
  <input id="dev_id" name="dev_id" type="text" placeholder="Developer ID" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('dev_id') ); ?>" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="app_id">Application ID</label>  
  <div class="col-md-5">
  <input id="app_id" name="app_id" type="text" placeholder="Application ID" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('app_id') ); ?>" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cert_id">Certification ID</label>  
  <div class="col-md-5">
  <input id="cert_id" name="cert_id" type="text" placeholder="Certification ID" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('cert_id') ); ?>" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="auth_token">Authontication Token</label>  
  <div class="col-md-5">
  <input id="auth_token" name="auth_token" type="text" placeholder="Authontication Token" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('auth_token') ); ?>" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="site_id">Site ID</label>  
  <div class="col-md-5">
  <input id="site_id" name="site_id" type="text" placeholder="Site ID" class="form-control input-md" value="<?php echo esc_attr( get_ebay_option('site_id') ); ?>" required="">
    
  </div>
</div>

<!-- ListingDuration Select -->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="is_listing">ListingDuration</label>
  <div class="col-md-5">
    <select id="is_sandbox" name="is_listing" class="form-control" value="<?php echo esc_attr( get_ebay_option('issandbox') ); ?>">
      <option value="Days_1" <?php if(get_ebay_option('is_listing') == 'Days_1') echo 'selected="selected"'; ?>>1 Day</option>
      <option value="Days_3" <?php if(get_ebay_option('is_listing') == 'Days_3') echo 'selected="selected"'; ?>>3 Days</option>
      <option value="Days_5" <?php if(get_ebay_option('is_listing') == 'Days_5') echo 'selected="selected"'; ?>>5 Days</option>
      <option value="Days_7" <?php if(get_ebay_option('is_listing') == 'Days_7') echo 'selected="selected"'; ?>>7 Days</option>
      <option value="Days_10" <?php if(get_ebay_option('is_listing') == 'Days_10') echo 'selected="selected"'; ?>>10 Days</option>
      <option value="Days_14" <?php if(get_ebay_option('is_listing') == 'Days_14') echo 'selected="selected"'; ?>>14 Days</option>
      <option value="Days_21" <?php if(get_ebay_option('is_listing') == 'Days_21') echo 'selected="selected"'; ?>>21 Days</option>
      <option value="Days_30" <?php if(get_ebay_option('is_listing') == 'Days_30') echo 'selected="selected"'; ?>>30 Days</option>
      <option value="Days_60" <?php if(get_ebay_option('is_listing') == 'Days_60') echo 'selected="selected"'; ?>>60 Days</option>
      <option value="Days_90" <?php if(get_ebay_option('is_listing') == 'Days_90') echo 'selected="selected"'; ?>>90 Days</option>
      <option value="Days_120" <?php if(get_ebay_option('is_listing') == 'Days_120') echo 'selected="selected"'; ?>>120 Days</option>
    </select>
  </div>
</div> -->

<div class="form-group">
  <label class="col-md-4 control-label" for="saveconfig"></label>
  <div class="col-md-4">
    <button id="saveconfig" name="saveconfig" class="btn btn-info">Save Changes</button>
  </div>
</form>
<?php
  }
  else {
    echo '<div id="message" style="margin-left: 2px;width: 500px;" class="updated notice error notice-error below-h2">
            <p>You Cannot Push Products to eBay Because WooCommerce Plugin is inactive</p>
          </div>';
  }
}
?>
</div>
<script type="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php 
$data = $_POST;
if(isset($data["saveconfig"])) {
        $nonce = $_REQUEST['_wpnonce'];
        if (!wp_verify_nonce($nonce, 'Oakplugin')) {
            die('Security check');
        }
    $sandboxtype = $data["is_sandbox"];
    $comp_level = $data["compat_level"];
    $paypal_email = $data["paypal_email"];
    $api = $data["api_endpoint"];
    $devId = $data["dev_id"];
    $appId = $data["app_id"];
    $certId = $data["cert_id"];
    $auth = $data["auth_token"];
    $siteId = $data["site_id"];
    $option = array();
    $option['compat_level'] = $comp_level;
    $option['paypal_email'] = $paypal_email;
    $option['issandbox'] = $sandboxtype;
    $option['api_endpoint'] = $api;
    $option['dev_id'] = $devId;
    $option['app_id'] = $appId;
    $option['cert_id'] = $certId;
    $option['auth_token'] = $auth;
    $option['site_id'] = $siteId;

    update_option( 'product_to_ebay', $option );
    echo '<div id="message" style="margin-left: 2px;width: 500px;margin-top: 22px;" class="updated notice notice-error below-h2"><p>All Changes are Saved</p></div>' ;
}


?>