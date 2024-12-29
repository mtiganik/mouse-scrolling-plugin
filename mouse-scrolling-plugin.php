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
    $mouse_color = get_option('mouseplugin_color', '#41200e');

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

    wp_localize_script('mouseplugin-script', 'MousePluginSettings', array(
        'color' => $mouse_color,
        'show_globally' => get_option('mouseplugin_global', false),
    ));
}
add_action('wp_enqueue_scripts', 'mouseplugin_enqueue_assets');

// Shortcode to render mouse SVG
function mouseplugin_render_shortcode() {
    if(!get_option('mouseplugin_global', false) && !has_shortcode(get_post_field('post_content', get_the_ID()), 'mouseplugin')){
        return '';
    }

    $svg_url = plugins_url('assets/mouse.svg', __FILE__);

    // Return the container div for the SVG
    return '<div id="svgContainer" data-svg-url="' . esc_url($svg_url) . '"></div>';
}
add_shortcode('mouseplugin', 'mouseplugin_render_shortcode');


// admin settings
function mouseplugin_register_settings(){
    
    register_setting('mouseplugin_options', 'mouseplugin_color');
    register_setting('mouseplugin_options', 'mouseplugin_global');
}

add_action('admin_init', "mouseplugin_register_settings");

function mouseplugin_add_settings_page(){
    add_options_page(
        'Mouse Scroll Settings',
        'Mouse Scroll',
        'manage_options',
        'mouseplugin-settings',
        'mouseplugin_render_settings_page'
    );
}

add_action('admin_menu', 'mouseplugin_add_settings_page');

function mouseplugin_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Mouse Scroll Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('mouseplugin_options'); ?>
            <?php do_settings_sections('mouseplugin_options'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Mouse Color</th>
                    <td>
                        <input type="color" name="mouseplugin_color" value="<?php echo esc_attr(get_option('mouseplugin_color', '#ff5733')); ?>">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show Mouse on All Pages</th>
                    <td>
                        <input type="checkbox" name="mouseplugin_global" value="1" <?php checked(1, get_option('mouseplugin_global', false)); ?>>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
