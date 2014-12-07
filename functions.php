<?php
	global $gulri;
	$gulri = false;
	
	include('gsp.inc.php');
	//FOR QUICK DEBUGGING
	if(!function_exists('pre')){
		function pre($data){
			echo '<pre>';
			print_r($data);
			echo '</pre>';	
		}	 
	}

	function register_gsp_scripts($hook_suffix) {
		
		
		
		wp_register_style( 'gsp-style', plugins_url('css/style.css', __FILE__) );
		
		
		wp_enqueue_script('jquery');	
		
		if(is_admin()){
			wp_enqueue_style( 'gsp-style' );
			
			
				
				
						
		}else{
			
			wp_enqueue_script(
				'gsp-scripts',
				plugins_url('js/scripts.js', __FILE__)
			);	
			
			wp_register_style( 'gsp-styles', plugins_url('css/gsp.css', __FILE__) );
			wp_enqueue_style( 'gsp-styles' );


			wp_register_style( 'gsp-flexslider', plugins_url('css/flexslider.css', __FILE__) );
			wp_enqueue_style( 'gsp-flexslider' );


			wp_register_style( 'gsp-animate', plugins_url('css/animate.css', __FILE__) );
			wp_enqueue_style( 'gsp-animate' );

			
			wp_enqueue_script(
				'gsp-scripts',
				plugins_url('js/gsp.js', __FILE__)
			);	
			
			wp_enqueue_script(
				'gsp-flexslider',
				plugins_url('js/jquery.flexslider-min.js', __FILE__)
			);	
			
			wp_enqueue_script(
				'gsp-easing',
				plugins_url('js/jQuery.easing.min.js', __FILE__)
			);		
		}
		
	}	
		
	function gsp_get_include_contents($filename) {
		$filename =  plugin_dir_path(__FILE__).$filename;
		if (is_file($filename)) {
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
	}	
	
	function gsp_plugin_links($links) { 
		global $gs_premium_link;
		
		$gs_premium_link = '<a href="'.$gs_premium_link.'" title="Go Premium" target=_blank>Go Premium</a>'; 
		array_unshift($links, $gs_premium_link); 
		return $links; 
	}	
	
?>