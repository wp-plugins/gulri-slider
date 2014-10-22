<?php



function gsp_func( $atts ) {
		global $gulri;
		$gulri = true;
				
		ob_start();
		
		$gsp_content = '';
			
		$atts = shortcode_atts( array(
		  'ids' => '',		  
		), $atts );
		
		$atts['ids'] = ($atts['ids']!='' && is_array(explode(',', $atts['ids']))?explode(',', $atts['ids']):array());
		
		    
			
		if(count($atts['ids'])>0){
			$gallery_id = date('Y');

			$images = array('full'=>array(), 'thumbs'=>array());
			$i=0;
			foreach($atts['ids'] as $id){
		
			 $image = wp_get_attachment_image_src( $id, 'full');
			 
			 if(!empty($image)){
				$i++;
			 $images['full'][] = '<li style="'.($i>1?'display: none;':'').' width: 100%;"><img src="'.current($image).'" class="slider-'.$gallery_id.' slide-'.$id.' colorbox-'.$gallery_id.'" height="363" /></li>';
			 $image = wp_get_attachment_image_src( $id, 'thumbnail');
			 $images['thumbs'][] = '<li class="ms-thumb slide-'.$id.'"><img class="colorbox-'.$gallery_id.'"  src="'.current($image).'" /></li>';
			 }
			 
			}
			
			include('front/gsp.go.php');
			  
			$gsp_content = ob_get_clean(); 			
			
		}
            

		
		return $gsp_content;
}
add_shortcode( 'gsp', 'gsp_func' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function gsp_add_meta_box() {

	$screens = array( 'post', 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'gsp_sectionid',
			__( 'Gulri Slider', 'gsp_textdomain' ),
			'gsp_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'gsp_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function gsp_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'gsp_meta_box', 'gsp_meta_box_nonce' );


	echo '<label for="gsp_shortcode">';
	
	_e( 'GSP Shortcode:', 'gsp_textdomain' );
	echo '</label> ';
	echo '<input id="gsp_shortcode" readonly="readonly" type="text" value="[gsp ids=&quot;1,2,3&quot;]" size="45" />';
	
}


