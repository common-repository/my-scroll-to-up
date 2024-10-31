<?php
/*
Plugin Name: Scroll To Up
Plugin URI: http://prowpexpert.com/
Description: This is Scroll To Up plugin really looking awesome top Scroll. Everyone can use the top Scroll plugin easily like other wordpress plugin. 
Author: Md sohel
Version: 1.0
Author URI: http://prowpexpert.com/
*/
function scroll_to_up_wp_latest_jquery_d() {
	wp_enqueue_script('jquery');
}
add_action('init', 'scroll_to_up_wp_latest_jquery_d');

/*Some Set-up*/
define('SCROLL_TO_UP_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

function plugin_function_scroll_to_up() {
   // wp_enqueue_script( 'jeba-js-d', plugins_url( '/js/jquery.divas-1.1.min.js', __FILE__ ), true);
 // wp_enqueue_style( 'jebacss-d', plugins_url( 'style.css', __FILE__ ));
    wp_enqueue_style( 'fontello-css', SCROLL_TO_UP_PLUGIN_PATH.'css/fontello.css');
}

add_action('init','plugin_function_scroll_to_up');


function scroll_to_up_script_function () {?>

	<script type="text/javascript">
		jQuery(document).ready(function($){

			(function($){$.fn.backToTop=function(options){var $this=$(this);$this.hide().click(function(){$("body, html").animate({scrollTop:"0px"});});var $window=$(window);$window.scroll(function(){if($window.scrollTop()>0){$this.fadeIn();}else{$this.fadeOut();}});return this;};})(jQuery);jQuery('body').append('<a class="back-to-top"><i class="fa fa-angle-up"></i></a>');jQuery('.back-to-top').backToTop();
			
		});
	</script>

<?php
}
add_action('wp_footer','scroll_to_up_script_function');





function add_scroll_to_top_options_framwrork()  
{  
	add_options_page('Scroll To Up settings', 'Scroll To Up settings', 'manage_options', 'scrolltop-settings','scroll_to_up_options_framwrork');  
}  
add_action('admin_menu', 'add_scroll_to_top_options_framwrork');


add_action( 'admin_enqueue_scripts', 'wp_scroll_to_up_add_color_picker' );
function wp_scroll_to_up_add_color_picker( $hook ) {
 
    if( is_admin() ) {
     
        // Add the color picker css file      
        wp_enqueue_style( 'wp-color-picker' );
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( '/inc/color-pickr.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
}


if ( is_admin() ) : // Load only if we are viewing an admin page






function scroll_to_top_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'scroll_top_p_options', 'scroll_top_up_options', 'scroll_top_up_validate_options' );
}

add_action( 'admin_init', 'scroll_to_top_register_settings' );

// Default options values
$scroll_top_up_options = array(
	'scroll_bottom_bg' => ' red',
	'scroll_bottom_hover_bg' => ' black',
	'scroll_bottom_hover_color' => ' #fff',
	'scroll_icon_color' => '#fff'
);

// Function to generate options page
function scroll_to_up_options_framwrork() {
	global $scroll_top_up_options, $auto_hide_mode, $where_visible_scrollbar;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	
	<h2>Scroll to top Options</h2>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'scroll_top_up_options', $scroll_top_up_options ); ?>
	
	<?php settings_fields( 'scroll_top_p_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	
	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	
	


		<tr valign="top">
			<th scope="row"><label for="scroll_bottom_bg">Scroll top Background</label></th>
			<td>
				<input id="scroll_bottom_bg" type="text" name="scroll_top_up_options[scroll_bottom_bg]" value="<?php echo stripslashes($settings['scroll_bottom_bg']); ?>" class="color-field" /><p class="description">Select Scroll bottom color here. You can also add html HEX color code.</p>
			</td>
		</tr>	

		<tr valign="top">
			<th scope="row"><label for="scroll_icon_color">Scroll top icon color</label></th>
			<td>
				<input id="scroll_icon_color" type="text" name="scroll_top_up_options[scroll_icon_color]" value="<?php echo stripslashes($settings['scroll_icon_color']); ?>" class="color-field" /><p class="description">Select scroll top icon color here. You can also add html HEX color code.</p>
			</td>
		</tr>	
		<tr valign="top">
			<th scope="row"><label for="scroll_bottom_hover_bg">Scroll top Hover Background</label></th>
			<td>
				<input id="scroll_bottom_hover_bg" type="text" name="scroll_top_up_options[scroll_bottom_hover_bg]" value="<?php echo stripslashes($settings['scroll_bottom_hover_bg']); ?>" class="color-field" /><p class="description">Select Scroll bottom hover color here. You can also add html HEX color code.</p>
			</td>
		</tr>	

		<tr valign="top">
			<th scope="row"><label for="scroll_bottom_hover_color">Scroll top Hover icon color</label></th>
			<td>
				<input id="scroll_bottom_hover_color" type="text" name="scroll_top_up_options[scroll_bottom_hover_color]" value="<?php echo stripslashes($settings['scroll_bottom_hover_color']); ?>" class="color-field" /><p class="description">Select scroll top icon hover color here. You can also add html HEX color code.</p>
			</td>
		</tr>	

			
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}


function scroll_top_up_validate_options( $input ) {
	global $scroll_top_up_options;

	$settings = get_option( 'scroll_top_up_options', $scroll_top_up_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS

	$input['scroll_bottom_bg'] = wp_filter_post_kses( $input['scroll_bottom_bg'] );
	$input['scroll_icon_color'] = wp_filter_post_kses( $input['scroll_icon_color'] );
	$input['scroll_bottom_hover_color'] = wp_filter_post_kses( $input['scroll_bottom_hover_color'] );
	$input['scroll_bottom_hover_bg'] = wp_filter_post_kses( $input['scroll_bottom_hover_bg'] );

		
		
	
	return $input;
}


endif;  // EndIf is_admin()



function get_scroll_top_up_data_form_plugin() {

?>

<?php global $scroll_top_up_options; $scroll_top_up_options_settings = get_option( 'scroll_top_up_options', $scroll_top_up_options ); ?>


	<style type="text/css">

		.back-to-top {
			width: 35px;
			height: 35px;
			text-align: center;
			padding-top: 5px;
			background: <?php echo $scroll_top_up_options_settings['scroll_bottom_bg']; ?>;
			color:  <?php echo $scroll_top_up_options_settings['scroll_icon_color']; ?> ;
			display: inline-block;
			position: fixed;
			right: 20px;
			bottom: 8px;
			z-index: 99999999;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
		}
		.back-to-top:hover {
			cursor: pointer;
			background: <?php echo $scroll_top_up_options_settings['scroll_bottom_hover_bg']; ?>; 
			color:  <?php echo $scroll_top_up_options_settings['scroll_bottom_hover_color']; ?>;
		}
	</style>

<?php

}

add_action('wp_head', 'get_scroll_top_up_data_form_plugin');









?>