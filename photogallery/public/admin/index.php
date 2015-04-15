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

<a href="logfile.php">View Log File</a>
<br />

<a href="logout.php">Logout</a>
	</div>

<?php include_layout_template('admin_footer.php'); ?>
