<?php

//------------------------------------------------------------------
//---------------------- CONTEUDO BLOQUEADO ------------------------
//------------------------------------------------------------------

function bloqueado_shortcode( $atts = array(), $content = null ) {
    if(is_user_logged_in()) {
		return $content;
	}
}

add_shortcode( 'bloqueado', 'bloqueado_shortcode' );

//------------------------------------------------------------------
//---------------------- ESCONDE ADMIN BAR -------------------------
//------------------------------------------------------------------

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

//------------------------------------------------------------------
//---- REDICIONA NON ADMIN QUE TENTAM ACESSAR O WP-ADMIN -----------
//------------------------------------------------------------------
//
function redirect_non_admin_user(){
    if ( is_user_logged_in() ) {
        if ( !defined( 'DOING_AJAX' ) && !current_user_can('administrator') ){
            wp_redirect( site_url() );  exit;
        }
    }
}
add_action( 'admin_init', 'redirect_non_admin_user' );

//------------------------------------------------------------------
//------------------------ CSS GLOBAL ------------------------------
//------------------------------------------------------------------

function global_custom_css() {
    echo "<link href='" . plugin_dir_url( __FILE__ ). "styles/global.css' rel='stylesheet' type='text/css'>";
}
add_action( 'wp_head', 'global_custom_css' );

//------------------------------------------------------------------
//---------------------- SCRIPT COOKIES ----------------------------
//------------------------------------------------------------------

function global_cookie() {    
    echo "<script type='text/javascript' src='" . plugin_dir_url( __FILE__ ). "/scripts/cookies.js'></script>";
}
add_action( 'wp_head', 'global_cookie' );
