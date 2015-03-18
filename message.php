<?php
	session_start();
	include "dbconn.php";
	include "prj_util.php";
	$recver= $_GET['recver'];
	$name = $_SESSION['name'];

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>COEN276 XIA ZHANG</title>
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
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
			var sender = "<?php echo $name; ?>";
			var recver = "<?php echo $recver; ?>";
			var content = $("#sendBox").val();
			var data = "content="+content+"&sender="+sender+"&recver="+recver;
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
							var content1 = "<?php echo $name.' '; ?>"+res+"\r\n";
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
			var sender = "<?php echo $name; ?>";
			var recver = "<?php echo $recver; ?>";
			var data = "sender="+sender+"&recver="+recver;
			http_request.open("post",url,true);
			http_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
			http_request.onreadystatechange = function(){
				if(http_request.readyState==4){
					if(http_request.status==200){
						if(http_request.responseText=="nomessage"){return;}
						var res = eval("("+http_request.responseText+")");
						for(var i=0;i<res.length;i++){
							var content1 = "<?php echo $recver; ?> "+res[i].stime+"\r\n";
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
	/*ajax obj*/
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
			<a href='register.php' target='_blank'>Register</a>";
		exit();
	}else{
		echo "Welcome ".$name;
	}
?>
<div id="message">
	<hr />
	<p>Chatting with <font color='red'> <?php echo $recver; ?> </font></p>
	<hr />
	<textarea readonly="readonly" id="messageBox"></textarea>
</div>
<div id="message2">
	<textarea name="content" id="sendBox"></textarea>
	<p><input type="button" value="Send" id="sendmess" /></p>
</div>
<button onclick="location.href='logout.php';">Logout</button>
</body>
</html>
