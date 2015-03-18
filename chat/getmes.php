<?php

	header("Content-type:text/html;charset=utf-8");
	if(empty($_POST['sender'])){exit();}
	$sender = $_POST['sender'];
	$geter = $_POST['geter'];
	
	include "include/dbconn.php";
	$sql = "SELECT content,stime FROM message 
		WHERE sender='{$geter}' AND geter='{$sender}' AND mloop=0 ORDER BY stime ASC";
	$res = mysql_query($sql,$link);
	$row=mysql_fetch_array($res);
	/*num of new messages, json used*/
	$mNums = mysql_num_rows($res);
	if($mNums<1){
		echo "nomessage";
		exit();
	}else if($mNums==1){
		echo "[{'content':'".$row['content']."','stime':'".substr($row['stime'],11)."'}]";
	}else{
		$result="[{'content':'".$row['content']."','stime':'".substr($row['stime'],11)."'}";
		while($row=mysql_fetch_array($res)){
			$result.=",{'content':'".$row['content']."','stime':'".substr($row['stime'],11)."'}";
		}
		$result.=']';
		echo $result;
	}
	mysql_free_result($res);
	 
	/*set */
	if($mNums>0){
		$sql = "UPDATE message SET mloop=1 
		WHERE sender='{$geter}' AND geter='{$sender}' AND mloop=0";
		mysql_query($sql,$link);
	}
	
?>

