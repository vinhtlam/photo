<?php
require_once('../../includes/initialize.php');
require_once('../../includes/functions.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){

// }

// 1 mb = 1024 KB = 1048576 B
// 2 mb = 2048 KB = 2097152 B
// 2 mb = 2048 KB = 3145728 B
// 4 mb = 4194304 B
// 5 mb = 5242880 B
// 6 mb = 6291456 B
// 7 mb = 7340032 B
// 8 mb = 8388608 B


$max_file_size = 2097152;

$message = "";
if(isset($_POST['submit'])) {
	$photo = new Photograph();
	$photo->caption = $_POST['caption'];
	$photo->attach_file($_FILES['file_upload']);
	if($photo->save()) {
		//Success
		$message = "Photo uploaded successfully";
	} else {
		//Failure
		$message = join("<br />", $photo->errors);
	}
}

?>
<?php include_layout_template('admin_header.php');
?>



<h2>Photo Upload </h2>
<?php echo output_message($message); ?>
<form action="photo_upload.php" enctype="multipart/form-data" method="POST">

		<input type="hidden" name="MAX_FILE_SIZE" value="2000000"  />
		<p><input type="file" name="file_upload" /></p>
		<p>Caption<input type="text" name="caption" value="" /></p>
		<input type="submit" name="submit" value="Upload" />
		</form>

<?php include_layout_template('admin_footer.php'); ?>
