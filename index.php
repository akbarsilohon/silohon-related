<?php
/**
 * Plugin Name: Silohon Postingan Terkait
 * Version: 1.7.9
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
        'Artikel Terkait',
        'manage_options',
        'silo_re_post',
        'silohon_plugin_related_posts'
    );
}


// Halaman pengaturan Silohon Related Posts ==============
// =======================================================
function silohon_plugin_related_posts(){ ?>

<div class="sl_re-container">
    <h1 class="sl_re-h1">Pengaturan</h1>
    <form action="options.php" method="post" class="sl_re-form">
        <?php settings_fields( 'sl-re-settings' ); ?>
        <?php do_settings_sections( 'silo_re_post' ); ?>
        <?php submit_button('Save'); ?>
    </form>
</div>

<?php
}