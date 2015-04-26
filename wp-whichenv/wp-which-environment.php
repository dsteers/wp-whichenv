<?php
/**
 * wp-which-environment
 */
/*
Plugin Name: wp-which-environment
Plugin URI: 
Description: This plugin inserts an envrionment tag in the upper banner, allowing the user to differentiate between development environments.
Version: 1.0
Author: Deanna Steers
Author URI: 
License: GPLv2 or later
Text Domain: akismet
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

/*
WHAT THIS PAGE DOES:

This page is processes stored url information and sets the admin option if all 
is filled out properly.

*/


// Plugin path from root directory
define( 'WHICHENV__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Register JS and CSS
wp_register_style('whichenv-styles.css', WHICHENV__PLUGIN_URL . 'whichenv-styles.css');
wp_enqueue_style( 'whichenv-styles.css');
wp_register_script('whichenv.js', WHICHENV__PLUGIN_URL . 'whichenv.js');
wp_enqueue_script( 'whichenv.js');

// Initializing the url_standard var 
if(get_option('url_standard')!='false') {
	update_option('url_standard', 'true');
}

// Include admin settings page in wp dashboard
function whichenv_admin() {
    include('wp-whichenv-settings.php');
    include('whichenv-options.php');
}

// Insert Which Environment tab in tools menu in dashboard
function whichenv_admin_setup() {
	add_management_page("Which Environment Settings", "Which Environment Settings", 1, "Which-Environment-Settings", "whichenv_admin");
	add_management_page("", "", 1, "whichenv-options", "whichenv_admin");
}	 
add_action('admin_menu', 'whichenv_admin_setup');


function my_tweaked_admin_bar() {
	global $wp_admin_bar;	
	//TODO: exchange this variable to call on get_stite_url()
	$this_url = 'dev.plugin.rp3.vagrant.local';
	$myString='Improper Whichenv Url Settings';

	//RP3 standard url indicators
	$urlInd = array(
		'test' => "Testing",
		'staging' => "Staging",
		'prod' => "Production",
		'dev' => "Development",
		'intdev' => "Integration",
		'qc' => "Quality Control",
		'uat' => "User Acceptance Testing"
	);
	//Stored custom url types
	$optionKey = array(
		'development' => "Development",
		'integration' => "Integration",
		'qc' => "Quality Control",
		'uat' => "User Acceptance Testing",
		'production' => "Production",
		'testing' => "Testing",
		'staging' => "Staging"
	);

	//IF IS STANDARD
	if(get_option('url_standard')!='false') {
		foreach($urlInd as $url => $value){
			if( strpos($this_url,$url) !== false ) { 
				$myString = $value;
			} 
		}
	} else {
		foreach($optionKey as $option => $value){
			if( strcmp( get_option( $option.'_env'), $this_url ) == 0  ) { 
				$myString = $value;
			}
		}
	}

	$wp_admin_bar->add_node(array(
		'id'    => 'environment-indicator',
		'title' => $myString,
		'href'  => '#!'
	));
}
add_action( 'wp_before_admin_bar_render', 'my_tweaked_admin_bar' ); 
