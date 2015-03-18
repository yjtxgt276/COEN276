<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<title>COEN276 XIAZHANG</title>
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="common.js"></script>
<script type="text/javascript">
	$(function(){
		$("#flist li").hover(
			function(){ 
				$(this).css("color","blue").css("cursor","pointer");
				$(this).siblings().css("color","#000")
			},
			function(){
				$(this).css("color","#000")
			}).click(function(){
					window.open("message.php?recver="+$(this).attr("title"),
							"COEN276 XIA ZHANG","width=600,height=600");});
	});
</script>
</head>

<body>
<?php

	include "dbconn.php";
	
	if(empty($_SESSION['password'])){
		header("Location:login.php");
		exit();
	}else{
		$name = $_SESSION['name'];
		echo "Welcome <a href='index.php'>".$name."</a>";
		/*check friend requests*/
		$sql = "SELECT id FROM friend WHERE f_name='{$name}' and fzt='0';";
		$res = mysqli_query($conn,$sql);
		$fnum = mysqli_num_rows($res);
		if($fnum>0){
			echo "<span ><a href='request.php' style='color:#c00'>&nbsp;
				You have(".$fnum.")friend requests</span></a><a href='logout.php'>
				Logout</a>";
		}else{
			echo "  <a href='logout.php'>Logout</a>";
		}
		mysqli_free_result($res);	
	}
?>
<div id="message">
				
	<hr />
	<p>Click on friends name and start chatting!</p>
	<ul id="flist">
	<?php
		$sql = "SELECT f_name FROM friend WHERE name='{$name}' AND fzt='1';"; 
		$res = mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)<1){
			echo "Every body need friends <a href='add_friend.php'>Add one!</a>";
			exit();
		}
		echo "<table>";
		while($row = mysqli_fetch_array($res)){
			echo "<tr>";
			$f_name = $row['f_name'];
			/*check messages*/
			$sql1 = "SELECT id FROM message 
				WHERE sender='{$f_name}' AND recver='{$name}' AND mloop=0;";
			$res1 = mysql_query($sql1,$conn);
			echo "<td><li title='".$f_name."'>".$f_name;
			if(mysqli_num_rows($res1)>0){
				echo "<span style='color:red'>(New messages)</span></li></td>";
				
			}else{
				echo "</li></td>";
			}
			echo "<td>&nbsp;&nbsp;
				<a href='delfriend.php?f_name=".$f_name."' 
					onclick='return del_confirm()'>Delete</a></td>";
			echo "</tr>";
		}
		mysqli_free_result($res);
		echo "</table>";
	?>
	</ul>
	
	<hr />
	<button onclick="location.href='add_friend.php';">Add a friend</button>
</div>
</body>
</html>
