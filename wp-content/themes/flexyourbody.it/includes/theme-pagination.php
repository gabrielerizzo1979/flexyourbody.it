<?php
function theme_check_is_paginated()
{
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        return true;
    } else {
        return false;
    }
}
function theme_pagination_nav()
{
	$defaults = array(
        'range'           => 4,
        'custom_query'    => FALSE,
        'previous_string' => __( '‹', _TEXT_DOMAIN_ ),
        'next_string'     => __( '›', _TEXT_DOMAIN_ ),
        'first_string'    => __( '«', _TEXT_DOMAIN_ ),
        'last_string'     => __( '»', _TEXT_DOMAIN_ ),
        'before_output'   => '<nav class="pager"><ul class="pager__items">',
        'after_output'    => '</ul></nav>'
    );

    $args = $defaults;

    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );

    if ( $count <= 1 )
        return FALSE;

    if ( !$page )
        $page = 1;

    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }

    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );
    $firstpage = esc_attr( get_pagenum_link(1) );

    if ( $firstpage && (1 != $page) )
        $echo .= '<li class="pager__item pager__item--first"><a href="' . $firstpage . '" title="' . __( 'prima', _TEXT_DOMAIN_ ) . '">' . $args['first_string'] . '</a></li>';

    if ( $previous && (1 != $page) )
        $echo .= '<li class="pager__item pager__item--previous"><a href="' . $previous . '" title="' . __( 'precedente', _TEXT_DOMAIN_) . '">' . $args['previous_string'] . '</a></li>';

    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                $echo .= '<li class="pager__item is-active"><a class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</a></li>';
            } else {
                $echo .= sprintf( '<li class="pager__item"><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }

    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li class="pager__item pager__item--next"><a href="' . $next . '" title="' . __( 'successiva', _TEXT_DOMAIN_) . '">' . $args['next_string'] . '</a></li>';

    $lastpage = esc_attr( get_pagenum_link($count) );
    if ( $lastpage ) {
        $echo .= '<li class="pager__item pager__item--last"><a href="' . $lastpage . '" title="' . __( 'ultima', _TEXT_DOMAIN_ ) . '">' . $args['last_string'] . '</a></li>';
    }

    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}
?>