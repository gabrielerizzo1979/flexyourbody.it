<?php 

if ( defined('ICL_LANGUAGE_CODE') ){
    function get_language_shortcode() {
        if ( defined('ICL_LANGUAGE_CODE') ){
            return apply_filters( 'wpml_current_language', null );
        }else{
            return 'it';
        }
    }

    /* CUSTOM LANGUAGE SWITCHER
    *  
    *  In questa funzione viene generato l'html custom per il language switcher del menu mobile
    * 
    ------------------------------------------------------------------------------*/

    function theme_custom_languages_list(){

        if ( defined('ICL_LANGUAGE_CODE') )
        {
            $languages = apply_filters( 'wpml_active_languages', NULL, [ 'skip_missing' => 1, 'orderby' => 'code'] );
            get_template_part(
                'includes/template-parts/part', 'languages-list', 
                [
                    'current_lang'  => get_language_name(ICL_LANGUAGE_CODE),
                    'languages'     => $languages
                ]
            );
        }
    }


    /*----------------------------------------------------------------------------*/



    /* GET LANGUAGE NATIVE NAME
    *  
    *  In questa funzione viene ritornato il native name della lingua passata
    * 
    ------------------------------------------------------------------------------*/

    function get_language_name( $code='' )
    {
        global $sitepress;

        $details = $sitepress->get_language_details($code);
        $language_name = $details['native_name'];
        
        return $language_name;
    }

    /*----------------------------------------------------------------------------*/
    //
    //
    //
    // Imposto href x-default in inglese  e se la pagina è in no-index disabilito hreflang in toto
    // se mancano tutte le traduzioni di una url allora saltano le hreflang e la x-default
    // se manca la traduzione della lingua selezionata come x-default  allora salta solo la x-default
    add_filter( 'wpml_hreflangs', 'my_wpml_hreflangs_mod' );
    function my_wpml_hreflangs_mod($hreflangs){
        global $post;
        $lingue = array("en", "it"); // imposto le lingue del sito e metto come prima la x-default
        $loc_exists = false;
        $count = 0;
        $xdef = '';
        foreach ($hreflangs as $key => $lang)
        {
            
            if ($key == $lingue[0]){
                $xdef = $hreflangs[$key];
            }
            // verifico se esiste almeno una traduzione della url
            foreach ($lingue as $current_lingua){
                if ($key == $current_lingua){
                    $count++;
                }
            }
            if( $count > 1 ){
                $loc_exists = true;
            }
        }
        if( $loc_exists ){
            foreach ($hreflangs as $key => $lang)
            {
                foreach ($lingue as $current_lingua){
                    if ( $key == $current_lingua ){
                        if( get_post_meta( get_the_id(), '_yoast_wpseo_meta-robots-noindex', true ) ){
                            unset ($hreflangs[$key]);
                        }
                    }
                }
                if ($key == "x-default"){
                    if( $xdef != '' ){
                        $hreflangs[$key] = $xdef;
                    }else{
                        unset ($hreflangs[$key]);
                    }
                    //
                    if( get_post_meta( get_the_id(), '_yoast_wpseo_meta-robots-noindex', true ) ){
                        unset ($hreflangs[$key]);
                    }
                }
            }
        }else{
            //
            // se mancano tutte le traduzioni di una url allora saltano le hreflang
            foreach ($hreflangs as $key => $lang)
            {
                foreach ($lingue as $current_lingua){
                    if ($key == $current_lingua){
                        unset ($hreflangs[$current_lingua]);
                    }
                }
                if ($key == "x-default"){
                    unset ($hreflangs[$key]);
                }
            }
        }
        //
        return $hreflangs;
    }
    //
    //
    //

}