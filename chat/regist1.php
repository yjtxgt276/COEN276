<?php

	
	include "include/dbconn.php";
	include "include/common.inc.php";
	header("Content-type:text/html;charset=utf-8");
	/*get the data and validate*/
	$nickname = getAndJudge('nickname','Empty ID');
	$password = getAndJudge('password','Empty password');
	$password2 = getAndJudge2('password2','Empty confirm password');
	if($password==$password2){
		$password = md5($password);
	}else{
		echo "<script type='text/javascript'> alert('Different passwords'); 
		history.back();</script>";
	}
	$sex = $_POST['sex'];
	
	$yyyy = $_POST['yyyy'];
	$mm = $_POST['mm'];
	$dd = $_POST['dd'];
	$birthday = $yyyy."-".$mm."-".$dd;
	$address = $_POST['address'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	
	$age = intval(date("Y"))-intval($yyyy);
	
	$sql = "select * from user where nickname='".$nickname."';";
	$res = mysql_query($sql,$link);
	$row = mysql_num_rows($res);
	
	if ($row == 1){
		echo "<script type='text/javascript'> alert('ID already registered'); 
		history.back();</script>";
	}
	
	$sql = "INSERT INTO 
		user (nickname,password,address,sex,age,birthday,reg_time,question,answer) 
		values ('{$nickname}','{$password}','{$address}','{$sex}','{$age}','{$birthday}',
			now(),'{$question}','{$answer}');";
	
	//echo $sql;
	$res = mysql_query($sql,$link);
	if($res){
		echo "Registered successfully<p>
			<a href='index.php' target='_blank'>Login</a></p>";
	}else{
		echo "<script type='text/javascript'> alert('Sorry, register failed');
		history.back(); </script>";
	}
?>
