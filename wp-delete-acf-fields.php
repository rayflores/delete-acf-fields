<?php 
/* Plugin Name: Delete ACF fields- two
*/
//ACCOPYTWO
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
		global $wpdb;
	echo '<h3>All Posts/Meta</h3>';
		$posts = get_posts( 
			array(
				'posts_per_page' => 100,
				'post_status' => array('publish','pending','draft','auto-draft','future','private','inherit','trash','any'),
				'post_type' => array('post','revision','page','attachment','nav_menu_item','any'),
			)
		);
	// ALL POSTS WITH ACF 
	foreach ($posts as $post){
		$getPostCustom=get_post_custom($post->ID); // Get all the data 

		foreach($getPostCustom as $name=>$value) {
			$exp_name = explode('_',$name);
			// print_r($exp_name);
			 if ( (substr($name, 0, 3) === '_be') ) {
				 print_r($exp_name);
				echo "<strong>".$name."</strong>"."  =>  ";

				foreach($value as $nameAr=>$valueAr) {
					echo $valueAr.'<br/>';
						//delete_post_meta($post->ID,$name);
				}
			} 
		}
	}
	
		// ALL META BUILT FROM ACF	
		$fields = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE (meta_key LIKE '_be_%')");
		//print_r($fields);
		foreach ($fields as $key => $field){
			//delete_post_meta($field->post_id,$field->meta_key);
			echo $field->post_id . "=>";
			echo $field->meta_key;
			echo '<br/>';
			
		}
	
}