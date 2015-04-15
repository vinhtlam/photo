<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "public"; ?>
<?php include("../includes/layout/header.php"); ?>
<?php 	find_seleted_page(true); ?>
		
<div id ="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
		<?php echo public_navigation($current_subject, $current_page); ?>
		
	</div>
		
	<div id="page">
		<?php echo message();	?>
		<?php if ($current_page) { ?>
		<h2><?php echo htmlentities($current_page["menu_name"]); ?></h2>
		<?php echo nl2br(htmlentities($current_page["content"])); ?>
		<?php }	else { ?>
			<p>Welcome!</p>
		<?php  } ?>
		
	</div>	
</div>

<?php include("../includes/layout/footer.php"); ?>

