<?php

function global_countdown($atts)
{

    $atts = shortcode_atts(
        array(
            'live' => '',
			'data' => ''
        ),
        $atts,
        'global_cadastra_form'
    );

    //$current_user = wp_get_current_user();
    $nome = $_COOKIE['cpf'];
    $cidade = $_COOKIE['cidade'];
    $uf = $_COOKIE['uf'];
    $email = $_COOKIE['email'];
    $url = get_option('aovivo_global');

    echo do_shortcode('[ujicountdown id="global" expire="' . $atts['data'] . '" hide="true" url="'  . $url . '/?live=' . $atts['live'] . '&nome=' . $nome .  '&cidade=' . $cidade .  '&uf=' . $uf .  '&email=' . $email . '" subscr="" recurring="2" rectype="second" repeats=""]');
	
}

add_shortcode('contador', 'global_countdown');

