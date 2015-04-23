<?php
require_once('../../includes/initialize.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){
if(isset($_GET['id'])) {
	$id = $_GET['id'];	
} else { redirect_to("list_photos.php"); }

$photo = Photograph::find_by_id($id);
?>

<?php include_layout_template('admin_header.php'); ?>

<h2>Edit Photo</h2>
<a href="list_photos.php">&laquo; Back </a>


<?php echo output_message($message); ?>

<div style="margin-left: 20px;">
	<img src="../<?php echo $photo->image_path(); ?>" />
	<p> <?php echo $photo->caption; ?> </p>
	
</div>

<?php
	if(empty($_GET['id'])) {
		$session->message("No photo ID was provided.");
		redirect_to('list_photos.php');
	}

	// Find all photos
	$photo = Photograph::find_by_id($_GET['id']);
	if(!$photo){
		$session->message("The photo could not be loaded.");
		redirect_to('list_photos.php');
	}

	$comments = $photo->comments();
?>

<table class="bordered">
	<tr>
		<td><input type="text" value="<?php echo $photo->filename; ?>"></td>
		<td><input type="text" value="<?php echo $photo->caption; ?>"></td>
		<td><?php echo $photo->size_as_text();?> </td>
		<td><?php echo $photo->type; ?> </td>
		<br />
		<td>
		<a href="edit_photo.php?id=<?php echo $photo->id;?>">Edit photo info</a>
		</td>
	</tr>
</table>
<br />

<!-- list comments -->

<div id="comments">
	
	<?php foreach($comments as $comment): ?>
		<div class="comment" style="margin-bottom: 2em;">
			<div class="author">
				<?php echo htmlentities($comment->author); ?> wrote:
			</div>
			<div class="body">
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
			<div class="meta-info" style="font-size: 0.8em;">
				<?php echo datetime_to_text($comment->created); ?>
			</div>
			
			<a href="delete_comment.php?id=<?php echo $comment->id; ?> ">Delete comment</a>
		</div>
	<?php endforeach; ?>	
	<?php if(empty($comments)) { echo "No Comments."; } ?>	
</div>		



<?php include_layout_template('admin_footer.php'); ?>