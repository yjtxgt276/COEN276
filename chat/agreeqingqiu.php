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
	
	$id = $_GET['id'];
	$f_nickname = $_GET['f_nickname'];
	/*accept*/
	$sql = "update friend set fzt=1 where id='{$id}';";
	$res = mysql_query($sql,$link);
	
	$nickname = $_SESSION['nickname'];
	/*cannot add yourself*/
	if($f_nickname!=$nickname){
		$sql = "insert into friend (nickname,f_nickname,fzt) value ('{$nickname}','{$f_nickname}','1');";
		$res = mysql_query($sql,$link);
	}
	if($res){
			echo "<script type='text/javascript'> alert('Success'); 
			location.href='qingqiu.php'; </script>";
			exit();
		}

?>
