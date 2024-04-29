<?php
/**
 * Plugin Name: Silohon Related Posts
 * Version: 2.0.1
 * Plugin URI: https://github.com/akbarsilohon/silohon-related.git
 * Description: Plugin wordpress untuk menambah artikel terkait pada bodi artikel.
 * Tags: silohon, artikel terkait, irp
 * Author: Nur Akbar
 * Author URI: https://github.com/akbarsilohon
 * Text Domain: silohon-related
 * @package silohon-related
 * @link https://github.com/akbarsilohon/silohon-related.git
 */

require plugin_dir_path( __FILE__ ) . '/func/core.php';
require plugin_dir_path( __FILE__ ) . '/func/admin.php';

// Menu page =======================
// =================================
add_action( 'admin_menu', 'silohon_related_admin_menu' );
function silohon_related_admin_menu(){
    add_submenu_page(
        'options-general.php',
        'Artikel Terkait',
        'Silohon IRP',
        'manage_options',
        'silo_re_post',
        'silohon_plugin_related_posts'
    );
}


// Halaman pengaturan Silohon Related Posts ==============
// =======================================================
function silohon_plugin_related_posts(){ ?>

<div class="sl_re-container">
    <div class="sl_re-content">
        <h1 class="sl_re-h1">Silohon Related Post</h1>
        <form action="options.php" method="post" class="sl_re-form">
            <?php settings_fields( 'sl-re-settings' ); ?>
            <?php do_settings_sections( 'silo_re_post' ); ?>
            <?php submit_button('Save'); ?>
        </form>
    </div>

    <div class="sl_re-sidebar">
        <div class="sl_re-author"></div>
    </div>
</div>

<?php
}


// Pemanggilan script untuk admin panel ======================
// ===========================================================
add_action( 'admin_enqueue_scripts', 'sl_re_admin_enqueue' );
function sl_re_admin_enqueue(){
    wp_enqueue_style( 'slre-admin-style', plugins_url( './css/admin.css', __FILE__ ), array(), fileatime( plugin_dir_path( __FILE__ ) . '/css/admin.css'), 'all' );
}