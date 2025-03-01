=== EDD Changelog Badges ===
Contributors: verygoodplugins
Tags: easy-digital-downloads, changelog, edd
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Beautiful changelog display for Easy Digital Downloads products.

== Description ==

This plugin adds a shortcode to display beautifully formatted changelogs for your Easy Digital Downloads products.

Features:

* Adds `[edd_changelog]` shortcode
* Automatically adds visual badges for New, Improved, Fixed, and Dev changes
* Styled layout with clear visual hierarchy
* Compatible with EDD Software Licensing changelog field (`_edd_sl_changelog`)

== Installation ==

1. Upload the `edd-changelog` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode `[edd_changelog id="123"]` in your posts/pages

== Changelog ==

= 1.2.0 - Mar 1, 2025 =
* Added security badge
* Added color as a parameter to the badge configs
* Improved - Updated plugin slug to `edd-changelog-badges` to avoid conflicts with the [EDD Changelog plugin](https://wordpress.org/plugins/edd-changelog/)
* Improved - Badge output is properly escaped
* Improved - Default badge colors are updated for AA color contrast reqirements

= 1.1.0 - Feb 13, 2025 =
* Added `edd_changelog_badge_configs` filter to allow for custom badge configurations

= 1.0.0 - Feb 13, 2025 =
* Initial release 