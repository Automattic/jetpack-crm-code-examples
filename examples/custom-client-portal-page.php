<?php
/*
Plugin Name: Jetpack CRM [Example Code]
Plugin URI: https://jetpackcrm.com
Description: This code example adds a custom tab to the Jetpack CRM Client Portal
Version: 1.0
Author: <a href="https://jetpackcrm.com">Jetpack CRM</a>
*/

	/* 
		Info
		--------
		This is a code example from JetpackCRM.com, 
		it shows you how to add your own custom tabs 
		to the Jetpack CRM Company View Vitals area
		--------
		We advise you to rename the plugin and function names to fit your project.

	*/

/* 
	Add your own endpoint (this is your page slug) 
	* Make sure you change this in both instances below: 'yourendpoint'
*/
add_filter('jetpack_crm_portal_endpoints', 'jetpackCRM_clientPortal_yourEndpoint');
function jetpackCRM_clientPortal_yourEndpoint($allowed_endpoints){
	$allowed_endpoints[] = 'yourendpoint';
	return $allowed_endpoints;
}
function jetpackCRM_portal_your_endpoint() {
	add_rewrite_endpoint( 'yourendpoint', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'jetpackCRM_portal_your_endpoint' );

/* 
	Here we add a menu item to the client portal tabbed menu
	* Make sure 'yourendpoint' matches the endpoint specified above, and don't forget to change your menu name!
	* The "fa-icon" string represents a font-awesome v4 icon: https://fontawesome.com/v4.7.0/icons/
*/
add_filter('jetpack_crm_portal_nav_menu_items', 'jetpackCRM_clientPortal_yourendpointMenu');
function jetpackCRM_clientPortal_yourendpointMenu($nav_items){
	$nav_items['yourendpoint'] = array('name' => 'Nav Menu Name', 'icon' => 'fa-icon', 'show' => 1);
	return $nav_items;
}

/* 
	Here's where we actually expose the content:
*/
add_action('jetpack_crm_portal_yourendpoint_endpoint', 'jetpackCRM_clientPortal_yourendpoint');
function jetpackCRM_clientPortal_yourendpoint(){
	
	if(!is_user_logged_in()){
		return zeroBS_get_template('login.php');
	}else{
		if (!jetpackCRM_portalIsUserEnabled())
			return zeroBS_get_template('disabled.php');
		else
			return jetpackCRM_clientPortalProCustomerYour_Content();
	}

}

/* 
	This example loads a html file from the plugin directory (same as this file)
*/
function jetpackCRM_clientPortalProCustomerYour_Content(){
	$template_file = plugin_dir_path(__FILE__) . "portal-page.php";
	include $template_file;
}