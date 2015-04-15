<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layout/header.php"); ?>

<?php
	//selecting pages from the navigation
	if(isset($_GET["subject"])) {
		$seleted_subject_id = $_GET["subject"];
		$seleted_page_id = null;
	} elseif (isset($_GET["page"])) {
			$seleted_page_id = $_GET["page"];
			$seleted_subject_id = null;
	} else {
		$seleted_subject_id = null;
		$seleted_page_id = null;
	}

?>
		
<div id ="main">
	<div id="navigation">
		<?php echo navigation($seleted_subject_id, $seleted_page_id); ?>
	</div>
		
	<div id="page">
		<h2>Manage Content</h2>
		<?php if ($seleted_subject_id) { ?>

			<?php $current_subject = find_subject_by_id($seleted_subject_id); ?> <br />
			Menu name: <?php echo $current_subject["menu_name"]; ?>
		<?php }	elseif ($seleted_page_id) { ?>

			<?php $current_page = find_page_by_id($seleted_page_id); ?> <br />
			Menu name: <?php echo $current_page["menu_name"]; ?>
		<?php }	else { ?>
		Please selete a subject or a page.
		<?php  } ?>
		<p> Welcome to the manage content area.</p>
		<ul>
			<li><a href="manage_content.php">Manage Website Content</a></li>
			<li><a href="manage_admins.php">Manage Admin Users</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>	
</div>


<?php include("../includes/layout/footer.php"); ?>
