<?php 	
require_once("../../includes/initialize.php");

if(!$session->is_logged_in()) {
	redirect_to("index.php");
}

$logfile = SITE_ROOT.DS.'logs'.DS.'user.log';
if(isset($_GET['clear'])){
if($_GET['clear'] == 'true'){

	file_put_contents($logfile, '');
	//add the first log entry
	log_action('Log cleared', "by User ID {$session->user_id}");
	//redirect this same page so that the url won't have clear=true 
	redirect_to('logfile.php');
}
}
?>

<?php include_layout_template("admin_header.php"); ?>
<div id ="main">
	
	<div id="page">
	<a href="index.php">&laquo; Back</a><br />		
		<br />
		<h2>Log File</h2>

		<a href="logfile.php?clear=true" onclick="return confirm('Are you sure?')">Clear log file</a>
		<?php	

			
			if(file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r')) {	//readable?
				echo "<ul class=\"log-entries\">";
				while(!feof($handle)){
					$entry = fgets($handle);
					if(trim($entry)!= "") {
					echo "<li>{$entry}</li>"; }
				}
				echo "</ul>";
				fclose($handle);
			}

			?>
	</div>	
</div>
<?php include_layout_template("admin_footer.php"); ?>

<?php if(isset($database)) { $database->close_connection(); } ?>