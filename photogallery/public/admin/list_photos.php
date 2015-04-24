<?php
require_once('../../includes/initialize.php');
require_once('../../includes/functions.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){

$photos = Photograph::find_all();
?>

<?php include_layout_template('admin_header.php'); ?>

<h2>List of Photos</h2>
<?php echo output_message($message); ?>
<table class="bordered">
	<tr>
		<th>Image</th>
		<th>Filename</th>
		<th>Caption</th>
		<th>Size</th>
		<th>Type</th>
		<th>Comments</th>
		<th>&nbsp;</th>
	</tr>
<?php foreach($photos as $photo):  ?>
	<tr>
		<td><img src="../<?php echo $photo->image_path();?>" width="100" /> </td>
		<td><?php echo $photo->filename; ?> </td>
		<td><?php echo $photo->caption; ?> </td>
		<td><?php echo $photo->size_as_text();?> </td>
		<td><?php echo $photo->type; ?> </td>
		<td>
			<a href="photo_comments.php?id=<?php echo $photo->id; ?>">
			<?php echo count($photo->comments()); ?>
			</a>
		</td>
		<td>
			<a href="delete_photo.php?id=<?php echo $photo->id; ?>" onclick="return confirm('Are you sure?')">
			Delete
			</a>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<br />
<a href="photo_upload.php">Upload a new photograph</a>
<br /> <br />

<a href="logout.php">Logout</a>
	</div>

<?php include_layout_template('admin_footer.php'); ?>