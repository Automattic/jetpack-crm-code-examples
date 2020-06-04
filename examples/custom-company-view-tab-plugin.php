<?php
/*
Plugin Name: Jetpack CRM [Example Code]
Plugin URI: https://jetpackcrm.com
Description: This code example adds a custom tab to your Jetpack CRM Company View
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
		--------
		Guide: 
			https://kb.jetpackcrm.com/knowledge-base/adding-custom-tabs-to-contact-view-or-company-view/
		--------
		For extra info on WordPress Hooks & Actions: 
			https://developer.wordpress.org/reference/functions/add_filter/

	*/


/* 
	This function tells our plugin to add the tags, on the action admin_init
*/
function jetpackCRM_custom_admin_init(){

	// Here we add the filter which will call our function lower down in this file
	// ... when a company's vital tabs are loaded
	add_filter( 'zbs-company-vital-tabs', 'jetpackCRM_custom_modifyTabs', 10, 2);


} add_action('admin_init','jetpackCRM_custom_admin_init');

/* 
	This function lets you modify the tabs displayed, 
	here we add our own new custom tab.

	... the company ID is passed via $id
	... using this you could generate any HTML you need to.
*/
function jetpackCRM_custom_modifyTabs( $arr, $id ) {
    
    // this is just a check :)
    if (!is_array($arr)) $arr = array();

    // Here we add the new tab
    // 	'id' = Represents HTML id attribute, must be unique & html-attribute format (e.g. a-b-c)
    //	'name' = Title string
    //  'content' = the HTML you want to display in your tab (you could use another function to produce this)
    $arr[] = array(
    	'id' => 'example-tab',
    	'name' => 'Example Tab',
    	'content' => '<h2>The Company ID is: '.$id.'</h2>'
    	);

    return $arr;
}
