<?php
 
// loading wp core 
include_once '../../../../wp-load.php';
global $wpdb;


$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$date = date("Y-m-d");

$secret="6LfhJvwiAAAAAJkcxPdnnZKS7QE0FHsQ5IuAkkib"; 
$response=$_POST["captcha"];
$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
$captcha_success=json_decode($verify);


if ($captcha_success->success==false) {
	echo "robot";
}
else if ($captcha_success->success==true) {
	//REGISTER
    $user_id = wp_create_user( $username, $password, $email );
    wp_update_user(array('ID'=>$user_id, 'role'=>'korisnik'));
}



?>