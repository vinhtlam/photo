<?php

$upload_errors = array(
    // 0 => 'There is no error, the file uploaded with success',
    // 1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    // 2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    // 3 => 'The uploaded file was only partially uploaded',
    // 4 => 'No file was uploaded',
    // 6 => 'Missing a temporary folder',
    // 7 => 'Failed to write file to disk.',
    // 8 => 'A PHP extension stopped the file upload.',

	UPLOAD_ERR_OK			=> "No errors.",
    UPLOAD_ERR_INI_SIZE		=> "Larger than upload_max_filesize.",
    UPLOAD_ERR_FORM_SIZE	=> "Larger than form MAX_FILE_SIZE.",
    UPLOAD_ERR_PARTIAL		=> "Partial upload.",
    UPLOAD_ERR_NO_FILE		=> "No file.",
    UPLOAD_ERR_NO_TMP_DIR	=> "No temporary directory",
    UPLOAD_ERR_CANT_WRITE	=> "Can't write to disk,.",
    UPLOAD_ERR_EXTENSION	=> "File upload stopped by extension."
);

if(isset($_POST['submit'])) {
	//process form
	$tmp_file = $_FILES['file_upload']['name'];

$target_path = "uploads/";

$target_path = $target_path . basename($tmp_file); 

if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_path)) {
    echo "The file ".  basename($tmp_file). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}

}

$dir =  dirname($_SERVER['PHP_SELF']);
		$dirs = explode('/', $dir);
		echo $dirs[0]; 

$error = $_FILES['file_upload']['error'];
$message = $upload_errors[$error];


echo "<pre>";
print_r($_FILES["file_upload"]);
echo "</pre>";
echo "<hr />";

?>


<html>
	<head>
		<title>Upload page</title>
	</head>
	<body>
		<?php if(!empty($message)) {echo "<p>{$message}</p>"; 
		} 
		
		?>
		<form action="upload.php" enctype="multipart/form-data" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="6000000"  />
		<input type="file" name="file_upload" />
		<input type="submit" name="submit" value="Upload" />
		</form>
	</body>
</html>