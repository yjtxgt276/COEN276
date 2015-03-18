<?php
	
	header("Content-type:text/html;charset=utf-8");
	if(empty($_POST['sender'])){exit();}
	$sender = $_POST['sender'];
	$recver = $_POST['recver'];
	$content = $_POST['content'];
	include "dbconn.php";
	
	$sql = "INSERT INTO message (sender,recver,content,stime)
		VALUES ('{$sender}','{$recver}','{$content}',now())";
	$res = mysqli_query($conn,$sql);
	if(!$res){
		echo "Failed to send the message"; 
	}else{
		date_default_timezone_set("America/Los_Angeles");
		echo date("H:i:s");
	}
?>