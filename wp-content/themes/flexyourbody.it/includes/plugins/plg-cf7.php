<?php



/* CF7 PLUGIN
*
*  In questa funzione viene effettuato il controllo su radio button privacy policy
*
------------------------------------------------------------------------------*/

// RIMUOVE QUALSIASI VALIDAZIONE DEI CAMPI RADIO BUTTON
//----------------------------------------------------------------------------//
remove_filter( 'wpcf7_validate_radio', 'wpcf7_checkbox_validation_filter', 10 );


// AGGIUNGE LA NUOVA VALIDAZIONE DEI CAMPI RADIO BUTTON
//----------------------------------------------------------------------------//
function custom_radio_validation_filter( $result, $tag )
{
	if ( $tag->name == 'acceptance-a' )
	{
        $personal_data = isset( $_POST['acceptance-a'] ) ? trim( wp_strip_all_tags($_POST['acceptance-a']) ) : '';
		$personal_data=strtolower($personal_data);
        if ( $personal_data != "si" && $personal_data != "yes" )
		{
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        }
    }

    return $result;
}
add_filter( 'wpcf7_validate_radio', 'custom_radio_validation_filter', 20, 2 );


// SE NESSUNA OPZIONE VIENE SELEZIONA PER IL RADIO BUTTON MARKETING
// ALLORA SOVRASCRIVI IL VALORE CON UN TESTO DA VISUALIZZARE NELLA EMAIL
//----------------------------------------------------------------------------//
function custom_radio_validation_filter_marketing( $result, $tag )
{
	if ( $tag->name == 'acceptance-b' )
	{
		$marketing = isset( $_POST['acceptance-b'] ) ? trim( wp_strip_all_tags($_POST['acceptance-b']) ) : '';
		$marketing=strtolower($marketing);
		if ( $marketing != "si" && $marketing != "yes" && $marketing != "no" )
		{
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        }
    }

    return $result;
}
add_filter( 'wpcf7_validate_radio', 'custom_radio_validation_filter_marketing', 20, 2 );

/*----------------------------------------------------------------------------*/




// CARICAMENTO CONDIZIONALE DI CSS, JS E RECAPTCHA SOLO SE IN PAGINE CON CF7
//----------------------------------------------------------------------------//
function cf7_conditionally_load_js_css()
{
	if (is_admin()) return;
	if( !empty( get_field('wo_indisponibilita_prodotto','options') ) && is_product() ){
		return;
	}
 	if ( !getBodyClass('contact-form') && !is_singular( 'offerte' )  && !is_singular( 'experience' ) ) {
			wp_deregister_script('contact-form-7');
			wp_deregister_script('google-recaptcha');
			wp_deregister_script('wpcf7-recaptcha');
			wp_dequeue_script('contact-form-7');
			wp_dequeue_script('google-recaptcha');
			wp_dequeue_script('wpcf7-recaptcha');
			wp_dequeue_style('contact-form-7');
 	}
	add_filter('wpcf7_autop_or_not', '__return_false');
}
add_action( 'wp_enqueue_scripts', 'cf7_conditionally_load_js_css', 99, 0 );

/*----------------------------------------------------------------------------*/
