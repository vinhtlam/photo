<?php
require_once('../../includes/initialize.php');
require_once('../../includes/functions.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){

$photos = Photograph::find_all();

// }

include_layout_template('admin_header.php');
echo $session->message;
?>

<h2>List of Photos</h2>
<table class="bordered">
	<tr>
		<th>Image</th>
		<th>Filename</th>
		<th>Caption</th>
		<th>Size</th>
		<th>Type</th>
	</tr>
<?php foreach($photos as $photo):  ?>
	<tr>
		<td><img src="../<?php echo $photo->image_path();?>" width="100" /> </td>
		<td><?php echo $photo->filename; ?> </td>
		<td><?php echo $photo->caption; ?> </td>
		<td><?php echo $photo->size_as_text();?> </td>
		<td><?php echo $photo->type; ?> </td>
	</tr>

<?php endforeach; ?>
</table>
<br />
<a href="photo_upload.php">Upload a new photograph</a>

<a href="logout.php">Logout</a>
	</div>

<?php include_layout_template('admin_footer.php'); ?>