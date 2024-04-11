<?php
/**
 * Pengaturan di Admin panel silohon-related
 * @package silohon-related
 * @link https://github.com/akbarsilohon/silohon-related.git
 */

add_action( 'admin_init', 'sl_re_settings_init' );

function sl_re_settings_section_callback() {
    echo '<p class="sl_re-p">Customize the style and appearance of Silohon Related Post, set the number of inline related posts in each article, set the injection at every word count, choose the link type, target link, and adjust the color to your liking.</p>';
}

function sl_re_bg_color_render() {
    $options = get_option('sl_re_options');
    $bgColor = !empty($options['bg_color']) ? $options['bg_color'] : '#333333';
    ?>
    <input type='color' name='sl_re_options[bg_color]' value='<?php echo esc_attr($bgColor); ?>'>
    <?php
}

function sl_re_border_color_render() {
    $options = get_option('sl_re_options');
    $borderColor = !empty($options['border_color']) ? $options['border_color'] : '#e74b2c';
    ?>
    <input type='color' name='sl_re_options[border_color]' value='<?php echo esc_attr($borderColor); ?>'>
    <?php
}

function sl_re_text_color_render() {
    $options = get_option('sl_re_options');
    $textColor = !empty( $options['text_color']) ? $options['text_color'] : '#ffffff';
    ?>
    <input type='color' name='sl_re_options[text_color]' value='<?php echo esc_attr( $textColor ); ?>'>
    <?php
}

function sl_re_limit_render(){
    $options = get_option('sl_re_options');
    $reCount = !empty($options['limit']) ? $options['limit'] : 300; ?>
    <input type='number' name='sl_re_options[limit]' value='<?php echo esc_attr($reCount); ?>'>
    <?php
}

function sl_re_jumlah_render(){
    $options = get_option('sl_re_options');
    $reJumlah = !empty($options['jumlah']) ? $options['jumlah'] : 3; ?>
    <input type='number' name='sl_re_options[jumlah]' value='<?php echo esc_attr($reJumlah); ?>'>
    <?php
}

function sl_re_text_read_to_render(){
    $options = get_option('sl_re_options');
    $reText = !empty($options['text_read_to']) ? $options['text_read_to'] : 'Read Too:'; ?>
    <input type='text' name='sl_re_options[text_read_to]' value='<?php echo esc_attr($reText); ?>'>
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

function sl_re_terkait_render(){
    $options = get_option('sl_re_options'); ?>
    <select name='sl_re_options[terkait]'>
        <option value='all' <?php selected( $options['terkait'], 'all' ); ?>>All Posts</option>
        <option value='category' <?php selected( $options['terkait'], 'category' ); ?>>Category Only</option>
        <option value='tag' <?php selected( $options['terkait'], 'tag' ); ?>>Tag Only</option>
        <option value="cat_tag" <?php selected( $options['terkait'], 'cat_tag' ); ?>>Category & Tag</option>
    </select>
    <?php
}


function sl_re_settings_init() {
    register_setting( 'sl-re-settings', 'sl_re_options' );

    add_settings_section(
        'sl_re_plugin_section',
        __( null, 'wordpress' ),
        'sl_re_settings_section_callback',
        'silo_re_post'
    );

    // Jumlah artikel di injek --------------------
    add_settings_field(
        'sl_re_jumlah',
        __( 'Inline Related Count', 'wordpress' ),
        'sl_re_jumlah_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    // Injek setelah berapa kata --------------------
    add_settings_field(
        'sl_re_limit',
        __( 'Every Number of Words', 'wordpress' ),
        'sl_re_limit_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    // Text read to -----------------------------
    add_settings_field(
        'sl_re_text_read_to',
        __( 'Text Read Too', 'wordpress' ),
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

    // Terkait dengan --------------------------
    add_settings_field(
        'sl_re_terkait',
        __( 'Related Type', 'wordpress' ),
        'sl_re_terkait_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    add_settings_field(
        'sl_re_bg_color',
        __( 'Background Color', 'wordpress' ),
        'sl_re_bg_color_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    add_settings_field(
        'sl_re_border_color',
        __( 'Border Color', 'wordpress' ),
        'sl_re_border_color_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );

    add_settings_field(
        'sl_re_text_color',
        __( 'Text Color', 'wordpress' ),
        'sl_re_text_color_render',
        'silo_re_post',
        'sl_re_plugin_section'
    );
}