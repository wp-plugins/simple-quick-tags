=== Simple Quick Tags ===

Contributors: sharewebdesign, Shawn Hayes
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EZFS2B64JEU7Q
Tags: quicktags, text editor, html
Requires at least: 3.3
Tested up to: 4.2.2
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Quick Tags allows you to add useful quicktag buttons to the Text (HTML) mode of the WordPress WYSIWYG editor via a settings page.

== Description ==

This plugin allows you to add useful quicktag buttons to the Text (HTML) mode of the WordPress WYSIWYG editor. There is a settings page to choose from a list of quicktags you would like to use.

Currently on the list of options are: p, br, h1, h2, h3, h4, h5, h6, pb

This plugin was written by Shawn Hayes at [Share Web Design](http://sharewebdesign.com/) to make it easier to implement useful quicktag buttons. If you have any questions please feel free to visit our contact page at [Contact Us](http://sharewebdesign.com/contact-us) or post a question in the support area at [WordPress.org](https://wordpress.org/support/plugin/simple-quick-tags).

== Installation ==

1. Unzip into your /wp-content/plugins/ directory. If you're uploading it make sure to upload the top-level folder. Don't just upload all the php files and put them in /wp-content/plugins/.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the settings page and choose which QuickTags you would like to add to the Text (HTML) mode of the WordPress editor.
4. Be sure to hit the “Save Settings” button after you have checked the boxes on the settings page.

You're done!

== Frequently Asked Questions ==

We don't have any FAQs yet but please feel free to contact us with any questions you may have.

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png

== Changelog ==

= 1.1 =
Added $table_name = $wpdb->base_prefix . 'options'; and now using $table_name rather than just using wp_options.

= 1.0 =
Public Release

== Upgrade Notice ==

This fixes the issue with the plugin not working on WordPress installations that use a custom database prefix (e.g. NOT wp_). 