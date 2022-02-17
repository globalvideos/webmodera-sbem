<?php

function global_btn_aovivo($atts)
{

    $atts = shortcode_atts(
        array(
            'live' => '',
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

    echo '<a style="color: #fff; padding: 10px; background: #17A2B8;" href="' . $url . '/?live=' . $atts['live'] . '&nome=' . $nome .  '&cidade=' . $cidade .  '&uf=' . $uf .  '&email=' . $email . '" target="_blank">Acessar Aovivo</a>';
	
}

add_shortcode('btn_aovivo', 'global_btn_aovivo');