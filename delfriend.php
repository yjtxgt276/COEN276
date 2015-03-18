<?php
	session_start();
	if(empty($_SESSION['password'])){
		header("Location:login.php");
		exit();
	}
	header("Content-type:text/html; charset=utf-8");
	include "dbconn.php";
	$f_name = $_GET['f_name'];
	$sql = "delete from friend where name='".$_SESSION['name']."' and f_name='{$f_name}'";
	if(mysqli_query($conn,$sql)){
		echo "<script type='text/javascript'> alert('Successful'); 
		location.href='index.php'; </script>";	}
	

?>