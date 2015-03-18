<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COEN276 XIA ZHANG</title>
</head>

<body>

<form action="regist1.php" method="post">
<table id="table1">
	<tr>
		<td class="td1">ID</td>
		<td><input type="text"  name="nickname" /> *</td>
	</tr>

	<tr>
		<td class="td1">Password</td>
		<td><input type="password" name="password" /> *</td>
	</tr>

	<tr>
		<td class="td1">Confirm password</td>
		<td><input type="password" name="password2" /> *</td>
	</tr>
	<tr>
		<td class="td1">Sex</td>
		<td><input type="radio" value='M' name="sex" checked="checked" />Male 
		<input type="radio" value='F' name="sex" />Female</td>
	</tr>
	<tr>
		<td class="td1">Date of birth</td>
		<td>
		<select name="yyyy">
		<?php
			for($i=2012;$i>1912;$i--){
				echo "<option value='{$i}'>$i</option>";
			}
		?>
		</select>Year 
		<select name="mm">
		<?php
			for($i=1;$i<=12;$i++){
				echo "<option value='{$i}'>$i</option>";
			}
		?>
		</select>Month 
		<select name="dd">
		<?php
			for($i=1;$i<=31;$i++){
				echo "<option value='{$i}'>$i</option>";
			}
		?>
		</select>Date
		</td>
	</tr>
	<tr>
		<td class="td1">Address</td>
		<td><input type="text" name="address" /></td>
	</tr>
	<tr>
		<td class="td1">Hint</td>
		<td><input type="text" name="question" /></td>
	</tr>
	<tr>
		<td class="td1">Answer</td>
		<td><input type="text" name="answer" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value=" Register " id="submit" /></td>
	</tr> 
</table>
</form>

</body>
</html>
