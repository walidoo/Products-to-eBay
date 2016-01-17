<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of eBay [for pushing Woocommerce product to ebay sandbox as testing]
 *
 * @author WR
 */
class eBay {

    //configuration objects
    public $sandbox ;
    public $compat_level;
    public $paypal_email;
    public $api_endpoint = "";
    public $dev_id = "";
    public $app_id = "";
    public $cert_id = "";
    public $auth_token = "";
    public $site_id ;
    //type of call name
    public $call_name = 'AddItem';
    public $headers = array();
    public $count = 0;
    public $xml_request = '';
    public $val = array();
    public $connection = NULL;
    public $response = NULL;
    public $dom = NULL;
    public $args = array();
    public $loop = NULL;
    //product details
    public $product_title;
    public $product_price;
    public $product_content;
    public $product_photo;
    public $product_category = array();
    public $publishedType;

    public function __construct() {
         $options =  get_ebay_option();
         //print_r($options);
        if ( empty( $options ) ) return; 
        $this->configdetail( $options['issandbox'],
                             $options['compat_level'],
                             $options['paypal_email'],
                             $options['api_endpoint'],
                             $options['dev_id'],
                             $options['app_id'],
                             $options['cert_id'],
                             $options['auth_token'],
                             $options['site_id'] );
    }

    /*
     * @Auther : WR
     * Description : Get Configuration Object for eBay API 
     * @Return [configuration objects] */
    public function configdetail($sandboxtype , $compat_level , $paypal_email , $api_endpoint ,$dev_id ,$app_id ,$cert_id ,$auth_token ,$site_id) {
        if ($sandboxtype == true) {
            $this->sandbox = $sandboxtype;
            $this->api_endpoint = $api_endpoint ;
            $this->compat_level = $compat_level;
            $this->paypal_email = $paypal_email;
            $this->dev_id = $dev_id;
            $this->app_id = $app_id;
            $this->cert_id = $cert_id;
            $this->auth_token = $auth_token;
            $this->site_id = $site_id;
        } else {
            $this->sandbox = $sandboxtype;
            $this->api_endpoint = $api_endpoint;
            $this->compat_level = $compat_level;
            $this->paypal_email = $paypal_email;
            $this->dev_id = "";
            $this->app_id = "";
            $this->cert_id = "";
            $this->auth_token = "";
            $this->site_id = $site_id;
        }
    }

    /*
     * @Auther : WR
     * Description : Create headers to send with CURL request
     * @Return [headers array] */

    public function createHeaders() {
        return $this->headers = array
            (
            'Content-Type' => 'text/xml',
            'X-EBAY-API-COMPATIBILITY-LEVEL: ' . $this->compat_level,
            'X-EBAY-API-DEV-NAME: ' . $this->dev_id,
            'X-EBAY-API-APP-NAME: ' . $this->app_id,
            'X-EBAY-API-CERT-NAME: ' . $this->cert_id,
            'X-EBAY-API-CALL-NAME: ' . $this->call_name,
            'X-EBAY-API-SITEID: ' . $this->site_id,
        );
    }

    /*
     * @Auther : WR
     * Description : Create wp_reomte_post Init [getting or sending files using URL syntax.]
     * @return [eBay Response] */

//    public function wpremote_init() {
//        $this->val = array(
//            'headers' => $this->createHeaders(),
//            'body' => $this->xml_request,
//            'httpversion' => '1.0',
//            'sslverify' => false,
//        );
//        
////        echo "<pre>";
////         print_r($this->val);
////         print_r($this->api_endpoint);die;
//        
//        $this->response = wp_remote_post($this->api_endpoint, $this->val);
//        echo "<pre>";
//        print_r($this->response);
//        die();
//        return $this->response;
//    }

    /*
     * @Auther : WR
     * Description : Create Curl Init [getting or sending files using URL syntax.]
     * @return [eBay Response] */

