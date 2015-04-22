=== Pinterest Widgets ===
Contributors: pderksen, nickyoung87
Tags: pinterest, widgets, follow button, pin widget, board widget, profile widget, social, social media, image, images, photo, photos, social button
Requires at least: 3.9.3
Tested up to: 4.2
Stable tag: 1.0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Various widgets for Pinterest including the Follow button, Pin widget, Profile widget and Board Widget. Includes shortcodes.

== Description ==

Add simple Pinterest widgets to your site in minutes. Widgets behave and appear like those from the [official Pinterest widget builder](http://business.pinterest.com/widget-builder/).

Includes:

* Follow button: Invite people to follow you on Pinterest from your site.
* Pin widget: Embed one of your Pins on your site.
* Profile widget: Show up to 30 of your latest Pins on your site.
* Board widget: Show up to 30 of your favorite board’s latest Pins.
* Shortcodes for all 4 widgets.

The "Pin It" Button widget is *not* included in this plugin and is instead included in the separate [Pinterest "Pin It" Button plugin](http://pinplugins.com/pin-it-button-pro/?utm_source=wordpress_org&utm_medium=link&utm_campaign=pinterest_widgets) ([Lite version](http://wordpress.org/plugins/pinterest-pin-it-button/) / [Pro version](http://pinplugins.com/pin-it-button-pro/?utm_source=wordpress_org&utm_medium=link&utm_campaign=pinterest_widgets)), which we also created.

Spanish and Serbian translations by Ogi Djuraskovic of [firstsiteguide.com](http://firstsiteguide.com/).

[Follow this project on Github](https://github.com/pderksen/WP-Pinterest-Widgets).

== Installation ==

= 1. Admin Search =
1. In your Admin, go to menu Plugins > Add.
1. Search for `pinterest widgets`.
1. Find the plugin that's labeled `Pinterest Widgets`.
1. Look for the author name `Phil Derksen` on the plugin.
1. Click to install.
1. Activate the plugin.
1. Go to Appearance > Widgets to add widgets to your site.

= 2. Download & Upload =
1. Download the plugin (a zip file) on the right column of this page.
1. In your Admin, go to menu Plugins > Add.
1. Select the tab "Upload".
1. Upload the .zip file you just downloaded.
1. Activate the plugin.
1. Go to Appearance > Widgets to add widgets to your site.

= 3. FTP Upload =
1. Download the plugin (.zip file) on the right column of this page.
1. Unzip the zip file contents.
1. Upload the `pinterest-widgets` folder to the `/wp-content/plugins/` directory of your site.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to Appearance > Widgets to add widgets to your site.

== Frequently Asked Questions ==

= General Troubleshooting =

Your theme must implement **wp_footer()** in the footer.php file, otherwise JavaScript will not load correctly. You can test if this is the issue by switching to a WordPress stock theme such as twenty-twelve temporarily.

Shortcode help available within the plugin admin.

[Follow this project on Github](https://github.com/pderksen/WP-Pinterest-Widgets)

== Screenshots ==

1. Follow button display
2. Pin widget display
3. Profile widget display ("header" size)
4. Board widget display (custom size: 200 width by 350 height)
5. Follow button widget settings
6. Pin widget settings
7. Profile widget settings
8. Board widget settings

== Changelog ==

= 1.0.6 - April 22, 2015 =

* Updated calls to add_query_arg to prevent any possible XSS attacks.
* Added option to always enqueue scripts & styles (enabled by default).
* Tested up to WordPress 4.2.

= 1.0.5 =

* Tested up to WordPress 4.1.
* Simplified text domain function.

= 1.0.4 =

* Tested up to WordPress 4.0.

= 1.0.3 =

* Added Spanish and Serbian translations (thanks to Ogi Djuraskovic of [firstsiteguide.com](http://firstsiteguide.com/)).

= 1.0.2 =

* Updated code to only include JS and CSS if there is a widget/shortcode on the page.

= 1.0.1 =

* Added action and filter hooks for extensibility.
* Tested up to WordPress 3.9.

= 1.0.0 =

* Initial release.
