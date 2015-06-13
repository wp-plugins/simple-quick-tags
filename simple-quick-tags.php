<?php
/*
Plugin Name: Simple Quick Tags
Plugin URI: http://sharewebdesign.com/wordpress-plugins/simple-quick-tags
Description: Adds quicktags to WordPress text area.
Author: Shawn Hayes, Share Web Design
Version: 1.1
Author URI: http://sharewebdesign.com
License: GPLv2 or later
*/

global $wp_version;

if ( !version_compare($wp_version, "3.3",">="))
{ 
die("You need to have Wordpress version 3.3 or higher installed to use the Simple Quick Tags plugin");
}

// Secure DB submission WP Code
function simple_quick_tags_init()
{    // Form inputs to submit
	register_setting('simple_quick_tags_options', 'simple-quicktags-p' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-br' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-h1' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-h2' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-h3' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-h4' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-h5' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-h6' );
	register_setting('simple_quick_tags_options', 'simple-quicktags-pb' );
}
add_action('admin_init', 'simple_quick_tags_init');


// Show link message upon activation
function sharewebdesign_plugin_admin_notices() {
    if (!get_option('sharewebdesign_plugin_notice_shown') && !is_plugin_active('plugin-directory/quick-tags.php')) {
    echo '<div class="updated"><p>Go to the <a href="options-general.php?page=simple-quicktags">Simple Quick Tags Settings</a> page to choose which QuickTags you would like to add to the Text (HTML) mode of the WordPress editor.</p></div>';
    update_option('sharewebdesign_plugin_notice_shown', 'true');
    }
}
add_action('admin_notices', 'sharewebdesign_plugin_admin_notices');


// Add settings link on plugin page
function sharewebdesign_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=simple-quicktags">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'sharewebdesign_plugin_settings_link' );

// Simple Quick Tags Options Page Content
function simple_quick_tags_options()
{
	
?>
<div class="wrap">
<?php screen_icon();?>
<h2>Simple Quick Tags Options</h2>
<p>Use the options below to choose which QuickTags you would like to add to the Text (HTML) mode of the WordPress editor.</p>
<form action="options.php" method="post" id="simple-quicktags-options-form">
<?php settings_fields('simple_quick_tags_options'); ?>
<input type="checkbox" id="simple-quicktags-p" name="simple-quicktags-p" value="1"<?php checked( 1, get_option('simple-quicktags-p'));?> >
<label for="simple-quicktags-p"><strong>Paragraph Tag:</strong> "<span><</span><span>p</span><span>></span><span><</span><span>/p</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-br" name="simple-quicktags-br" value="1"<?php checked( 1, get_option('simple-quicktags-br'));?> >
<label for="simple-quicktags-br"><strong>Break Tag:</strong> "<span><</span><span>br</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-h1" name="simple-quicktags-h1" value="1"<?php checked( 1, get_option('simple-quicktags-h1'));?> >
<label for="simple-quicktags-h1"><strong>h1 Tag:</strong> "<span><</span><span>h1</span><span>></span><span><</span><span>/h1</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-h2" name="simple-quicktags-h2" value="1"<?php checked( 1, get_option('simple-quicktags-h2'));?> >
<label for="simple-quicktags-h2"><strong>h2 Tag:</strong> "<span><</span><span>h2</span><span>></span><span><</span><span>/h2</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-h3" name="simple-quicktags-h3" value="1"<?php checked( 1, get_option('simple-quicktags-h3'));?> >
<label for="simple-quicktags-h3"><strong>h3 Tag:</strong> "<span><</span><span>h3</span><span>></span><span><</span><span>/h3</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-h4" name="simple-quicktags-h4" value="1"<?php checked( 1, get_option('simple-quicktags-h4'));?> >
<label for="simple-quicktags-h4"><strong>h4 Tag:</strong> "<span><</span><span>h4</span><span>></span><span><</span><span>/h4</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-h5" name="simple-quicktags-h5" value="1"<?php checked( 1, get_option('simple-quicktags-h5'));?> >
<label for="simple-quicktags-h5"><strong>h5 Tag:</strong> "<span><</span><span>h5</span><span>></span><span><</span><span>/h5</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-h6" name="simple-quicktags-h6" value="1"<?php checked( 1, get_option('simple-quicktags-h6'));?> >
<label for="simple-quicktags-h6"><strong>h6 Tag:</strong> "<span><</span><span>h6</span><span>></span><span><</span><span>/h6</span><span>></span>"</label><br />
<input type="checkbox" id="simple-quicktags-pb" name="simple-quicktags-pb" value="1"<?php checked( 1, get_option('simple-quicktags-pb'));?> >
<label for="simple-quicktags-pb"><strong>Paragraph Break:</strong> "<span><</span><span>p</span><span>></span><span>&n</span><span>bsp;</span><span><</span><span>/p</span><span>></span>"</label><br />

<p><input type="submit" name="submit" value="Save Settings" /></p>
</form>

</div>
<?php
}

// Add admin menu item for Simple Quick Tags Options Page
function simple_quick_tags_plugin_menu()
{
	add_options_page('Quick Tags Settings', 'Simple Quick Tags', 'manage_options', 'simple-quicktags', 'simple_quick_tags_options');
}
add_action('admin_menu','simple_quick_tags_plugin_menu');


// Extra Quick Tags for the WP Text Editor actually code
function simple_quick_tags_activate() {
	
// Get DB Info and set it to a variable	
	global $wpdb;

$table_name = $wpdb->base_prefix . 'options';

$simple_quicktags_p_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-p'");
$simple_quicktags_br_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-br'");
$simple_quicktags_h1_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-h1'");
$simple_quicktags_h2_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-h2'");
$simple_quicktags_h3_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-h3'");
$simple_quicktags_h4_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-h4'");
$simple_quicktags_h5_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-h5'");
$simple_quicktags_h6_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-h6'");
$simple_quicktags_pb_value = $wpdb->get_var("SELECT option_value FROM $table_name WHERE option_name = 'simple-quicktags-pb'");

    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">	
	<?php if ($simple_quicktags_p_value == 1) {?>
	QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph tag', 1 );
	<?php }
	if ($simple_quicktags_br_value == 1) {?>
	QTags.addButton( 'eg_br', 'br', '<br>', '', '', 'Break tag', 21 );
	<?php }
	if ($simple_quicktags_h1_value == 1) {?>
	QTags.addButton( 'eg_h1', 'h1', '<h1>', '</h1>', 'h1', 'Heading 1 tag', 22 );
	<?php }
	if ($simple_quicktags_h2_value == 1) {?>
	QTags.addButton( 'eg_h2', 'h2', '<h2>', '</h2>', 'h2', 'Heading 2 tag', 23 );
	<?php }
	if ($simple_quicktags_h3_value == 1) {?>
	QTags.addButton( 'eg_h3', 'h3', '<h3>', '</h3>', 'h3', 'Heading 3 tag', 24 );
	<?php }
	if ($simple_quicktags_h4_value == 1) {?>
	QTags.addButton( 'eg_h4', 'h4', '<h4>', '</h4>', 'h4', 'Heading 4 tag', 25 );
	<?php }
	if ($simple_quicktags_h5_value == 1) {?>
    QTags.addButton( 'eg_h5', 'h5', '<h5>', '</h5>', 'h5', 'Heading 5 tag', 26 );
	<?php }
	if ($simple_quicktags_h6_value == 1) {?>
	QTags.addButton( 'eg_h6', 'h6', '<h6>', '</h6>', 'h6', 'Heading 6 tag', 26 );
	<?php }
	if ($simple_quicktags_pb_value == 1) {?>
	QTags.addButton( 'eg_pb', 'pb', '<p>&nbsp;</p>', '', '', 'Paragraph break', 27 );
	<?php }	?>	
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'simple_quick_tags_activate' );