=== Arconix Shortcodes ===
Contributors: jgardner03
Tags: arconix, shortcodes, tabs, toggle, buttons, accordion
Requires at least: 3.1
Tested up to: 3.3.1
Stable tag: 1.0.4

Arconix Shortcodes provides a number of useful design elements to compliment any website.

== Description ==

With this plugin you can easily add various kinds of styled boxes, buttons, tabs, accordions, unordered lists and more. Choose from the supplied options or advanced users can easily add their own by extending the built-in styles.

= Features =
* 8 style shortcodes (accordions, boxes, tabs, toggles, etc...)
* 5 utility shortcodes (login-logout, google-map, etc...)
* Support for up to 5 columns

== Installation ==

You can download and install Arconix Shortcodes using the built in WordPress plugin installer. If you download the plugin manually, make sure the files are uploaded to `/wp-content/plugins/arconix-shortcodes/`.

Activate Arconix-Shortcodes in the "Plugins" admin panel using the "Activate" link.

== Upgrade Notice ==

Upgrade normally via your Wordpress admin -> Plugins panel.

== Frequently Asked Questions ==

= Where can I find more information on how to use the shortcodes?  =

* Visit the plugin's [Wiki Page](http://arcnx.co/aswiki "Arconix Shortcodes Wiki") for documentation on all the shortcodes
* Tutorials on advanced plugin usage can be found at [Arconix Computers](http://arconixpc.com/tag/arconix-shortcodes)

= I have a problem or a bug =

* Check out the WordPress [support forum](http://arcnx.co/ashelp)

= Can you add this shortcode or that option? =

I can certainly look into it. Contact me through [Twitter](http://arcnx.co/twitter), [Facebook](http://arcnx.co/facebook) or my [Website](http://arcnx.co/1 "Arconix Computers").

== Screenshots ==
1. Buttons, buttons everywhere
2. Tabs and Accordions
3. Boxes of all types
4. Unordered list styles

== Changelog ==

= 1.1-dev =
* Add support for compatibility mode which will prevent collisions with other shortcodes using the same name

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