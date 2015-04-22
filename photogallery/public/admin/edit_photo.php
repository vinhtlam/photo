<?php
require_once('../../includes/initialize.php');
require_once('../../includes/functions.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){
if(isset($_GET['id'])) {
	$id = $_GET['id'];	
} else { redirect_to("list_photos.php"); }


$photos = Photograph::find_by_id($id);

// }

include_layout_template('admin_header.php');
?>

<h2>Edit Photo</h2>
<?php echo output_message($message); ?>

<?php  ?>
	<img src="../<?php echo $photo->image_path();?>" width="100" /> <br />
	<input type="text"> <?php echo $photo->filename; ?> </td>
		<td><?php echo $photo->caption; ?> </td>
		<td><?php echo $photo->size_as_text();?> </td>
		<td><?php echo $photo->type; ?> </td>
		<td><a href="delete_photo.php?id=<?php echo $photo->id;?>">Delete</a><br />
		<a href="edit_photo.php?id=<?php echo $photo->id;?>">Edit</a>
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