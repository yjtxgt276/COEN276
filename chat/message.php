<?php
	session_start();
	include "include/dbconn.php";
	include "include/common.inc.php";
	$geter= $_GET['geter'];
	$nickname = $_SESSION['nickname'];

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<title>COEN276 XIA ZHANG</title>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	
	/*gloabal var*/
	var http_request;
	$(function(){
		$("#sendmess").click(sendMessage);
	});
	/**/
	function sendMessage(){
		var http_request = createAjaxObject();
		if(http_request){
			var url = "sendmes.php";
			var sender = "<?php echo $nickname; ?>";
			var geter = "<?php echo $geter; ?>";
			var content = $("#sendBox").val();
			var data = "content="+content+"&sender="+sender+"&geter="+geter;
			http_request.open("post",url,true);
			http_request.setRequestHeader("content-type",
					"application/x-www-form-urlencoded");
			http_request.onreadystatechange = function(){
				if(http_request.readyState==4){
					/*success*/
					if(http_request.status==200){
						var res = http_request.responseText;
						if(res!=""){
						/*on success*/
							var content1 = "<?php echo $nickname.' '; ?>"+res+"\r\n";
							var content2 = content+"\r\n" ;
							var contents = $("#messageBox").val()+content1+content2;
							$("#messageBox").val(contents);
							$("#sendBox").val(""); 
						}
					}
				}
			}
			http_request.send(data);
		}
	}
	setInterval(getMessage,1000);
	function getMessage(){
		var http_request = createAjaxObject();
		if(http_request){
			var url = "getmes.php";
			var sender = "<?php echo $nickname; ?>";
			var geter = "<?php echo $geter; ?>";
			var data = "sender="+sender+"&geter="+geter;
			http_request.open("post",url,true);
			http_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
			http_request.onreadystatechange = function(){
				if(http_request.readyState==4){
					if(http_request.status==200){
						if(http_request.responseText=="nomessage"){return;}
						var res = eval("("+http_request.responseText+")");
						for(var i=0;i<res.length;i++){
							var content1 = "<?php echo $geter; ?> "+res[i].stime+"\r\n";
							var content2 = res[i].content+"\r\n" ;
							var contents = $("#messageBox").val()+content1+content2;
							$("#messageBox").val(contents);
						}
					}
				}
			}
			http_request.send(data);
		}
	}
	/*create ajax obj*/
	function createAjaxObject(){
		if(window.ActiveXObject){
			var newRequest = new ActiveXObject("Microsoft.XMLHTTP");
		}else{
			var newRequest = new XMLHttpRequest();
		}
		return newRequest;
	}
</script>
</head>

<body>
<?php

	if(empty($_SESSION['password'])){
		echo "<a href='login.php'>Login</a> 
			<a href='regist.php' target='_blank'>Register</a>";
		exit();
	}else{
		echo $nickname. " Online <a href='exit.php'>Logout</a>";
	}
?>
<div id="message">
	<hr />
	<p>Chatting with <font color='red'> <?php echo $geter; ?> </font></p>
	<hr />
	<textarea readonly="readonly" id="messageBox"></textarea>
</div>
<div id="message2">
	<textarea name="content" id="sendBox"></textarea>
	<p><input type="button" value="Send" id="sendmess" /></p>
</div>
</body>
</html>
