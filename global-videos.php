<?php
/*
Plugin Name: Global Videos (SBEM)
Plugin URI: https://www.globalvideos.com.br
description: Plugins para o site da SBEM
Version: 1.0.0
Author: Global Videos
Author URI: https://www.globalvideos.com.br
License: GPL2
 */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/globalvideos/webmodera-sbem',
	__FILE__,
	'global-videos'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
//$myUpdateChecker->setAuthentication('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');

include( plugin_dir_path( __FILE__ ) . 'acesso_gravado.php');
include( plugin_dir_path( __FILE__ ) . 'acessos.php');
include( plugin_dir_path( __FILE__ ) . 'btn_aovivo.php');
include( plugin_dir_path( __FILE__ ) . 'countdown.php');
include( plugin_dir_path( __FILE__ ) . 'custom_functions.php');
include( plugin_dir_path( __FILE__ ) . 'form_login.php');
include( plugin_dir_path( __FILE__ ) . 'painel_admin.php');
include( plugin_dir_path( __FILE__ ) . 'restict_pages.php');
