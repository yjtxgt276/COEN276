<?php

	session_start();
	include "dbconn.php";
	header("Content-type:text/html; charset=utf-8");
	$name = $_POST['name'];
	$password = $_POST['password'];
	$password = md5($password);

	/**/
	$sql = "SELECT id FROM user 
		WHERE name='{$name}' AND password='{$password}' AND online= 0;";
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)<1){
		echo "<script type='text/javascript'>
			alert('Invalid information or you already logged in');
		history.back();</script>";
		exit();
	}else{
		$_SESSION['name'] = $name;
		$_SESSION['password'] = $password;
		$sql = "UPDATE user SET online=1 WHERE name='{$name}'";
		$res = mysqli_query($conn,$sql);
		echo "<script type='text/javascript'>
			alert();</script>";
	}
	
	header("Location:index.php");

?>