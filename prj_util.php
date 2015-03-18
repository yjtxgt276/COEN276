<?php
/**
 * utils used by other pages
 */
	/*check form*/
	function getAndJudge($val,$str){
		if(empty($_POST[$val])){
			echo "<script type='text/javascript'> alert('".$str."'); 
				history.back();</script>";
			exit();
		}else{
			return $_POST[$val];
		}
	}
	
	/*check form*/
	function getAndJudge2($val,$str){
		if(empty($_POST[$val])){
			echo "<script type='text/javascript'> alert('".$str."'); </script>";
			exit();
		}else{
			return $_POST[$val];
		}
	}
	
	/*fetch data from db*/
	function getResFromTable($getval,$tiaojian,$val,$table){
		include "dbconn.php";
		$sql = "select $getval from $table where $tiaojian=$val;";
		$res = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($res);
		$getval = $row[$getval];
		mysqli_free_result($res);
		return $getval;
	}
	

?>
