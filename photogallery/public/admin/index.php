<?php
require_once('../../includes/initialize.php');
require_once('../../includes/functions.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){

// }

include_layout_template('admin_header.php');
echo $session->message;
?>

<h2>Menu</h2>
<ul>
	<li><a href="list_photos.php">Index of photos</a></li>
	<br />
	<li><a href="logfile.php">View Log File</a></li>
	<br />

	<li><a href="logout.php">Logout</a></li>
	</div>

<?php include_layout_template('admin_footer.php'); ?>