    public function curl_init() {
        $this->connection = curl_init();
        curl_setopt($this->connection, CURLOPT_URL, $this->api_endpoint);
        curl_setopt($this->connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->connection, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->connection, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->connection, CURLOPT_POST, true);
        curl_setopt($this->connection, CURLOPT_POSTFIELDS, $this->xml_request);
        curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true);
        $this->response = curl_exec($this->connection);
        curl_close($this->connection);
    }

    /*
     * @Auther : WR
     * Description : Add Item from Woocommerce Products to eBay Sandbox */

    public function addItem($arg) {
        $this->args = $arg;
        $this->loop = new WP_Query($this->args);
        $this->count = 0;
        //delete_post_meta(58067, 'published', 'yes');die();
        if($this->loop->have_posts()) :
        while ($this->loop->have_posts()) : $this->loop->the_post();
            global $post;
            global $product;
            $this->product_price = $product->get_price();
            $this->product_title = $product->get_title($post->ID);
            $this->product_content = get_the_content();
            $this->publishedType = get_post_meta($post->ID, 'published', true );
            $this->product_photo = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $product);
            $this->product_category = wp_get_post_terms( $post->ID, 'product_cat' , true);
            // Generate XML request for your products
            $this->xml_request = '';
            $this->xml_request .= '<?xml version="1.0" encoding="utf-8"?>
            <' . $this->call_name . 'Request xmlns="urn:ebay:apis:eBLBaseComponents">
              <RequesterCredentials>
                <eBayAuthToken>' . $this->auth_token . '</eBayAuthToken>
              </RequesterCredentials>
              <ErrorLanguage>en_US</ErrorLanguage>
              <WarningLevel>High</WarningLevel>';
                        $this->xml_request .= '<Item>
                 <Title>' . $this->product_title . '</Title>
                <Description>
                <![CDATA[<b>Category</b> : ' . $this->product_category[0]->name . '<br>]]>
                <![CDATA[<b>Description</b> : ' . $this->product_content . ']]>
                </Description>
                <PrimaryCategory>
                <CategoryID>11776</CategoryID>
                </PrimaryCategory>
                <StartPrice>' . $this->product_price . '</StartPrice>
                <CategoryMappingAllowed>true</CategoryMappingAllowed>
                <ConditionID>1000</ConditionID>
                <Country>US</Country>
                <Currency>USD</Currency>
                <DispatchTimeMax>3</DispatchTimeMax>
                <ListingDuration>Days_7</ListingDuration>
                <ListingType>Chinese</ListingType>
                <PaymentMethods>PayPal</PaymentMethods>
                <PayPalEmailAddress>'. $this->paypal_email .'</PayPalEmailAddress>
                <PictureDetails>
                    <PictureURL>' . $this->product_photo["0"] . '</PictureURL>
                </PictureDetails>
                <PostalCode>95125</PostalCode>
                <Quantity>1</Quantity>
                <ReturnPolicy>
                <ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>
                <RefundOption>MoneyBack</RefundOption>
                <ReturnsWithinOption>Days_30</ReturnsWithinOption>
                <Description>If you are not satisfied, return the item for refund.</Description>
                <ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>
                </ReturnPolicy>
                <ShippingDetails>
                <ShippingType>Flat</ShippingType>
                <ShippingServiceOptions>
                <ShippingServicePriority>1</ShippingServicePriority>
                <ShippingService>USPSMedia</ShippingService>
                <ShippingServiceCost>2.50</ShippingServiceCost>
                </ShippingServiceOptions>
                </ShippingDetails>
                <Site>US</Site>
                </Item>';
                $this->xml_request .='</' . $this->call_name . 'Request>'; 
            $this->createHeaders();
            $this->curl_init();
            update_post_meta ( $post->ID, 'published', 'yes' );
            $this->count++; 
         endwhile;
          wp_reset_query();
          echo '<div id="message" style="margin-left: 2px;width: 500px;" class="updated notice notice-error below-h2"><p>You Pushed' . ' ' . '<b>' . $this->count . '</b>' . ' ' . 'Products Successfully</p></div>' ;
         else :
          echo '<div id="message" style="margin-left: 2px;width: 500px;" class="updated notice notice-error below-h2"><p>There are No Products to Publish . Already , All Products are Published</p></div>' ;
         endif;
    }

}