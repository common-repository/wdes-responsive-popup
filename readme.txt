=== WDES Responsive Popup ===
Contributors: Anthony Carbon
Donate link: https://www.paypal.me/anthonypagaycarbon
Tags: popup, modal, lightbox, cookie, responsive popup, window popup, anthonycarbon.com
Requires at least: 4.4
Tested up to: 5.3.2
Stable tag: 1.3.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WDES Responsive Popup WordPress plugin is designed for your page popups. It is responsive (mobile and desktop), browser, user, and developer friendly.

== Description ==

**WDES Responsive Popup** is a desktop, mobile, browser, and user/developer friendly. This plugin is design for your window popup content for your WordPress website. You can create a customizable popup window using shortcodes for your dashboard editor (post, page, widgets, and more) and a ready function for your custom templates. Commonly used in login, registration or signup, contact form, and more. You can add unlimited popups with their own configurations ([**page settings**](https://www.anthonycarbon.com/wdes-responsive-popup-documentation/)). It has different type of animations, window styles, close icon styles, can manage background image/color, font size, text color and many other options. You can manage your popup via cookie to expired by hours, days, months, or years and can be applied only in Home, Pages, Posts, Archives, or all pages. For more information, please check the plugin [**documentation**](https://www.anthonycarbon.com/wdes-responsive-popup-documentation/) and [**examples**](https://demo.anthonycarbon.com/wdes-responsive-popup-examples/).

= Features =

* With 5 available popup animation (Appear from Center, Top to Bottom, Bottom to Top, Left to Right, Right to Left).
* Up to 10 available close icon styles.
* With 4 available popup window style.
* onClick popup in navigation menus (`wp-admin/nav-menus.php`), no shortcode or coding required.
* Show popup after the page is loaded, no shortcode or coding required.
* Use image as background inside or outside the box of your popup window.
* Manageable styles like background color, font size, font color, width, and height without doing any CSS code.
* Disable or Enable overlay onClick (outside the white box that close when click).
* Close icon styles (border,background color,color) in page settings.
* Provide shortcodes for dashboard editor and ready functions for custom templates.
* Manage your popup visibility via cookie, so it will not keep on showing on your browser.
* Manage cookie to expired by hours, days, months, or years. 
* Manage cookie to applied only in Home, Pages, Posts, Archives, or all pages.
* Popup can be disabled if the user is logged-in.
* For more exciting features, please visit our [WDES Responsive Popup examples](https://demo.anthonycarbon.com/wdes-responsive-popup-examples/).

= Examples =
[WDES Responsive Popup examples](https://demo.anthonycarbon.com/wdes-responsive-popup-examples/)

= Related plugins =
[Anthony Carbon Plugins](https://www.anthonycarbon.com/product-category/wordpress-plugins/)

= Develop by =
[Anthony Carbon - WordPress Developer/Programmer](https://www.anthonycarbon.com/)

Happy coding everyone :D

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the `Plugins` screen in WordPress
3. Use the **WDES Popup** menu in your dashboard.

== Frequently Asked Questions ==

= Why do we have to use this plugin =

Because it is cool.

== Screenshots ==

1. Page Options.
2. Left to Right animation popup.
3. Right to Left animation popup.
3. Background image that fit to your screen.
3. Background image that fit only to your popup content.
3. Page Cookie Options.

== Changelog ==

= 1.1.9 =
* Dynamic the wpdb prefix to avoid conflict in the database prefix.
* Added zip files of the previous versions in braches plugin repository.
= 1.2.0 =
* Fix the `Uncaught TypeError: Cannot read property 'autofit' of undefined` error.
* Enqueue styles and script if the shortcode is exist.
= 1.2.1 =
* Change `.click()` to `.delegate()` so the click function will fire even in after ajax response.
= 1.2.2 =
* Add development functions PHP library.
= 1.2.3 =
* Add on click resize popup event listener.
= 1.2.4 =
* Update on click resize popup event listener error.
= 1.2.5 =
* Fix onload popup issue.
= 1.2.8 =
* Add minified CSS and JS.
= 1.2.9 =
* Add get('js_debug') to check the error.
* Fix show_popup, conflict on cookie popup on Error 9
= 1.3.0 =
* Replace the admin.js broken code
= 1.3.1 =
* Rename styles and scripts
* Add minified CSS
* Update development functions PHP library.
* Fix admin JS error `;`
* add `attr` custom attributes
= 1.3.2 =
* add Theme My Login re-open popup if has error
= 1.3.3 =
* Fix `Notice: Undefined index`

== Upgrade Notice ==

Just upgrade via Wordpress.