<html>
	<head>
		<title>Dates and Times</title>
	</head>
	<body>
	<?php
	
	//format a Unix Timestamp
	//date()
	//strftime()  <--- choose this method

	$timestamp = time();
	echo strftime("the date today is %d/%m/%y", $timestamp);
	echo "<br />";

	function strip_zeros_from_date( $marked_string = ""){
		//remove the marked zeros
		$no_zeros = str_replace('*0', '', $marked_string);
		//remove any remaining marks
		$clean_string = str_replace('*', '', $no_zeros);
		return $clean_string;
	}
	
	echo strip_zeros_from_date(strftime("The date today is *%d/*%m/%y", $timestamp));

	echo "<hr />";
	$dt = time();
	$mysql_datetime = strftime("%Y-%m-%d %H:%M:%S");
	echo $mysql_datetime;

	?>
	</body>
</html>