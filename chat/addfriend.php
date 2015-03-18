<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COEN276 XIA ZHANG</title>
</head>

<body>
<p><a href="index.php">Back</a></p>
<hr />
<form action="addfriend1.php" method="get">
Friend ID：<input type="text" name="f_nickname" />
<input type="submit" value=" Add " name="sub" />
</form>
<hr />
<p>Registered users</p>
<?php

	include "include/dbconn.php";
	$sql = "SELECT nickname FROM user ORDER BY reg_time DESC limit 0,10;";
	$res = mysql_query($sql,$link);
	
	while($row = mysql_fetch_array($res)){
		echo "<li>".$row['nickname']."&nbsp;
		|&nbsp;<a href='addfriend1.php?f_nickname=".$row['nickname']."'>Add</a></li>";
	}
	mysql_free_result($res);

?>
</body>
</html>
