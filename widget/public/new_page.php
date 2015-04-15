<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 	confirm_logged_in(); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php 	find_seleted_page(false); ?>

<?php 
	
	if(!$current_subject) {
		//echo $current_subject;
		redirect_to("manage_content.php");
	}
?>

<?php
	if(isset($_POST['submit'])){
		//valications
		$required_fields = array("menu_name", "position", "visible", "content");
		validate_presences($required_fields);

		$fields_with_max_lengths = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if(empty($errors)) {
			//process the form
			$subject_id = $current_subject["id"];
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];
			$content = mysql_prep($_POST["content"]);

			$query = "INSERT INTO pages (";
			$query .= " subject_id, menu_name, position, visible, content ";
			$query .= ") VALUES (";
			$query .= " {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
			$query .= ")";
			
			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection)==1){
				// echo "Success!<br />";
				$_SESSION["message"] = "Page successful created.";
				redirect_to("manage_content.php?subject=" . urlencode($current_subject["id"]) ) ;
			} else {
				//failure
				$message = "Page creation failed." ;
			}
		}
	} else {
		//This is probably a GET request
	}	// end of if(isset($_POST['submit']) 

?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layout/header.php"); ?>
<div id ="main">
	<div id="navigation">
		<?php echo navigation($current_subject, $current_page); ?>
	</div>
	<div id="page">
	<?php //$message is just a variable, does't use the SESSION
			if(!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
		?>
		<?php 	echo form_errors($errors); ?>
		<h2>Create Page</h2>
		<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
			<p>For subject:	<?php echo $current_subject["menu_name"]; ?>
			</p>
			<p>Menu name:
				<input type="text" name="menu_name" value="" />
			</p>
			<p>Position:
				<select name="position">
				<?php 
					$page_set = find_pages_for_subject($current_subject["id"],false);
					$page_count = mysqli_num_rows($page_set);
					for($count=1; $count <= $page_count +1; $count++) {
						echo "<option value=\"{$count}\">{$count}</option>";
					}
				?>
				</select>
			</p>
			<p>Visible:
				<input type="radio" name="visible" value="0" /> No &nbsp;
				<input type="radio" name="visible" value="1" /> Yes
			</p>
			<p>Content:<br />
				<textarea name="content" rows="20" cols="80"></textarea>
			</p>
			<input type="submit" name="submit" value="Create Page" />
		</form>
		<br />
		<a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]);?>">Cancel</a>
	</div>	
</div>
<?php include("../includes/layout/footer.php"); ?>
