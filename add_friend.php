<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COEN276 XIA ZHANG</title>
</head>

<body>
<p><a href="index.php">Back</a></p>
<hr />
<form action="add_friend1.php" method="get">
Friend ID：<input type="text" name="f_name" />
<input type="submit" value=" Add " name="sub" />
</form>
<hr />
<p>Registered users</p>
<?php

	include "dbconn.php";
	$sql = "SELECT name FROM user ORDER BY reg_time DESC limit 0,10;";
	$res = mysqli_query($conn,$sql);
	
	while($row = mysqli_fetch_array($res)){
		echo "<li>".$row['name']."&nbsp;&nbsp;&nbsp;&nbsp
		<a href='add_friend1.php?f_name=".$row['name']."'>Send request</a></li>";
	}
	mysqli_free_result($res);

?>
</body>
</html>
