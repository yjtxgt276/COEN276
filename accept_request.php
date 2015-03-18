<?php
	session_start();
	
	if(empty($_SESSION['password'])){
		echo "<a href='login.php'>Login</a> 
		<a href='register.php' target='_blank'>Register</a>";
		exit();
	}
	header("Content-type:text/html; charset=utf-8");
	include "dbconn.php";
	include "prj_util.inc.php";
	
	$id = $_GET['id'];
	$f_nickname = $_GET['f_nickname'];
	/*accept*/
	$sql = "update friend set fzt=1 where id='{$id}';";
	$res = mysqli_query($conn,$sql);
	
	$nickname = $_SESSION['nickname'];
	/*cannot add yourself*/
	if($f_nickname!=$nickname){
		$sql = "INSERT INTO friend (nickname,f_nickname,fzt) 
			VALUE ('{$nickname}','{$f_nickname}','1');";
		$res = mysqli_query($conn,$sql);
	}
	if($res){
			echo "<script type='text/javascript'> alert('Success'); 
			location.href='request.php'; </script>";
			exit();
		}

?>
