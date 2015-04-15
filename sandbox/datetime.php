<html>
	<head>
		<title>Dates and Times</title>
	</head>
	<body>
	<?php
	
	echo time();
	echo "<br />";
	echo mktime(9,23,45,12,13,2014);
	echo "<br />";
	//checkdate()
	echo checkdate(12,31,2014) ? 'true' : 'false';
	echo "<br />";
	echo checkdate(2,29,2016) ? 'true' : 'false';
	echo "<br />";

	$unix_timestamp = strtotime("last Friday");
	echo $unix_timestamp . "<br />";

	//format a Unix Timestamp
	//date()
	//strftime()

	$timestamp = time();
	echo strftime("the date today is %d/%m/%y", $timestamp);
	echo "<br />";

	function strip_zeros_from_date( $marked_string = ""){
		//remove the marked zeros
		$no_zeros = str_replace('*0', '', $marked_string);
		//remove any remaining marks
		$clean_string = str_replace('*', '', $no_zeros);
	}
	
	echo strip_zeros_from_date(strftime("The date today is *%d/*%m/%y", $timestamp));


	?>
	</body>
</html>