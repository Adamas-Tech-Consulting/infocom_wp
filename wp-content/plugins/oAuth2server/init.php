<?php
/*
Plugin Name: oAuth2 server
Description:Use WordPress to power your OAuth Server.
Version: 1
Author: Adamastech
Author URI: 
*/

//Source : https://bshaffer.github.io/oauth2-server-php-docs/cookbook/

defined( 'ABSPATH' ) or die('Exit!');

if ( ! defined('WPOAUTH_FILE')) {
	define('WPOAUTH_FILE', __FILE__ );
}

// function to create the DB / Options / Defaults					
function oAuth_options_install() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
  
	$sql ="CREATE TABLE {$wpdb->prefix}oauth_clients (
	  client_id             VARCHAR(80)   NOT NULL,
	  client_secret         VARCHAR(80),
	  client_name			VARCHAR(255),
	  redirect_uri          VARCHAR(2000),
	  grant_types           VARCHAR(80),
	  scope                 VARCHAR(4000),
	  user_id               VARCHAR(80),
	  PRIMARY KEY (client_id)
	);

	CREATE TABLE {$wpdb->prefix}oauth_access_tokens (
	  access_token         VARCHAR(40)    NOT NULL,
	  client_id            VARCHAR(80)    NOT NULL,
	  user_id              VARCHAR(80),
	  expires              TIMESTAMP      NOT NULL,
	  scope                VARCHAR(4000),
	  PRIMARY KEY (access_token)
	);

	CREATE TABLE {$wpdb->prefix}oauth_authorization_codes (
	  authorization_code  VARCHAR(40)     NOT NULL,
	  client_id           VARCHAR(80)     NOT NULL,
	  user_id             VARCHAR(80),
	  redirect_uri        VARCHAR(2000),
	  expires             TIMESTAMP       NOT NULL,
	  scope               VARCHAR(4000),
	  id_token            VARCHAR(1000),
	  PRIMARY KEY (authorization_code)
	);

	CREATE TABLE {$wpdb->prefix}oauth_refresh_tokens (
	  refresh_token       VARCHAR(40)     NOT NULL,
	  client_id           VARCHAR(80)     NOT NULL,
	  user_id             VARCHAR(80),
	  expires             TIMESTAMP       NOT NULL,
	  scope               VARCHAR(4000),
	  PRIMARY KEY (refresh_token)
	);

	CREATE TABLE {$wpdb->prefix}oauth_users (
	  username            VARCHAR(80),
	  password            VARCHAR(80),
	  first_name          VARCHAR(80),
	  last_name           VARCHAR(80),
	  email               VARCHAR(80),
	  email_verified      BOOLEAN,
	  scope               VARCHAR(4000),
	  PRIMARY KEY (username)
	);

	CREATE TABLE {$wpdb->prefix}oauth_scopes (
	  scope               VARCHAR(80)     NOT NULL,
	  is_default          BOOLEAN,
	  PRIMARY KEY (scope)
	);

	CREATE TABLE {$wpdb->prefix}oauth_jwt (
	  client_id           VARCHAR(80)     NOT NULL,
	  subject             VARCHAR(80),
	  public_key          VARCHAR(2000)   NOT NULL
	);";

	

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'oAuth_options_install');

// Delete table when deactivate
function table_remove_from_database() {
     global $wpdb;
     $table_name = "{$wpdb->prefix}oauth_clients,
     				{$wpdb->prefix}oauth_access_tokens,
     				{$wpdb->prefix}oauth_authorization_codes,
     				{$wpdb->prefix}oauth_refresh_tokens,
     				{$wpdb->prefix}oauth_users,
     				{$wpdb->prefix}oauth_scopes,
     				{$wpdb->prefix}oauth_jwt";

   

     $sql = "DROP TABLE IF EXISTS $table_name;";
     $wpdb->query($sql);
     delete_option("my_plugin_db_version");
}    
register_deactivation_hook( __FILE__, 'table_remove_from_database' );

//menu items
add_action('admin_menu','sinetiks_Clients_modifymenu');
function sinetiks_Clients_modifymenu() {
	//this is the main item for the menu
	add_menu_page('oAuth Server', //page title
	'oAuth', //menu title
	'manage_options', //capabilities
	'client_list', //menu slug
	'client_list' //function
	);
	//this is a submenu
	add_submenu_page('client_list', //parent slug
	'Add New Client', //page title
	'Add New', //menu title
	'manage_options', //capability
	'create_client', //menu slug
	'create_client'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Client', //page title
	'Update', //menu title
	'manage_options', //capability
	'client_update', //menu slug
	'client_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'client-list.php');
require_once(ROOTDIR . 'client-create.php');
require_once(ROOTDIR . 'client-update.php');