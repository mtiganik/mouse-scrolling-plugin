<?php
/**
 * Plugin Name: Mouse Scrolling plugin
 * Description: A plugin to display an animated mouse on pages using the [mouseplugin] shortcode. Mouse will be fixed at bottom of screen
 * Version: 1.0
 * Author: Mihkel Tiganik
 * License: GPLv2 or later 
 * Author URI: https://github.com/mtiganik/mouse-scrolling-plugin/
 * */


function mouseplugin_enqueue_assets() {

    wp_enqueue_style(
        'mouseplugin-style',
        plugins_url('assets/mouseStyle.css', __FILE__)
    );


    wp_enqueue_script(
        'mouseplugin-script',
        plugins_url('assets/scripts.js', __FILE__),
        array(), // Dependencies (e.g., jQuery if needed)
        null,    // Version
        true     // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'mouseplugin_enqueue_assets');

// Shortcode to render mouse SVG
function mouseplugin_render_shortcode() {
    $svg_url = plugins_url('assets/mouse.svg', __FILE__);

    // Return the container div for the SVG
    return '<div id="svgContainer" data-svg-url="' . esc_url($svg_url) . '"></div>';
}
add_shortcode('mouseplugin', 'mouseplugin_render_shortcode');
