<?php
	session_start();
	if(!(isset($_SESSION["us"]))){

		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<!--No BOOTSTRAP IS USED FOR THIS COMBOOK PROJECT EVERY THING HERE IS THE PRODUCT OF: HTML,CSS,JAVASCRIPT,and,PHP-->
<head>
	<title>ComBook-<?php echo $_SESSION["us"]?></title>
	<meta http-equiv="refresh" content="25">
	<link rel="shortcut icon" type="image/x-icon" href="logo.png">

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="desk-style.css">
</head>
<body>
	<!--Navigation bar -->
	<nav class="navig">
		<a href="index.php"><img src="logo.png">ComBook</a>
		<ul class="tabs">
			<li><a href="#">HELP</a></li>
			<li><a href="signout.php">Sign out</a></li>
			<li><a href="desk-e-tas.php">My Tasks</a></li>
			<li><a href="desk-e-acc.php">My Account</a></li>
			<li><a href="desk-e-for.php">Forum</a></li>
			<li><a href="desk-e-ch.php">Chat</a></li>
			<li><a href="desk-e-not.php">DESK</a></li>
		</ul>
		<div id="welcome">Welcome <?php if(isset($_SESSION["us"])){echo $_SESSION["us"];}?></div>
	</nav>
	<div class="main">
		<div name="chat" id="chat">
			<br>		
			<h1>Chat</h1><hr>
				<p class="info">please press "Clear Chat Log" after you finish chatting to destroy chat logs</p>
			<form style="min-width:1000px;" id="chatform" method="POST">
			<input type="text" name="mychat" id="response" placeholder="enter message here...">
			<input type="text" name="chatto" id="chatto" placeholder="sendto">
			<input id="b" type="submit" name="submitchat" value="send" class="MyButns">
					<input id="endch2" type="submit" value="Clear Chat Log" name="echat"/>
			</form>
			<?php
				include("controller.php");
				$c = new chat($_SESSION["us"],"");
					$c->get();
				if(isset($_POST["submitchat"])) {
					$message = $_POST["mychat"];
					$chatto = $_POST["chatto"];
					$chat = new chat($_SESSION["us"], $chatto);
					$chat->get();
					$chat->message($message);
				}
				if (isset($_POST["echat"])) {
					$c->delete();
				}
			?>
				
		</div>	
	</div>
	<section>
		<br><br><br><br><br><br><br><br>
		<a href="desk-e-ch.php"><img src="send.jpg"><span>CHAT</span></a><br><br>
		<a href="desk-e-for.php"><img src="forum.png"><span>FORUM</span></a><br><br>
		<a href="desk-e-sh.php"><img src="file.png"><span>SHARE FILE</span></a><br><br>
		<a href="desk-e-acc.php"><img src="setting.png"><span>MY ACCOUNT</span></a><br><br><br><br>
		.
	</section>
	<footer>
		<div>
			<p>&copy; 2016 All rights reserved.</p>
		</div>
		<div>
			<a href="#">DESIGNERS</a></p>
		</div>
	</footer>
</body>
</html>