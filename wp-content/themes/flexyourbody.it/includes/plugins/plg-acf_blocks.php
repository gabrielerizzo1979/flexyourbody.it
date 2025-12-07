<?php

function filter_block_categories_when_post_provided( $block_categories, $editor_context ) {
    if ( ! empty( $editor_context->post ) ) {
        $fyb_category = array(
            'slug'  => 'fyb',
            'title' => __( 'FYB BLOCKS', 'acf' ),
            'icon'  => null,
        );
        // Filtra le categorie esistenti per rimuovere 'immedia' se già presente
        $block_categories = array_filter($block_categories, function($cat) {
            return $cat['slug'] !== 'fyb';
        });
        array_unshift( $block_categories, $fyb_category );
    }
    return $block_categories;
}
add_filter( 'block_categories_all', 'filter_block_categories_when_post_provided', 10, 2 );
//
//
//
// Funzione per aggiungere html a tutti i blocchi tranne quelli con acf/
function aggiungi_classe_al_blocco( $block_content, $block ) {
    if ( !str_contains($block['blockName'], 'acf/') && $block['blockName'] != '' ) {
        $block_content = '<div class="cms-content"><div class="cms-content__container">' . $block_content . '</div></div>';
    }
    return $block_content;
}
//add_filter( 'render_block', 'aggiungi_classe_al_blocco', 10, 2 );




function my_custom_block_class($block_content, $block) {
    // Specifica il nome del blocco a cui vuoi aggiungere la classe
    if ($block['blockName'] === 'core/paragraph' || $block['blockName'] === 'core/list') {
        // Aggiungi la classe al primo tag HTML del blocco
        $block_content = preg_replace_callback(
            '/<([a-z]+)([^>]*)>(.*?)<\/\1>/s',
            function ($matches) {
                $tag = $matches[1];
                $attributes = $matches[2];
                $inner_content = $matches[3];
                
                // Verifica se esiste già l'attributo 'class'
                if (strpos($attributes, 'class="') !== false) {
                    // Se esiste, aggiungi la tua classe personalizzata
                    $new_attributes = str_replace('class="', 'class="cms-custom-style ', $attributes);
                } else {
                    // Se non esiste, aggiungi l'attributo 'class' con la tua classe personalizzata
                    $new_attributes = $attributes . ' class="cms-custom-style"';
                }
                
                // Ricostruisci il tag con i nuovi attributi e il contenuto interno
                return "<$tag$new_attributes>$inner_content</$tag>";
            },
            $block_content
        );
    }
    
    return $block_content;
}

// Applica il filtro 'render_block'
add_filter('render_block', 'my_custom_block_class', 10, 2);
//
//
//
function register_acf_blocks() {
    $dir = get_template_directory() . '/template-parts/blocks/';
    if (is_dir($dir)) {
        $items = scandir( $dir );
        foreach ($items as $item) {
            if ($item != '.' && $item != '..' && is_dir($dir . DIRECTORY_SEPARATOR . $item)) {
                register_block_type( get_template_directory() . '/template-parts/blocks/'.$item );
            }
        }
    }
}
add_action( 'init', 'register_acf_blocks' );
//
?>