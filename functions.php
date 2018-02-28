<?php
/*
Add this function to your functions.php file to have it run on a page load.

Be sure to uncomment then recomment the function call as it will slow the site down while running
and throw errors once the users have been imported.
*/

function import_users($file_path) {
	$h = fopen($file_path,'r');
	if($h) {
		$line = 0;
		while(($data = fgetcsv($h, 1000, ',')) !== false) {
			$user_data = null;
			$user_id = null;
			$num = count($data);
			if($line > 0) { // skip first line headings
				// example csv columns: first_name, last_name, email, title, phone, fax, role, group
				$user_data = array(
					'user_login' => sanitize_title($data[0].$data[1]),
					'user_nicename' => $data[0].' '.$data[1],
					'first_name' => $data[0],
					'last_name' => $data[1],
					'user_email' => $data[2],
					'role' => $data[6]
				);
				$user_id = wp_insert_user($user_data);
				if(is_numeric($user_id)) {
          // use the below to insert the custom meta for the new user.
					//update_user_meta($user_id, 'phone', $data[4]);
					//update_user_meta($user_id, 'fax', $data[5]);
					
          // Use the below to add the user to the group in the group col, by group name.
          //$group = Groups_Group::read_by_name($data[7]);
					//Groups_User_Group::create(array('user_id' => $user_id, 'group_id' => $group->group_id));
				} else {
					echo 'failed to create the user on csv row '.$line+1;
					var_dump($user_id);
				}
			}
			$line++;
		}
		fclose($h);
	} else {
		echo 'error opening file';
	}
}
// uncomment the below to have the script run on page load.
// import_users(get_stylesheet_directory().'/users_to_import.csv');
?>
