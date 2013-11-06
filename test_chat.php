<html>
<?php

session_start();

if($_SESSION["LOGGED_IN"]==1)
{
	$id = $_SESSION["user_id"];

?>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript">
			//JQuery starts
			$(document).ready(function(){
				//Chat Bar
				$("#c_bar").click(function(){
					$("#chat").slideToggle("slow");
					setTimeout("chat_friends()",5000);
				});
				//Hide chat
				$("#c_head").click(function(){
					$("#chat").slideToggle("slow");
				});
				//Show Chat Box
				$("#f_bar").click(function(){
					$("#f_box").slideToggle("slow");
				});
				//Scroll Bar
				$("div#messages").click(function(){
					showHeight($("td#messages").height());
				});
			});


			//functions start
			function chat_friends(){
				var xmlhttp;
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						document.getElementById("chat").innerHTML=xmlhttp.responseText;
    					}
  				}
				xmlhttp.open("GET","chat_online.php",true);
				xmlhttp.send();
				
				setTimeout("chat_friends()",5000);
			}
			
			function chat_bar(id){
				var xmlhttp;
				document.getElementById("f_bar").style.display='block';
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						document.getElementById("f_bar").innerHTML=xmlhttp.responseText;
    					}
  				}
				xmlhttp.open("GET","chat_bar.php?user_id=" + id,true);
				xmlhttp.send();
				
				setTimeout("chat_bar(id)",5000);
			}
			
			function loadChat(id){	
				var xmlhttp;
				document.getElementById("f_box").style.display='block';
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.onreadystatechange=function()
  				{
  					if (xmlhttp.readyState==4 && xmlhttp.status==200)
    					{
    						document.getElementById("f_box").innerHTML=xmlhttp.responseText;
    					}
  				}
				xmlhttp.open("GET","chat_box.php?user_id=" + id,true);
				xmlhttp.send();

				setTimeout("loadChat(id)",2000);
			}

			function submitMessage(id){	
				var xmlhttp;
				if (window.XMLHttpRequest)
  				{// code for IE7+, Firefox, Chrome, Opera, Safari
  					xmlhttp=new XMLHttpRequest();
  				}
				else
  				{// code for IE6, IE5
  					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
				xmlhttp.open("GET","chat_box.php?message=" + document.getElementById("message").value + "&user_id=" + id,true);
				xmlhttp.send();

				document.getElementById("message").value = '';

				setTimeout("loadChat(id)",2000);

				return false;
			}
			
			function showHeight(h){
				if(h > 30){
					document.getElementById("div1").style.overflow="auto";
				}
			}
		</script>
		<style type="text/css">
			div.chat{
				z-index:100;
				width:200px;
				position:absolute;
				bottom:0px;
				right:30px;
			}
			div#f_bar{
				z-index:100;
				width:150px;
				display:none;
				position:absolute;
				bottom:0px;
				right:230px;
				background-color:#E8E8E8;
				font-size:12px;
				text-align:left;
				border:1px solid #A8A8A8;
				font-family:Arial, Helvetica, sans-serif;
				font-weight:600;
				cursor:pointer;
			}
			div#chat{
				display:none;
				width:200px;
				background-color:#FFFFFF;
				border:1px solid #A8A8A8;
			}
			div#c_bar{
				background-color:#E8E8E8;
				width:200px;
				font-size:12px;
				text-align:left;
				border:1px solid #A8A8A8;
				font-family:Arial, Helvetica, sans-serif;
				font-weight:600;
				cursor:pointer;
			}
			div#f_box{
				width:270px;
				z-index:101;
				background-color:#FFFFFF;
				border:1px solid #A8A8A8;
				position:absolute;
				bottom:17px;
				right:230px;
				display:none;
			}
			div.messages{
				background-color:#FFFFFF;
				text-align:left;
				font-size:11px;
				color:#000000;
			}
			table #friends{
				width:200px;
			}
			table #friend_chat{
				width:270px;
			}
			tr#settings td{
				background-color:#FFFFFF;
				font-size:10px;
				text-align:left;
				font-weight:600;
				cursor:pointer;
				width:100px;
			}
			td#c_head{
				background-color:#6495ED;
				color:#FFFFFF;
				font-weight:600;
				cursor:pointer;
			}
			td#f_head{
				background-color:#6495ED;
				font-weight:600;
				cursor:pointer;
			}
			td#f_head a:link{
				color:#FFFFFF;
				text-decoration:none;
			}
			td#f_head a:visited{
				cursor:pointer;
				color:#FFFFFF;
				text-decoration:none;
			}
			td#f_head a:hover{
				text-decoration:underline;
				cursor:pointer;
			}
			td#messages{
				overflow:auto;
				height:50px;
			}
			td#form{
				background-color:#FFFFFF;
				width:270px;
				color:#000000;
				font-size:11px;
			}
			td.link{
				background-color:#FFFFFF;
				font-size:11px;
				color:#6495ED;
				text-align:left;
				text-decoration:none;
				height:8px;
			}
			td.link:hover{
				color:#FFFFFF;
				background-color:#6495ED;
				cursor:pointer;
			}
		</style>
	</head>
	
	<body onload='setTimeout("chat_friends()",5000)'>
		<div id="f_box">
		</div>
		<div id="f_bar">
		</div>
		<div class="chat">
			<div id="chat">
			</div>
			<div id="c_bar">
				<img src="images/chat.jpg" width="15px" height="15px" /> <img src="images/online.png" width="8px" height="8px" /> Chat
			</div>
		</div>
		
	</body>

</html>

<?php
}
else
{
	echo "You must be logged in!";
}
?>