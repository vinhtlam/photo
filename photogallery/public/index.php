<?php require_once('../includes/initialize.php');

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

?>
<?php include_layout_template('header.php'); ?>
<?php foreach($photos as $photo):	?>
	<div style="float: left; margin-left: 20px;">
	<a href="photo.php?id=<?php echo $photo->id; ?>">
	<img src="<?php echo $photo->image_path(); ?>" height="150" />
	<p> <?php echo $photo->caption; ?> </p>
	</div>
<?php endforeach; ?>

<?php include_layout_template('footer.php'); ?>