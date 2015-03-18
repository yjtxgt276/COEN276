<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<title>COEN276 XIA ZHANG</title>
</head>

<body>
<?php

	include "include/dbconn.php";
	
	if(empty($_SESSION['password'])){
		header("Location:login.php");
		exit();
	}else{
		$nickname = $_SESSION['nickname'];
		echo "<a href='index.php'>".$nickname."</a>";
		/*check request*/
		$sql = "SECLECT id FROM friend WHERE f_nickname='{$nickname}' AND fzt='0';";
		$res = mysql_query($sql,$link);
		$fnum = mysql_num_rows($res);
		if($fnum>0){
			echo "<span ><a href='qingqiu.php' style='color:#c00'>&nbsp;
			You have(".$fnum.")friend request</span>
			</a> Online <a href='exit.php'>Logout</a>";
		}else{
			echo " Online <a href='exit.php'>Logout</a>";
		}
		mysql_free_result($res);	
	}
?>
<div id="message">
				
	<hr />
	<p><span style="font-weight:bold">Requests</span></p>
	<?php
		$sql = "SELECT id,nickname,f_nickname FROM friend 
			WHERE f_nickname='{$nickname}' AND fzt='0';";
		$res = mysql_query($sql,$link);
		if(mysql_num_rows($res)<1){
			echo "No new requests";
			exit();
		}
		while($row = mysql_fetch_array($res)){
			echo "<p style='float:left;margin-left:30px;'>
				<span style='color:#00a;font-weight:bold;'>";
			echo $row['nickname']."</span> wants to friend you&nbsp;
				<a href='agreeqingqiu.php?f_nickname=";
			echo $row['nickname']."&id=".$row['id']."'>Accept</a>&nbsp;
				<a href='refuseqingqiu.php?id=".$row['id']."'>Turn it down</a></p>";
		}
		mysql_free_result($res);
	?>
</div>
</body>
</html>
