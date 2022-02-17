<?php

//------------------------------------------------------------------
//------------------- CAMPO BLOQUEADOR DE PÁGINAS ------------------
//------------------------------------------------------------------

function wporg_add_custom_box()
{
	$screens = ['page'];
	foreach ($screens as $screen) {
		add_meta_box(
			'wporg_box_id',                 // Unique ID
			'Global bloqueio de páginas',      // Box title
			'wporg_custom_box_html',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($post)
{
	$value = get_post_meta($post->ID, 'global_block', true);
?>

	<br>
	<input id="global_block" type="checkbox" name="global_block" value="1" <?php if ($value == '1') echo 'checked="checked"'; ?> /> Bloquear Página?

<?php
}

function wporg_save_postdata($post_id)
{
	// If the checkbox was not empty, save it as array in post meta
	if (!empty($_POST['global_block'])) {
		update_post_meta($post_id, 'global_block', $_POST['global_block']);

		// Otherwise just delete it if its blank value.
	} else {
		delete_post_meta($post_id, 'global_block');
	}

}
add_action('save_post', 'wporg_save_postdata');

//------------------------------------------------------------------
//----------------- EXECUTA O BLOQUEIO DAS PÁGINAS -----------------
//------------------------------------------------------------------

add_action('wp', 'wpse69369_special_thingy');
function wpse69369_special_thingy()
{
	if ('page' === get_post_type() && is_singular()) {

		$post_id = get_the_ID();
		$global_block = get_post_meta($post_id, 'global_block', true);
		$url = get_option('bloqueio_global');
		$user = wp_get_current_user();

		$user_id = get_current_user_id();
		$users = new WP_User($user_id);

		if ($global_block == '1' && !is_user_logged_in() && !isset($_COOKIE['cpf'])) {
			wp_redirect($url);
			exit();		
		}
	}
}
