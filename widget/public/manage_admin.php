<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php 	confirm_logged_in(); ?>

<?php $admin_set = find_all_admins(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layout/header.php"); ?>

<div id ="main">
	<div id="navigation">
		&nbsp;<br />
		<a href="admin.php">&laquo; Main menu</a><br />
	</div>
	<div id="page">
		<?php echo message();	?>
		<h2>Manage Admins</h2>
			<table>
				<tr>
					<th style="text-align: left; width: 200px;">Userename</th>
					<th colspan="2" style="text-align: left;">Actions</th>
				</tr>
					<?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
					<tr>
						<td><?php echo htmlentities($admin["username"]); ?>
						</td>
					 		<?php $safe_admin_id = urlencode($admin["id"]); ?>
						<td><a href="edit_admin.php?userid=<?php echo "{$safe_admin_id}"; ?>" onclick="return confirm('Are you sure?')">Edit</a></td>
						<td><a href="delete_admin.php?userid=<?php echo "{$safe_admin_id}"; ?>" onclick="return confirm('Are you sure?')" >Delete</a></td>
						
					</tr>
					<?php } ?>
			</table>
				<br />
				<a href="new_admin.php">+ Add a new admin user</a>
	</div>	
</div>

<?php include("../includes/layout/footer.php"); ?>

