<?php

	header("Content-type:text/html;charset=utf-8");
	if(empty($_POST['sender'])){exit();}
	$sender = $_POST['sender'];
	$recver = $_POST['recver'];
	
	include "dbconn.php";
	$sql = "SELECT content,stime FROM message 
		WHERE sender='{$recver}' AND recver='{$sender}' AND mloop=0 ORDER BY stime ASC";
	$res = mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($res);
	/*num of new messages, json used*/
	$mNums = mysqli_num_rows($res);
	if($mNums<1){
		echo "nomessage";
		exit();
	}else if($mNums==1){
		echo "[{'content':'".$row['content']."','stime':'".substr($row['stime'],11)."'}]";
	}else{
		$result="[{'content':'".$row['content']."','stime':'".substr($row['stime'],11)."'}";
		while($row=mysqli_fetch_array($res)){
			$result.=",{'content':'".$row['content']."','stime':'".substr($row['stime'],11)."'}";
		}
		$result.=']';
		echo $result;
	}
	mysqli_free_result($res);
	 
	/*set */
	if($mNums>0){
		$sql = "UPDATE message SET mloop=1 
		WHERE sender='{$recver}' AND recver='{$sender}' AND mloop=0";
		mysqli_query($conn,$sql);
	}
	
?>

