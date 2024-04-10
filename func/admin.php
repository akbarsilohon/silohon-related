<?php
/**
 * Pengaturan di Admin panel silohon-related
 * @package silohon-related
 * @link https://github.com/akbarsilohon/silohon-related.git
 */

add_action( 'admin_init', 'sl_re_settings_init' );

function sl_re_settings_section_callback() {
    echo '<p>Pengaturan plugin related post by silohon. Atur warna yang sesuai, tentukan setelah berapa kata akan di injeck</p>';
}

function sl_re_bg_color_render() {
    $options = get_option('sl_re_options');
    ?>
    <input type='color' name='sl_re_options[bg_color]' value='<?php echo esc_attr($options['bg_color']); ?>'>
    <?php
}

function sl_re_border_color_render() {
    $options = get_option('sl_re_options');
    ?>
    <input type='color' name='sl_re_options[border_color]' value='<?php echo esc_attr($options['border_color']); ?>'>
    <?php
}

function sl_re_limit_render(){
    $options = get_option('sl_re_options'); ?>
    <input type='number' name='sl_re_options[limit]' value='<?php echo esc_attr($options['limit']); ?>'>
    <?php
}

function sl_re_jumlah_render(){
    $options = get_option('sl_re_options'); ?>
    <input type='number' name='sl_re_options[jumlah]' value='<?php echo esc_attr($options['jumlah']); ?>'>
    <?php
}

function sl_re_text_read_to_render(){
    $options = get_option('sl_re_options'); ?>
    <input type='text' name='sl_re_options[text_read_to]' value='<?php echo esc_attr($options['text_read_to']); ?>'>
    <?php
}

function sl_re_type_link_render(){
    $options = get_option('sl_re_options'); ?>
    <select name='sl_re_options[type_link]'>
        <option value='nofollow' <?php selected( $options['type_link'], 'nofollow' ); ?>>No Follow</option>
        <option value='dofollow' <?php selected( $options['type_link'], 'dofollow' ); ?>>Do Follow</option>
    </select>
    <?php
}

function sl_re_target_render(){
    $options = get_option('sl_re_options'); ?>
    <select name='sl_re_options[target]'>
        <option value='_blank' <?php selected( $options['target'], '_blank' ); ?>>_blank</option>
        <option value='_self' <?php selected( $options['target'], '_self' ); ?>>_self</option>
    </select>
    <?php
}


function sl_re_text_color_render() {
    $options = get_option('sl_re_options');
    ?>
    <input type='color' name='sl_re_options[text_color]' value='<?php echo esc_attr($options['text_color']); ?>'>
    <?php
}

function sl_re_settings_init() {
    register_setting( 'sl-re-settings', 'sl_re_options' );

    add_settings_section(
        'sl_re_plugin_section',
        __( 'Tampilan', 'wordpress' ),
        'sl_re_settings_section_callback',
        'silo_re_post'
    );

    // Jumlah artikel di injek --------------------
    add_settings_field(
        'sl_re_jumlah',
        __( 'Jumlah', 'wordpress' ),
        'sl_re_jumlah_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    // Injek setelah berapa kata --------------------
    add_settings_field(
        'sl_re_limit',
        __( 'Injek Setelah', 'wordpress' ),
        'sl_re_limit_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    // Text read to -----------------------------
    add_settings_field(
        'sl_re_text_read_to',
        __( 'Text Read To', 'wordpress' ),
        'sl_re_text_read_to_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    // Type link ---------------------------------
    add_settings_field(
        'sl_re_type_link',
        __( 'Type Link', 'wordpress' ),
        'sl_re_type_link_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    // Target ---------------------------------
    add_settings_field(
        'sl_re_target',
        __( 'Target', 'wordpress' ),
        'sl_re_target_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    add_settings_field(
        'sl_re_bg_color',
        __( 'Warna Latar Belakang', 'wordpress' ),
        'sl_re_bg_color_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    add_settings_field(
        'sl_re_border_color',
        __( 'Warna Border', 'wordpress' ),
        'sl_re_border_color_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    add_settings_field(
        'sl_re_text_color',
        __( 'Warna Teks', 'wordpress' ),
        'sl_re_text_color_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );
}