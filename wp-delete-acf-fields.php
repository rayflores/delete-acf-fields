<?php 
/* Plugin Name: Delete ACF fields
*/

add_action( 'admin_menu', 'delete_acf_menu' );

function delete_acf_menu() {
	add_options_page( 
		'Delete ACF',
		'Delete ACF',
		'manage_options',
		'delete-acf-fields',
		'delete_acf_fields_hook'
	);
}

function delete_acf_fields_hook(){ 
echo '<h3>All Posts/Meta</h3>';
$posts = get_posts(
			array(
				'post_type' => array('page','post'),
				'posts_per_page' => -1,
				'post_status'	 => 'any',
			)
		);

	foreach ($posts as $post){
		$getPostCustom=get_post_custom($post->ID); // Get all the data 

		foreach($getPostCustom as $name=>$value) {
			$exp_name = explode('_',$name);
			if ( ($exp_name[0] === 'be') || ($exp_name[1] === 'be' ) ){
				foreach($value as $nameAr=>$valueAr) {
						delete_post_meta($post->ID,$name);
				}
			} 
		}
	}
}