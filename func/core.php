<?php

function tambah_kata_setiap_300_kata($content) {
    global $post;
    $kata_per_injeksi = !empty(get_option('sl_re_options')['limit']) ? get_option('sl_re_options')['limit'] : 300;
    $pengulangan = get_option('sl_re_options')['jumlah'];
    $kata_tambahan = render_related_func($post->ID);

    $dom = new DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $xpath = new DOMXPath($dom);
    $totalKata = 0;
    $jumlah_dalam_artikel = !empty( $pengulangan ) ? $pengulangan : 3;
    $pengulanganSaatIni = 0;
    $nodes = $xpath->query('//text()');

    foreach ($nodes as $node) {
        if ($node->parentNode->nodeName === 'p') {
            $kata = explode(' ', trim($node->nodeValue));
            $jumlahKata = count($kata);
            $totalKata += $jumlahKata;

            if ($totalKata >= $kata_per_injeksi && !empty($kata_tambahan) && $pengulanganSaatIni < $jumlah_dalam_artikel) {
                $fragment = $dom->createDocumentFragment();
                $random_key = array_rand($kata_tambahan);
                $random_post_id = $kata_tambahan[$random_key];

                if (!empty($kata_tambahan)) {
                    jalankan_fungsi_cetak_css();
                }

                unset($kata_tambahan[$random_key]);

                $fragment->appendXML(render_html_related_post($random_post_id));
                
                if ($node->parentNode->nextSibling) {
                    $node->parentNode->parentNode->insertBefore($fragment, $node->parentNode->nextSibling);
                } else {
                    $node->parentNode->parentNode->appendChild($fragment);
                }
                $totalKata = 0;
                $pengulanganSaatIni++;
            }
        }
    }

    $content = $dom->saveHTML();
    return $content;
}
add_filter('the_content', 'tambah_kata_setiap_300_kata');

// mendapatkan data postingan ==================
function render_related_func($current_post_id) {
    $terkait = get_option('sl_re_options')['terkait'];
    $kategori = get_the_category($current_post_id);
    $tags = wp_get_post_tags($current_post_id, array('fields' => 'ids'));
    $jumlah = !empty(get_option('sl_re_options')['jumlah']) ? get_option('sl_re_options')['jumlah'] : 3;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $jumlah,
        'post__not_in' => array($current_post_id),
        'fields' => 'ids',
        'orderby'   =>  'rand'
    );

    if( $terkait === 'category' ){
        $args['tax_query'] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => wp_list_pluck($kategori, 'term_id'),
            ),
        );
    } else if( $terkait === 'tag' ){
        $args['tax_query'] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tags,
            ),
        );
    } else if( $terkait === 'cat_tag' ){
        $args['tax_query'] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => wp_list_pluck($kategori, 'term_id'),
            ),
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $tags,
            ),
        );
    }



    $query = new WP_Query($args);
    return $query->posts;
}

// mendapatkan html untuk related post =========
function render_html_related_post($post_id) {
    $bgColor = !empty( get_option('sl_re_options')['bg_color']) ? get_option('sl_re_options')['bg_color'] : '#333';
    $borderColor = !empty( get_option('sl_re_options')['border_color']) ? get_option('sl_re_options')['border_color'] : '#90ee90';
    $textColor = !empty( get_option('sl_re_options')['text_color']) ? get_option('sl_re_options')['text_color'] : '#fff';
    $text = !empty( get_option('sl_re_options')['text_read_to']) ? get_option('sl_re_options')['text_read_to'] : 'Baca juga:';
    $link = !empty( get_option('sl_re_options')['type_link']) ? get_option('sl_re_options')['type_link'] : 'nofollow';
    $target = !empty( get_option('sl_re_options')['target']) ? get_option('sl_re_options')['target'] : '_blank';
    
    $outputHtml = '<div class="sl_re-post" style="background-color: ' . $bgColor . '; border-left: 4px solid ' . $borderColor . ';">';
    $outputHtml .= '<a rel="' . $link . '" target="'. $target .'" href="' . get_the_permalink($post_id) . '" class="re-link">';
    $outputHtml .= '<span class="re-button" style="background-color: ' . $borderColor . '; color: '. $textColor .'">'. $text .'</span>';
    $outputHtml .= '<p class="re-title" style="color: ' . $textColor . ';">' . get_the_title($post_id) . '</p>';
    $outputHtml .= '<img src="' . get_the_post_thumbnail_url($post_id, 'thumbnail', array('class' => 'related-thumbnail', 'loading' => 'lazy')) . '" alt="' . get_the_title($post_id) . '" class="re-thumbnail"/>';
    $outputHtml .= '</a>';
    $outputHtml .= '</div>';

    return $outputHtml;
}

// Mencetak css pada header ==================
// ===========================================
function jalankan_fungsi_cetak_css(){
    wp_enqueue_style( 'sl-re-style', plugins_url( '../css/style.css', __FILE__ ), array(), fileatime( plugin_dir_path( __FILE__ ) . '../css/style.css' ), 'all' );
}