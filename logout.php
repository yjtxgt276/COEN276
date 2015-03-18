<?php

	session_start();
	include "dbconn.php";

	$sql = "UPDATE user SET online=0 
			WHERE name ='{$_SESSION['name']}'";
	mysqli_query($conn,$sql);
	session_unset(); 
// 	destroy the session 
	session_destroy(); 
	header("Location:index.php");	
?>
