<?php
 // error_reporting(E_ALL);
 // ini_set('display_errors', 1);

require_once('../includes/initialize.php');
include_layout_template('header.php');

echo "<hr />";


$user = User::find_by_id(1);

echo $user->first_name;
echo $user->last_name . " <br />";
echo $user->full_name();

echo "<hr />";

// $user_set = User::find_all();
// while($user = $database->fetch_array($user_set)) {
// 	echo "User: ". $user['username'] . "<br />";
// 	echo "Name: ". $user['first_name'] . " " . $user['last_name'] . "<br /><br />";
// }

$users = User::find_all();

foreach($users as $user) {
	echo "User: ". $user->username . "<br />";
	echo "Name: ". $user->full_name() . "<br /><br />";
}

// echo phpinfo();

include_layout_template('footer.php');
?>