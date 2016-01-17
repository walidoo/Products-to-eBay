=== Push WooCommerce Products to Ebay ===
Auther: Walid Rezk
Version: 0.1.5 Beta
Plugin URL: https://github.com/walidoo
Tags: products,eBay,API,WooCommerce,plugin,sandbox,pushing
Requires at least: 3.0
Tested up to: 4.3
Stable tag: 4.3.1
License: GPLv2

Products-to-eBay is a Wordpress Plugin for pushing WooCommerce Products to eBay US using eBay API

== Description ==

	["Products-to-eBay is active"] 
1. firstly you should enter your setting to connect with API then , enter number of products to publish.
2. f there is no product to publish , show a message that informs you that all products are already published.

	["Setting Page"]
firstly ,
1. you must have an account on eBay Developer and generate keys to get your configuration to connect with eBay API 
there are some details that you must ensure that you have it like [ DEVID - AppID - CertID ...etc ].
2. you must have a paypal account. 

finally , enter your configuration in setting page then click "save changes" to save your setting

	["WooCommerce is inactive"]
"WooCommerce plugin is inactive and products-to-eBay is active" >  show a message that informs you that woocommerce plugin is inactive and you should active it to connect and push your products.


== Installation ==
1.  Upload your plugin folder to the '/wp-content/plugins\' directory.
2.  Activate the plugin through the 'Plugins\' menu in WordPress.
3.  Make sure that WooCommerce Plugin is active.

== Frequently Asked Questions ==
1.  How to generate an Auth Token for a registered Sandbox test user ?
   - Log in to the eBay Developers Program site using your eBay Developers Program username and password.
   - Click the Get a User Token link.
   - On the Get a User Token page, select Sandbox as the environment, then select the Key Set 1 to use for this user.
           * If Key Set 1 isn't available, this means you haven't generated a Sandbox key set for your Developer account. To generate the key, see Generating Sandbox Keys.
           * When you select Key Set 1, the DevID, AppID, and CertID key fields are populated.
           * Note that test users do not have their own set of keys. Test user keys are associated with the key set that belongs to the User ID that created the test user, This is important because some calls (such as ConfirmIdentity) require that you use a key set in the request.
   - Click the Continue to generate token button.
          * The Sign in to Link Your eBay Account page appears.
   - Enter the User ID and password for the Sandbox test user for whom you want to generate an Auth Token.
         * Remember test user's User ID begins with "TESTUSER_".
  - Click the Sign in button.
        * The Grant application access page appears.
  - Click the I agree button.
  - The Token Generation — Final Step page appears, providing the test user's Auth Token and token expiration date.
       * Save the Auth Token and expiration date to a place where you can access them whenever you want to make calls on behalf of the respective test user.
  - Click the Save Token button.
      * This allows the test tool to automatically add this token into the call when using the test tool. You are now ready to run calls in the Sandbox environment.
( After generating individual authentication tokens for each user, place the respective test user's Auth Token in the eBayAuthToken field of your setting page. )

== Screenshots ==
1. https://i.imgur.com/nd7M9bn.png
2. https://i.imgur.com/z3uZ2b0.png
3. https://i.imgur.com/fD5H6Z8.png
4. https://i.imgur.com/FKc621e.png

== Changelog ==
= 0.1.5 =
*   Beta release

== Upgrade Notice ==
There is no need to upgrade just yet.
