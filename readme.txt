=== WP Power Stats ===
Contributors: artifex404
Donate link: http://www.websivu.com/wp-power-stats/
Tags: statistics, stats, visit, visits, visitor, visitors, charts, analytics, tracker
Requires at least: 3.3
Tested up to: 4.3
Stable tag: 2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Powerful and accurate real-time visitor statistics of your WordPress site.

== Description ==

View your site visits statistics at a glance: browsers, operating systems, visitors and much more!

One click install and you are ready to go! A lot of advanced settings to fine-tune the tracking.

This lightweight plugin is deeply integrated in WordPress, which makes it fast, secure and reliable.

[View sample screenshots](http://wordpress.org/plugins/wp-power-stats/screenshots/)

Claim back your privacy: no third party services, all statistics are private on your hosting and are accessible only by you.

Statistics features:

* Page views
* Devices
* Traffic sources
* Browsers
* Operating systems
* Geographical location
* Search terms
* Viewed posts
* Referrers

Languages:

* English
* French
* Spanish
* Finnish
* Hungarian
* Russian

== Installation ==

This section describes how to install the plugin and get it to work.

1. Upload `wp-power-stats.zip` to the `/wp-content/plugins/` directory
2. Unzip `wp-power-stats.zip` in the folder
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= The plugin does not work, what should I do? =

Disable and then re-enable the plugin in the 'Plugins' menu in WordPress.
If that does not help, try disabling other installed plugins, to exclude the possibility of a plugin conflict.

= Where are the settings for the plugin located? =

They are located under 'Statistics' section in the 'Settings' section.

= When I test the plugin, the pageview number increments by 2, is it a bug? =

If you test the plugin by loading the blog, make sure that you have the setting 'Administration Exclusion' under the 'Exclusions' tab set to 'yes'. One hit is formed from the blog view, the other one from the administration panel hit if the setting is set to 'no'.

= Why the sudden drop of visitors number when I upgraded to version 2.0?

The version 2.0 uses a completely new method to detect only real human visitors.

== Screenshots ==

1. Responsive design screenshots and some features listed.
2. WP Power Stats sample statistics.
2. Settings page.

== Changelog ==

= 2.1 =
* Respect visitors privacy by adding Do Not Track visitor setting support
* Fixes the wrong url to images in the widget

= 2.0.1 =
* Fixes UTC date bug
* Fixes bug in saving options
* Updated search engine definition list

= 2.0 =
* Massive under-the-hood performance enhancements
* Numerous new settings for the tracking: exclusions, permissions and advanced settings
* You can now replace your dashboard with WP Power Stats overview
* Improved statistics detection: Search Engines, Countries, Mobile Devices and Browsers
* Moved Settings to the Statistics menu
* Fixes activation error on some hosts
* Fixes breaking Wordpress layout on some installations

= 1.3.3 =
* Fixes IP exclusion bug

= 1.3.2 =
* Fixes another bug related to saving options
* Fixes plugin activation bug

= 1.3.1 =
* Fixes a bug when saving options. Thank you 'myplugins', 'michaldunaj' and 'davegiannini' for reporting

= 1.3 =
* You can now exclude IP addresses from statistics
* Added total count of pageviews and visits to the widget
* Rearranged and renamed settings menus

= 1.2 =
* Added a setting to select roles that can view statistics
* Added a setting to select roles that can change statistics settings
* Updated mobile device detection
* Added French language (Olivier)
* Added Spanish language (Luciano)

= 1.1.1 =
* Added Hungarian language (Halas)
* Added Finnish language
* Updated mobile detection
* Fixes top posts permalink empty link

= 1.1 =
* Added a statistic widget
* Added a setting page
* Added a setting to exclude hits from administrators and bots
* Added support for Wordpress starting from version 3.3
* Fixes Wordpress multisite plugin installation
* Fixes overview layout bug

= 1.0.3 =
* Added browser icons
* Added Russian translation
* Fixes bugs with older PHP version
* Fixes bug with keywords

= 1.0.2 =
* Added help tab
* Enhanced responsive design
* Removed deprecated functions

= 1.0.1 =
* Fixes bug on plugin initialization

= 1.0 =
* Initial release