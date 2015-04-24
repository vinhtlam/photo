<?php require_once('../../includes/initialize.php');

if(empty($_GET['id'])) {
	$session->message("No photo ID was provided.");
	redirect_to('index.php');
}

// Find all photos
$photo = Photograph::find_by_id($_GET['id']);
if(!$photo){
	$session->message("The photo could not be loaded.");
	redirect_to('index.php');
}
$comments = $photo->comments();

?>

<?php include_layout_template('admin_header.php'); ?>

<h2>Comments on <?php echo $photo->filename; ?></h2>

<?php echo output_message($message); ?>

<a href="index.php">&laquo; Back </a>

	<div style="margin-left: 20px;">
		<p><img src="../<?php echo $photo->image_path();?>" width="100" /></p>
		<p> <?php echo $photo->caption; ?> </p>
	</div>

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
			<div class="actions" style="font-size: 0.8em;">
				<a href="delete_comment.php?id=<?php echo $comment->id; ?>" >Delete Comment</a>
			</div>
			<br />
		</div>
		<?php endforeach; ?>	
	<?php if(empty($comments)) { echo "No Comments."; } ?>	
</div>



<?php include_layout_template('admin_footer.php'); ?>