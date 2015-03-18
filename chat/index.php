<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<title>COEN276 XIAZHANG</title>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
	$(function(){
		$("#flist li").hover(
			function(){ 
				$(this).css("color","blue").css("cursor","pointer");
				$(this).siblings().css("color","#000")
			},
			function(){
				$(this).css("color","#000")}).click(function(){
					window.open("message.php?geter="+$(this).attr("title"),"webchat","width=600,height=600");});
	});
</script>
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
		/*check friend requests*/
		$sql = "SELECT id FROM friend WHERE f_nickname='{$nickname}' and fzt='0';";
		$res = mysql_query($sql,$link);
		$fnum = mysql_num_rows($res);
		if($fnum>0){
			echo "<span ><a href='qingqiu.php' style='color:#c00'>&nbsp;
				You have(".$fnum.")friend requests</span></a> Online <a href='exit.php'>
				Logout</a>";
		}else{
			echo " Online <a href='exit.php'>Logout</a>";
		}
		mysql_free_result($res);	
	}
?>
<div id="message">
				
	<hr />
	<p><span style="font-weight:bold">Friend list</span>&nbsp;
		|&nbsp;<a href="addfriend.php">Add friend</a></p>
	<ul id="flist">
	<?php
		$sql = "SELECT f_nickname FROM friend WHERE nickname='{$nickname}' AND fzt='1';"; 
		$res = mysql_query($sql,$link);
		if(mysql_num_rows($res)<1){
			echo "Every body need friends <a href='addfriend.php'>Add one!</a>";
			exit();
		}
		echo "<table>";
		while($row = mysql_fetch_array($res)){
			echo "<tr>";
			$f_nickname = $row['f_nickname'];
			/*check messages*/
			$sql1 = "SELECT id FROM message 
				WHERE sender='{$f_nickname}' AND geter='{$nickname}' AND mloop=0;";
			$res1 = mysql_query($sql1,$link);
			echo "<td><li title='".$f_nickname."'>".$f_nickname;
			if(mysql_num_rows($res1)>0){
				echo "<span style='color:red'>(New messages)</span></li></td>";
				
			}else{
				echo "</li></td>";
			}
			echo "<td>&nbsp;&nbsp;
				<a href='delfriend.php?f_nickname=".$f_nickname."' 
					onclick='return del_confirm()'>Delete</a></td>";
			echo "</tr>";
		}
		mysql_free_result($res);
		echo "</table>";
	?>
	</ul>
	<hr />
</div>
</body>
</html>
