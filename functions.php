<?php
/*
import_users() function

Imports users from a CSV file with optional meta data and group.

Group import is for itthinx Groups plugin. https://wordpress.org/plugins/groups/

Add this function to your functions.php file and uncomment the function call at the bottom to have it
run if the current user is the super admin.

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
        // example csv columns: role,email,first_name,last_name,title,phone,fax,group
        $user_data = array(
          'role' => $data[0],
          'user_email' => $data[1],
          'first_name' => $data[2],
          'last_name' => $data[3],
          'user_login' => sanitize_title($data[2].$data[3]),
          'user_nicename' => $data[2].' '.$data[3]
        );
        $user_id = wp_insert_user($user_data);
        if(is_numeric($user_id)) {
          // add custom user meta
          /*
          update_user_meta($user_id, 'phone', $data[5]);
          update_user_meta($user_id, 'fax', $data[6]);
          */

          // add user to group
          /*
          $group = Groups_Group::read_by_name($data[7]);
          Groups_User_Group::create(array('user_id' => $user_id, 'group_id' => $group->group_id));
          */
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

// uncomment the below to have the script run on super admin page loads.
/*
if(is_super_admin()) {
  import_users(get_stylesheet_directory().'/users_to_import.csv');
}
*/
?>
