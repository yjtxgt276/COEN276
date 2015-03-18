<?php
	session_start();
	
	if(empty($_SESSION['password'])){
		echo "<a href='login.php'>Login</a>
			<a href='register.php' target='_blank'>Register</a>";
		exit();
	}
	header("Content-type:text/html; charset=utf-8");
	include "dbconn.php";
	include "prj_util.php";
	
	$name = $_SESSION['name'];
	$f_name = $_GET['f_name'];
	echo "$name, $f_name";
	/*check user id*/
	$sql = "SELECT id FROM user WHERE name='{$f_name}';";
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)<1){
		echo "<script type='text/javascript'> alert('User not exist'); 
			location.href='add_friend.php'; </script>";
		exit();
	}
	
	/*check friend existed in the list*/
	$sql = "SELECT name FROM friend 
		WHERE f_name='{$f_name}' AND name='{$name}';";
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res)>0){
		echo "<script type='text/javascript'> alert('This user is in your friend list'); 
			location.href='add_friend.php'; </script>";
		exit();
	}
	/*cant add self as a friend*/
	if(strcmp($f_name,$name) !== 0){
		
	}else{
		echo "<script type='text/javascript'> alert('Add somebody else beside yourself!');
		location.href='add_friend.php'; </script>";
		exit();
	}
	/*send*/
	$sql = "INSERT friend (name,f_name) VALUES ('{$name}','{$f_name}');";
	$res = mysqli_query($conn,$sql);
	if($res){
		echo "<script type='text/javascript'> alert('Request sent'); 
		location.href='add_friend.php'; </script>";
	}

?>
