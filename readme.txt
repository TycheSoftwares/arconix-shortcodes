=== Arconix Shortcodes ===
Contributors: jgardner03, tychesoftwares, shasvat
Donate link: https://www.paypal.me/TycheSoftwares
Tags: arconix, shortcodes, tabs, toggle, buttons, accordion
Requires at least: 4.3
Tested up to: 6.6.2
Stable tag: 2.1.13
License: GPLv2 or later

Arconix Shortcodes provides a number of useful design elements like buttons, boxes, tabs and toggles to help compliment any website.

== Description ==

With this plugin you can easily add various kinds of styled boxes, buttons, tabs, accordions, unordered lists, columns and more.
New in version 2.0, the box, button, list and tab shortcodes support custom [FontAwesome](http://fontawesome.github.io/Font-Awesome/) icons for a flexible display

= Features =
* 6 style shortcodes (accordions, boxes, tabs, toggles, etc...)
* 6 utility shortcodes (login-logout, highlight, etc...)
* Shortcodes for up to 5 column display
* [FontAwesome](http://fontawesome.github.io/Font-Awesome/) support for boxes, buttons, lists, and tabs gives your interactive elements that extra pop
* Responsive shortcode design to fit any screen
* Has a Compatibility Mode available to help prevent shortcode name conflicts

[Live Demo](http://demo.arconixpc.com/arconix-shortcodes)
[Documentation](https://www.tychesoftwares.com/docs/docs/shortcodes/)

> <strong>Tastes Great AND Less Filling</strong> Very effective and easy to use shortcodes help your site look sharp and saves space. Really like this plugin and recommend it to others.
> [Jan McClintock](https://wordpress.org/support/topic/tastes-great-and-less-filling/)

= Some of our Pro plugins =

1. **[Deposits plugin for WooCommerce](https://www.tychesoftwares.com/store/premium-plugins/deposits-for-woocommerce/?utm_source=wprepo&utm_medium=link&utm_campaign=Shortcodes "Deposits plugin for WooCommerce")**

2. **[Product Delivery Date Pro for WooCommerce](https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/?utm_source=wprepo&utm_medium=otherprolink&utm_campaign=Shortcodes "Product Delivery Date Pro for WooCommerce")**

3. **[Order Delivery Date Pro for WooCommerce](https://www.tychesoftwares.com/store/premium-plugins/order-delivery-date-for-woocommerce-pro-21/?utm_source=wprepo&utm_medium=link&utm_campaign=Shortcodes "Order Delivery Date Pro for WooCommerce")**

4. **[Abandoned Cart Pro for WooCommerce](https://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro/?utm_source=wprepo&utm_medium=link&utm_campaign=Shortcodes "Abandoned Cart Pro for WooCommerce")**

5. **[Booking & Appointment Plugin for WooCommerce](https://www.tychesoftwares.com/store/premium-plugins/woocommerce-booking-plugin/?utm_source=wprepo&utm_medium=link&utm_campaign=Shortcodes "Booking & Appointment Plugin for WooCommerce")**


= Some of our other free plugins =

1. **[Order Delivery Date for WooCommerce - Lite](https://wordpress.org/plugins/order-delivery-date-for-woocommerce/ "Order Delivery Date for WooCommerce - Lite")**

2. **[Abandoned Cart for WooCommerce](https://wordpress.org/plugins/woocommerce-abandoned-cart/ "Abandoned Cart for WooCommerce")**

3. **[Product Delivery Date for WooCommerce – Lite](https://wordpress.org/plugins/product-delivery-date-for-woocommerce-lite/ "Product Delivery Date for WooCommerce – Lite")**

4. **[WooCommerce Print Invoice & Delivery Note](https://wordpress.org/plugins/woocommerce-delivery-notes/ "WooCommerce Print Invoice & Delivery Note")**

5. **[Order Delivery Date for WP e-Commerce](https://wordpress.org/plugins/order-delivery-date/ "Order Delivery Date for WP e-Commerce")**

6. **[Prevent Customers To Cancel WooCommerce Orders](https://wordpress.org/plugins/woo-prevent-cancel-order/ "Prevent Customers To Cancel WooCommerce Orders")**

7. **[WooCommerce Coupons by Categories and Tags](https://wordpress.org/plugins/woo-coupons-by-categories-and-tags/ "WooCommerce Coupons by Categories and Tags")**

8. **[Arconix FAQ](https://wordpress.org/plugins/arconix-faq/ "Arconix FAQ")**

9. **[Arconix Flexslider](https://wordpress.org/plugins/arconix-flexslider/ "Arconix Flexslider")**

10. **[Arconix Portfolio](https://wordpress.org/plugins/arconix-portfolio/ "Arconix Portfolio")**

11. **[Arconix Testimonials](https://wordpress.org/plugins/arconix-testimonials/ "Arconix Testimonials")**

12. **[Export WordPress Menus](https://wordpress.org/plugins/wp-export-menus/ "Export WordPress Menus")**

== Installation ==

You can download and install Arconix Shortcodes using the built in WordPress plugin installer. If you download the plugin manually, make sure the files are uploaded to `/wp-content/plugins/arconix-shortcodes/`.

Activate Arconix-Shortcodes in the "Plugins" admin panel using the "Activate" link.

== Upgrade Notice ==

If updating from Version 1.2 or less, Please read the Changelog before upgrading

== Frequently Asked Questions ==

= What is compatibility mode? =

Compatibility mode adds a prefix to all the plugin's shortcodes. This was put into place to help avoid conflicts with other themes or plugins that used the same shortcode (like `[button]` or `[box]`)

= How do I enable compatibility mode? =

Place the following code in your theme's `functions.php` file:
`
define( 'ACS_COMPAT', true ); // Arconix Shortcodes Compatibility Mode
`
Now when adding a shortcode, just make sure they start `ac-` (i.e. `[ac-box]content[/ac-box]`

= Where can I find more information on how to use the shortcodes?  =

* Visit the plugin's [Documentation](http://arcnx.co/aswiki) for explanations on all the shortcodes
* Tutorials on advanced plugin usage can be found at [Arconix Computers](http://arconixpc.com/tag/arconix-shortcodes)

= How can I collapse all the accordions? =

While you can set the accordions to all collapse when the page is first loaded, the jQuery Tools script that powers these accordions does not support closing all the accordions once one has been opened.

= The Accordions/Tabs/Toggles isn't working =
While you can certainly start a thread in the [support forum](http://arcnx.co/ashelp), there are some troubleshooting steps you can take beforehand to help speed up the process.

1. Check to make sure the javascripts are loading correctly. Load the page with the malfunctioning shortcode in your browser and view your page's source (usually CTRL + U). Look for jQuery, jQuery Tools and Arconix Shortcodes JS files there. If you don't see jQuery Tools or the Arconix scripts at all (they're somewhere near the bottom of the page), then your theme's `footer.php` file is likely missing `<?php wp_footer(); ?>`, which is necessary for the operation of mine and many other plugins. If you're unable or unwilling to resolve the issue yourself, contact the theme developer for assistance.
1. Check to make sure only one copy of jQuery is being loaded. Many times conflicts arise when themes or plugins load jQuery incorrectly, causing it to be loaded multiple times in multiple versions. In order to find the offending item, start by disabling your plugins one by one until you find the problem. If you've disabled all your plugins and the issue still persists, try switching to a different them, such as TwentyTen or TwentyTwelve to see if the problem is with your theme. Once you've found the problem, contact the developer for assistance getting the issue resolved.

= I have a problem or a bug =

Check out the WordPress [support forum](http://arcnx.co/ashelp) or the [Issues section on Github](http://arcnx.co/asissues)

= I have a great idea for your plugin! =

That's fantastic! Feel free to submit a pull request over at [Github](http://arcnx.co/assource), or you can contact me through [Twitter](http://arcnx.co/twitter), [Facebook](http://arcnx.co/facebook) or my [Website](http://arcnx.co/1).

== Screenshots ==
1. Buttons, buttons everywhere
2. Tabs and Accordions
3. Boxes of all types
4. Unordered list styles

== Changelog ==

= 2.1.13 =
* Fix - Cross Site Request Forgery (CSRF) vulnerability.

= 2.1.12 =
* Fix - Added a nonce check for Cross Site Request Forgery (CSRF) vulnerability on reset button.

= 2.1.11 =
* Fix - Cross Site Request Forgery (CSRF) vulnerability.
* Tweak - Update compatibility with WordPress 6.5
* Tweak - Update compatibility with WooCommerce 8.7

= 2.1.10 =
* Fix - Cross Site Request Forgery (CSRF) vulnerability.

= 2.1.9 =
* Bug Fix - Fixed an issue where output was not escaped correctly.

= 2.1.8 =
* Bug Fix - Cross site scripting vulnerability fix.

= 2.1.7 =
* Compatibility with WordPress 5.5

= 2.1.6 =
* When using Mesmerize WordPress theme on the store, Accordion shortcode was not working. It was showing an error in the console of the browsers. It has been fixed.

= 2.1.5 =
* The documentation link on the page & post page was wrong. It has been redorected to correct link.

= 2.1.4 =
* Usage Tracking has been added in the plugin. It provides an option to allow tracking of the non-sensitive data of our plugin from the website. You can read more about it [here](https://www.tychesoftwares.com/docs/docs/shortcodes/usage-tracking/).

= 2.1.3 =
* The plugin is now GDPR compliant.

= 2.1.2 =
* Bug Fix - The [tabs] shortcode was not working due to jQuery error. This has been fixed. It also fixes the error displayed in the console of the browser. 

= 2.1.1 =
* Bug Fix - Accordion opens only when the title is clicked twice. It does not open on single click.
* Bug Fix - Accordion title was not intended with the icon.

= 2.1.0 =
* You can now close accordian without opening another accordian. 
* Accordian title will now be indented when the title is bigger than a line.

= 2.0.4 =
* Enhancement - Updated to 4.6.3 of the FontAwesome CSS.
* Enhancement - Added a filter to make it easier for users to [update the FontAwesome version](https://gist.github.com/j-gardner/ce417c886a29163018edada999f9c12c)
* Bug - Fixed a PHP error notice

= 2.0.3 =
* Fixed a bug which was causing compatibility issues with some themes
* Fixed the alignment of toggle icons when embedding them inside boxes
* Formally set the toggle text color, which should fix most text color issues
* Added title support to button anchor tag

= 2.0.2 =
The light box colors are back. Blue, Green, Red and Tan now have light variants that match the version 1.x colors.

= 2.0.1 =
* Bug - Fixed a foreach() error that affected some users
* Bug - Fixed the icon position in the box shortcode to reflect previous functionality
* Enhancement - minor improvements in some shortcode CSS

= 2.0.0 =
This is a large update. I tried to maintain as much backward compatibility as possible, however there may be instances where you get unexpected behavior. If possible, test this in a staging environment first, or if none available, test your site after updating the plugin and let me know of any issues.

* Other - Removed the googlemap shortcode. There are other plugins available that are better for the task. If you are currently using my googlemap shortcode, please add code from [this link](https://gist.github.com/j-gardner/0f3adc735eb9ec7b5b39) to your theme's `functions.php` file to add the shortcode back in
* Feature - Updated the color spectrum to be more modern and support more default colors.
* Feature - Added support for FontAwesome icons with most shortcodes. The entire list of icons available here: http://fontawesome.github.io/Font-Awesome/icons/
* Enhancement - Added 2 additional button styles (flat and clear) which gives users additional display options
* Enhancement - Remove the MSIE specific filter property which was preventing sites from passing a W3C check
* Enhancement - Minify the CSS which improves download time and site speed
* Enhancement - On relevant shortcodes (accordions and columns) the use of `last=y` is no longer necessary as `last` by itself will work
* Enhancement - Improved sanitization strings which should fix broken output in certain non-English languages

= 1.2.0 =
* Updated toggle shortcode to be compatible with jQuery 1.9+
* Added shortcode parameter to allow the user to set the initial state of the toggle (closed or open)
* Restricted the dashboard widget to only show up for administrator users
* Added a filter to simplify prevention of the dashboard widget from loading at all
* Fixed a bug in the output of custom toggle CSS
* Improve the JS and CSS file overrides
* Other small fixes and improvements

= 1.1.2 =
* Added a color spec to the button hover code for more consistent behavior
* Improved the plugin's ability to control for themes which force bullet points on list items

= 1.1.1 =
* Fixed a bug in the button code

= 1.1.0 =
* Added support for compatibility mode which will eliminate collisions with other shortcodes using the same name.
* Added a meta box to the post and page screens that list all the shortcodes as well as a link to the documentation. Should help with trying to remember the shortcode names
* Added support for overriding the jQuery Tools registration which will allow the user to override which version of jQuery Tools is loaded without modifying core plugin code.
* Improved inline documentation in the code

= 1.0.4 =
* fixed a bug with the accordion script
* changed from a 'p' to a 'div' tag on the box shortcode (now allows the use of heading tags inside the box)
* properly clearing floats on column tags so they can be stacked

= 1.0.3 =
* Fixed a bug in the output script for the Google Map shortcode
* Tabs in prior tab groups will no longer show up in subsequent tab groups on the same page
* A floated image in a tab will now stay in its tab container properly
* Updated to v1.2.7 of the jQuery Tools library

= 1.0.2 =
* Added 'target' and 'rel' attribute support for button links

= 1.0.1 =
* Fixed a style bug regarding the alignment of bullet points
* Fixed a style bug regarding the padding and margin of tab titles
* Fixed a bug which was preventing the accordions from loading properly

= 1.0 =
* Completely re-written codebase
* Added ability to link to a specific tab through the use of anchor links. Read the documentation for more information on how to set those up
* Added an open and closed state image for the accordions
* Changed the toggle heading to a div due to css specificity conflicts when using heading tags
* Added a dashboard widget which includes links to plugin related blog posts on arconixpc.com as well links to the wiki page and WordPress support forum

= 0.9.5 =
* Maybe one of these days I'll get this right. Thanks to @gasie for setting me straight. This plugin is now loading jquery-tools without the a bundled jQuery. As such, I've added a jQuery dependency to my script registration which will load the WordPress supplied version. All of that simply means jQuery conflicts with other properly-coded plugins should be a thing of the past.

= 0.9.4 =
* accidently supplied the wrong version of jquery-tools script

= 0.9.3 =
* update the jquery-tools script to the latest v1.2.6

= 0.9.2 =
* Only load the javascript if a shortcode requires it to function
* Fix a typo in the four_fiths column function

= 0.9.1 =
* Added a load attribute to the accordions shortcode. This attribute allows the user to define which accordion is open by default when the page loads. The default is 1 and will load with the 1st accordion visible, but supports 0 (all accordions load closed) through 5 (the 5th accordion is open on load).

= 0.9 =
* Initial Release
