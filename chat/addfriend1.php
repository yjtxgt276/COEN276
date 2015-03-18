<?php
	session_start();
	
	if(empty($_SESSION['password'])){
		echo "<a href='login.php'>Login</a>
			<a href='regist.php' target='_blank'>Register</a>";
		exit();
	}
	header("Content-type:text/html; charset=utf-8");
	include "include/dbconn.php";
	include "include/common.inc.php";
	
	$nickname = $_SESSION['nickname'];
	$f_nickname = $_GET['f_nickname'];
	
	/*check user id*/
	$sql = "select id from user where nickname='{$f_nickname}';";
	$res = mysql_query($sql,$link);
	if(mysql_num_rows($res)<1){
		echo "<script type='text/javascript'> alert('User not exist'); 
			location.href='addfriend.php'; </script>";
		exit();
	}
	
	/*check friend*/
	$sql = "select nickname from friend where f_nickname='{$f_nickname}' and nickname='{$nickname}';";
	$res = mysql_query($sql,$link);
	if(mysql_num_rows($res)>0){
		echo "<script type='text/javascript'> alert('This user is in your friend list'); 
			location.href='addfriend.php'; </script>";
		exit();
	}
	
	$sql = "insert friend (nickname,f_nickname) values ('{$nickname}','{$f_nickname}');";
	$res = mysql_query($sql,$link);
	if($res){
		echo "<script type='text/javascript'> alert('Request sent'); location.href='addfriend.php'; </script>";
	}

?>
