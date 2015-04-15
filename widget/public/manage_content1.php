<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>


<?php include("../includes/layout/header.php"); ?>
		
<div id ="main">
	<div id="navigation">
		<ul class="subjects">
		<?php 
			//2. perform database query-------------------
			$query = "SELECT * ";
			$query .= "FROM subjects ";
			$query .= "WHERE visible = 1 ";
			$query .= "ORDER BY position ASC";
			
			$subject_set = mysqli_query($connection,$query);
			confirm_query($subject_set);
		 ?>
		<?php
			//3. Use return data-------------------
			while($subjects = mysqli_fetch_assoc($subject_set)){
				//output data from each row
		?>
			<li>
				<?php echo $subjects["menu_name"]; ?>

				<?php
						$query = "SELECT * ";
						$query .= "FROM pages ";
						$query .= "WHERE visible = 1 ";
						$query .= "AND subject_id = {$subjects["id"]} ";
						$query .= "ORDER BY position ASC";
						
						$page_set = mysqli_query($connection,$query);
						confirm_query($page_set);
				?>

				<ul class="pages">
					<?php
						while($page = mysqli_fetch_assoc($page_set)){
					?>		
					<li>	<?php echo $page["menu_name"]; ?> </li>
					<?php
							}
					?>
					
					<?php
						mysqli_free_result($page_set);
					?>

				</ul>
			</li>

		<?php
			}
		?>

		<?php
			//4. release returned data-------------------
			mysqli_free_result($subject_set);
		?>

		</ul>
	</div>
		
	<div id="page">
		<h2>Manage Content</h2>
		<p> Welcome to the manage content area.</p>
		<ul>
			<li><a href="manage_content.php">Manage Website Content</a></li>
			<li><a href="manage_admins.php">Manage Admin Users</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</div>	
</div>


<?php include("../includes/layout/footer.php"); ?>
