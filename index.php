<?php 

/*
	Plugin Name: Gulri Slider
	Plugin URI: http://www.websitedesignwebsitedevelopment.com/gsp
	Description: An easy way to shape your gallery into an elegant slider.
	Version: 1.0
	Author: Fahad Mahmood 
	Author URI: http://www.androidbubbles.com
	License: GPL3
*/ 


	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 
    include('functions.php');
	global $gs_premium_link;
	$gs_premium_link = 'http://shop.androidbubbles.com/product/gulri-slider-pro';
	
	add_action( 'admin_enqueue_scripts', 'register_gsp_scripts' );
	add_action( 'wp_enqueue_scripts', 'register_gsp_scripts' );
	
	if(is_admin()){
		$plugin = plugin_basename(__FILE__); 
		add_filter("plugin_action_links_$plugin", 'gsp_plugin_links' );			
	}