<?php
 /**
 * Plugin Name:       Easy Slider for Elementor
 * Plugin URI:        https://github.com/imkrunalkanojiya/easy-slider-for-elementor
 * Description:       Easy Slider widget for Elementor.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Krunal Kanojiya
 * Author URI:        https://portfolio.krunalkanojiya.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       easy-slider-for-elementor
 */

if(!defined ('ABSPATH')){
	exit;
}

/**
 * Registering Widget
 */

function easy_slider_for_elementor( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/easy-slider.php' );

	$widgets_manager->register( new \Elementor_Easy_Slider() );

}
add_action( 'elementor/widgets/register', 'easy_slider_for_elementor' );



/**
 * 
 * Adding Style and Scrips
 */

function easy_slider_for_elementor_dependencies(){

	// wp_register_script( 'easy-slider-script-1', plugins_url( 'assets/js/jquery.min.js', __FILE__ ), array() );
	wp_register_script( 'easy-slider-script-2', plugins_url( 'assets/js/owl.carousel.min.js', __FILE__ ), array());

	/* Styles */
	wp_register_style( 'easy-slider-style-1', plugins_url( 'assets/css/owl.carousel.min.css', __FILE__ ) ,array());
	wp_register_style( 'easy-slider-style-2', plugins_url( 'assets/css/owl.theme.default.min.css', __FILE__ ) ,array());
}

add_action( 'wp_enqueue_scripts', 'easy_slider_for_elementor_dependencies' );