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
	<meta http-equiv="refresh" content="30">
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
			<li><a href="#myacc">My Account</a></li>
			<li><a href="#forum">Forum</a></li>
			<li><a href="#chat">Chat</a></li>
			<li><a href="#notif">DESK</a></li>
		</ul>
		<div id="welcome">Welcome <?php if(isset($_SESSION["us"])){echo $_SESSION["us"];}?></div>
	</nav>
	<div class="main">
		<div id="notification">		
			<div name="notif" id="notif">
			<br>
			<h1>Notification</h1><hr>
			<?php 
				include("controller.php");
				$n = new Notification();
				$n->get();

			?>
			</div>
			<div id="task">
			<br>			
			<h1>Tasks</h1><hr>
			<?php

				$task = new Task($_SESSION["us"]);
				$task->get();
			?>
			</div>
			<div name="chat" id="chat">
				<br><br><br>			
				<h1>Chat</h1><hr>
				<table>
				<tr>
				</tr>
				<form style="min-width:1000px;" id="chatform" method="POST">
				<input type="text" name="mychat" id="response" placeholder="enter message here...">
				<input type="text" name="chatto" id="chatto" placeholder="sendto">
				<input id="b" type="submit" name="submitchat" value="send" class="MyButns">
				</form>
				<?php
					
					if (isset($_POST["submitchat"])) {
						$message = $_POST["mychat"];
						$chatto = $_POST["chatto"];
						$chat = new chat($_SESSION["us"], $chatto);
						$chat->message($message);
						print ($chat->get());
					}
				?>
				</table>
			</div>
			<div name="forum" id="forum">
				<br>
				<h1>Forum</h1><hr>
				<form style="min-width:1000px;" id="chatform" method="POST">
				<input type="text" name="for" id="response" placeholder="enter message here...">
				<input id="b" type="submit" name="submitchatchatf" value="send" class="MyButns">
				</form>
				<?php
					$x = new Forum();
					$x->get();
					if (isset($_POST["submitchatf"])) {

					$message = $_POST["for"];
					$x->chat($_SESSION["us"], $message);
				}
				?>
			</div>
			<div name="myacc" id="myacc">
			<br>
			<h1>My Account</h1><hr>
				<?php
					echo "m";
				?>
			</div>
			<div name="task" id="task">
			<br>
			<h1>Assign Task</h1><hr>
				<form method="POST" style="width:100%;border:0px;">
					<input type="text" name="emp" placeholder="Employee username">
					<input type="text" name="task" placeholder="task">
					<input type="submit" name="submittask" class="MyButns" value="Add">
				</form>
				<?php
					if (isset($_POST["submittask"])) {
						$emp = $_POST["emp"];
						$task = $_POST["task"];
						$mgr = new Manager($_SESSION["us"], "12345678", "", "", "");
						echo $mgr->assign($emp,$task);
					}
				?>
			</div>
			<div name="notify" id="notify">
			<br>
			<h1>Notify Public</h1><hr>
				<form method="POST" style="width:100%;border:0px;">
					<textarea name="not" placeholder="Enter notification here..."></textarea>
					<input type="submit" name="submitnot" class="MyButns" value="Add">
				</form>
				<?php
					if (isset($_POST["submitnot"])) {
						$not = $_POST["not"];
						$mgr = new Manager($_SESSION["us"], "12345678", "", "", "");
						echo $mgr->notify($not);
					}
				?>
			</div>
		</div>
	</div>
	<section>
		<h3>Manager Privilages</h3><hr>
		<a href="#task"><span>Assign Task</span></a><br><br>
		<a href="#notify"><span>Notify public</span></a><br><br>
		<hr><h3>Employee Privilages</h3><hr>
		<a href="#chat"><img src="send.jpg"><span>CHAT</span></a><br><br>
		<a href="#forum"><img src="forum.png"><span>FORUM</span></a><br><br>
		<a href="#share"><img src="file.png"><span>SHARE FILE</span></a><br><br>
		<a href="#myacc"><img src="setting.png"><span>MY ACCOUNT</span></a><br><br>
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