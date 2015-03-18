<?php
	
	header("Content-type:text/html;charset=utf-8");
	if(empty($_POST['sender'])){exit();}
	$sender = $_POST['sender'];
	$geter = $_POST['geter'];
	$content = $_POST['content'];
	include "include/dbconn.php";
	
	$sql = "INSERT INTO message (sender,geter,content,stime)
		VALUES ('{$sender}','{$geter}','{$content}',now())";
	$res = mysql_query($sql,$link);
	if(!$res){
		echo "Failed to send the message"; 
	}else{
		date_default_timezone_set("PRC");
		echo date("H:i:s");
	}
?>