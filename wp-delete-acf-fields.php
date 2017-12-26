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
				'posts_per_page' => -1,
				'post_status'	 => 'publish',
			)
		);

	foreach ($posts as $post){
		$getPostCustom=get_post_custom($post->ID); // Get all the data 
		delete_post_meta($post->ID,'be_disable_leaving_page');
		delete_post_meta($post->ID,'_'.'be_disable_leaving_page');
		delete_post_meta($post->ID,'be_hidden');
		delete_post_meta($post->ID,'_'.'be_hidden');
		delete_post_meta($post->ID,'be_testimonial');
		delete_post_meta($post->ID,'_'.'be_testimonial');
		delete_post_meta($post->ID,'be_testimonials');
		delete_post_meta($post->ID,'_'.'be_testimonials');
		delete_post_meta($post->ID,'be_cta_title');
		delete_post_meta($post->ID,'_'.'be_cta_title');
		delete_post_meta($post->ID,'be_cta_icon');
		delete_post_meta($post->ID,'_'.'be_cta_icon');
		delete_post_meta($post->ID,'be_cta_content');
		delete_post_meta($post->ID,'_'.'be_cta_content');		
		delete_post_meta($post->ID,'be_cta_button_text');
		delete_post_meta($post->ID,'_'.'be_cta_button_text');		
		delete_post_meta($post->ID,'be_cta_button_link');
		delete_post_meta($post->ID,'_'.'be_cta_button_link');

		foreach($getPostCustom as $name=>$value) {
			$exp_name = explode('_',$name);
			if ( substr($name, 1, 3) === 'be_' ){
				echo "<strong>".$name."</strong>"."  =>  ";

				foreach($value as $nameAr=>$valueAr) {
						echo $nameAr."  =>  ".$valueAr;
						echo "<button>delete?</button><br />";
				}
			} 
		}
	}
}