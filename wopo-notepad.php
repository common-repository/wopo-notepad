<?php
/**
 * Plugin Name:       WoPo Notepad
 * Plugin URI:        https://wopoweb.com/contact-us/
 * Description:       Microsoft Notepad clone for your website
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            WoPo Web
 * Author URI:        https://wopoweb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wopo-notepad
 * Domain Path:       /languages
 */

function wopono_get_app_url(){
    return plugins_url('html/app/index.html',__FILE__);
}

add_action('wp_enqueue_scripts', 'wopono_enqueue_scripts');

function wopono_enqueue_scripts(){
    global $post;
    $is_shortcode = intval(has_shortcode( $post->post_content, 'wopo-notepad'));
    if ((function_exists('wopopp_add_drawing_button') && is_singular()) || $is_shortcode){
        wp_enqueue_style('XP',plugins_url( '/assets/css/XP.css', __FILE__ ));
        wp_enqueue_style('wopo-notepad',plugins_url( '/assets/css/main.css', __FILE__ ));
        wp_enqueue_script('wopo-notepad', plugins_url( '/assets/js/main.js', __FILE__ ),array('jquery'));
        wp_localize_script( 'wopo-notepad', 'wopoSolitaire', array(
            'app_url' => wopono_get_app_url(),
            'is_shortcode' => $is_shortcode,
        ) ); 
        do_action('wopo_notepad_enqueue_scripts');
    }
}

add_shortcode('wopo-notepad', 'wopo_notepad_shortcode');
function wopo_notepad_shortcode( $atts = [], $content = null) {
    ob_start();?>
    <div id="wopo_notepad_window" class="window">
        <div class="title-bar">
            <div class="title-bar-text"><?php echo __('WoPo Notepad','wopo-notepad') ?></div>
            <div class="title-bar-controls">
            <button class="btn-minimize" aria-label="Minimize"></button>
            <button class="btn-maximize" aria-label="Maximize"></button>
            <button class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="window-body">
            <iframe id="wopo_notepad"></iframe>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}