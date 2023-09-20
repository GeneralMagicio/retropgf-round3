<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/* ==========================================================================
   Gallery
   ========================================================================== */

/**
 * Custom gallery function
 *
 * @param string $output
 * @param array $attr
 *
 * @return mixed|string|void
 */
function dcc_gallery_shortcode($output, $attr) {

    global $post, $wp_locale;

    static $instance = 0;

    $instance++;

    if (isset($attr['orderby'])) {

        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);

        if (!$attr['orderby']){
            unset($attr['orderby']);

        }

    }

    extract(
    	shortcode_atts(
    		array(
		        'order'         =>  'ASC',
		        'orderby'       =>  'menu_order ID',
		        'id'            =>  $post->ID,
		        'itemtag'       =>  'div',
		        'icontag'       =>  'span',
		        'captiontag'    =>  'span',
		        'columns'       =>  1,
		        'class'         =>  '',
		        'lightbox'      =>  'gallery',
		        'size'          =>  'square',
		        'include'       =>  '',
		        'exclude'       =>  ''
            )
	    , $attr)
    );

    //$id = intval($id);

    $_attachments = get_posts(array(
        'include'           =>  $include,
        'post_status'       =>  'inherit',
        'post_type'         =>  'attachment',
        'post_mime_type'    =>  'image',
        'order'             =>  $order,
        'orderby'           =>  $orderby
    ));

    $attachments = array();

    foreach ($_attachments as $key => $val) {
        $attachments[$val->ID] = $_attachments[$key];
    }

    //if no images send nothing!!!
    if (empty($attachments)){
        return '';
    }

    //$output = apply_filters('gallery_style', "<div class='gallery lightbox clr " . $class . "'>");

    $output = '
		<!-- start:content-gallery -->
		<div class="content-gallery mb-3">
    
			<div class="gallery lightbox row no-gutters">
    ' .  PHP_EOL;



        $galleryCounter =   1;
        $numberOfImages =   count($attachments);

        foreach ($attachments as $id => $attachment) {

            
            $full       =   wp_get_attachment_image_src($id, 'full');
	        $thumbSize  =   ($galleryCounter == 1)? 'full' : 'thumbnail';
	        $thumb      =   wp_get_attachment_image_src($id, $thumbSize);

            $imageData  =   wp_get_attachment($id);

            $imageCaption   =   ( isset($imageData['alt']) )? $imageData['alt'] : '';

            $classColFirst  =   ($galleryCounter == 1)? 'col-12 col-md-12' : 'col-6 col-md-4';

            $output .= '<div class="col ' . $classColFirst . ' item mb-3">' .  PHP_EOL;

				$output .= '
					<a href="' . $imageData['caption'] . '" rel="gallery' . $post->ID . '" class="fancybox-youtube">
                        <span class="play"></span>
				' .  PHP_EOL;

			$output .= '</div>' .  PHP_EOL;

	        $galleryCounter ++;
        }

        $output .= '</div>';

    $output .= '</div>' .  PHP_EOL;

    return $output;

}

add_filter('post_gallery', 'dcc_gallery_shortcode', 10, 2);