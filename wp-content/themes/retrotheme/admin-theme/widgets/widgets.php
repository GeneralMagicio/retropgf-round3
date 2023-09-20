<?php
/*-----------------------------------------------------------------------------------*/
/* Load the widgets.
/*-----------------------------------------------------------------------------------*/

/* WOO COMMERCE RELATED WIDGETS */

/**
 * Register Mini cart popup widget
 */
function mini_cart_popup_widgets_init() {

	register_sidebar(
		array(
			'name'          => 	__( 'Mini cart popup' ),
			'id'            => 	'mini_cart_popup',
			'before_widget'	=>	'<div class="mini-cart-popup">',
			'after_widget'  => 	'</div>',
			'before_title'  => 	'<h2>',
			'after_title'   => 	'</h2>',
		)
	);

}
add_action( 'widgets_init', 'mini_cart_popup_widgets_init' );