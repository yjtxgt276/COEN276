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

	include "dbconn.php";
	
	if(empty($_SESSION['password'])){
		header("Location:login.php");
		exit();
	}else{
		$name = $_SESSION['name'];
		echo "<a href='index.php'>".$name."</a>";
		/*check request*/
		$sql = "SECLECT id FROM friend WHERE f_name='{$name}' AND fzt='0';";
		$res = mysqli_query($conn,$sql);
		$fnum = mysqli_num_rows($res);
		if($fnum>0){
			echo "<span ><a href='request.php' style='color:#c00'>&nbsp;
			You have(".$fnum.")friend request</span>
			</a> Online <a href='logout.php'>Logout</a>";
		}else{
			echo " Online <a href='logout.php'>Logout</a>";
		}
		mysqli_free_result($res);	
	}
?>
<div id="message">
				
	<hr />
	<p><span style="font-weight:bold">Requests</span></p>
	<?php
		$sql = "SELECT id,name,f_name FROM friend 
			WHERE f_name='{$name}' AND fzt='0';";
		$res = mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)<1){
			echo "No new requests";
			exit();
		}
		while($row = mysqli_fetch_array($res)){
			echo "<p style='float:left;margin-left:30px;'>
				<span style='color:#00a;font-weight:bold;'>";
			echo $row['name']."</span> wants to friend you&nbsp;
				<a href='accept_request.php?f_name=";
			echo $row['name']."&id=".$row['id']."'>Accept</a>&nbsp;
				<a href='refuse_request.php?id=".$row['id']."'>Turn it down</a></p>";
		}
		mysqli_free_result($res);
	?>
</div>
</body>
</html>
