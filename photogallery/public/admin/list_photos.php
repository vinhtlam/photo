<?php
require_once('../../includes/initialize.php');
require_once('../../includes/functions.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){

//1. the current page number ($number_page)
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//2. records per page ($per_page)
$per_page = 2;

//3. total record count ($total_count)
$total_count = Photograph::count_all();

$pagination = new Pagination($page, $per_page, $total_count);

// Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$sql = "SELECT * FROM photographs";
$sql .= " LIMIT {$per_page}" ;
$sql .= " OFFSET {$pagination->offset()}";

$photos = Photograph::find_by_sql($sql);

//need to add ?page=$page to all links we want to
//maintain the current page (or store $page in $session)


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

<div id="pagination" style="clear: both;">
<?php 

	if ($pagination->total_pages() > 1) {

		if($pagination->has_previous_page()) {
			echo " <a href=\"list_photos.php?page="; 
			echo $pagination->previous_page();
			echo "\">&laquo; Previous</a> ";
		}

		for ($i =1; $i <= $pagination->total_pages(); $i++) {
			if($i == $page) {
				echo " <span class=\"seleted\">{$i}</span> ";
			} else {
				echo " <a href=\"list_photos.php?page={$i}\">{$i}</a> "; 
			}	
		} 

		if($pagination->has_next_page()) {
			echo " <a href=\"list_photos.php?page="; 
			echo $pagination->next_page();
			echo "\">&raquo; Next</a> ";
		}
	}

?>
</div>


<br />
<a href="photo_upload.php">Upload a new photograph</a>
<br /> <br />

<a href="logout.php">Logout</a>


<?php include_layout_template('admin_footer.php'); ?>