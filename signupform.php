<?php
/*
  Plugin Name: Signup Form plugin
  Description: Plugin for testing purpose
  Version: 1
  Author: Sahil gulati
  Author URI: http://sahilgulati.com
 */

global $jal_db_version;
$jal_db_version = '1.0';
function jal_install() {
    global $wpdb;
    global $jal_db_version;
    $table_name = $wpdb->prefix . 'signup_list';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
		uid mediumint(9) NOT NULL AUTO_INCREMENT,
		uname tinytext NOT NULL,
		country tinytext NOT NULL,
		state tinytext NOT NULL,
		uimage text NOT NULL,
		gender tinytext NOT NULL, 
		PRIMARY KEY  (uid)
	) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'jal_install' );

add_action('admin_menu', 'at_try_menu');
function at_try_menu()
{
    //adding plugin in menu
    add_menu_page('signup_list', //page title
        'Sign Up List', //menu title
        'manage_options', //capabilities
        'Signup_List', //menu slug
        Signup_list //function
    );
}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'signup_list.php');
require_once(ROOTDIR . 'signup.php');