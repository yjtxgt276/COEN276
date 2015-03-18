<?php

	
	include "dbconn.php";
	include "prj_util.php";
	header("Content-type:text/html;charset=utf-8");
	/*get the data and validate*/
	$name = getAndJudge('name','Empty ID');
	$password = getAndJudge('password','Empty password');
	$password2 = getAndJudge2('password2','Empty confirm password');
	if($password==$password2){
		$password = md5($password);
	}else{
		echo "<script type='text/javascript'> alert('Different passwords'); 
		history.back();</script>";
	}
	
	$sql = "select * from user where name='".$name."';";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($res);
	
	if ($row >= 1){
		echo "<script type='text/javascript'> alert('ID already registered'); 
		history.back();</script>";
	}
	
	$sql = "INSERT INTO 
		user (name,password,reg_time,online) 
		VALUES ('{$name}','{$password}',now(),0);";
	
	//echo $sql;
	$res = mysqli_query($conn,$sql);
	if($res){
		echo "Registered successfully<p>
			<a href='index.php' target='_blank'>Login</a></p>";
	}else{
		echo "<script type='text/javascript'> alert('Sorry, register failed');
		history.back(); </script>";
	}
?>
