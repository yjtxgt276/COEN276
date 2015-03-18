<?php
	$DB_SERVER = "localhost";
	$DB_USER = "xia";
	$DB_PWD = "xxxsnow1985";
	$DB_NAME = "coen276prj";
	$conn = mysqli_connect($DB_SERVER,$DB_USER,$DB_PWD,$DB_NAME);

	if(!$conn){
		echo "<script type='text/javascript'> 
			alert('Sorry, db connection failed')</script>";
		die("Connection failed: ".mysqli_connect_error());
	}
	else
//		echo "<script type='text/javascript'>
	//	alert('db connection succeeded')</script>";
?>
