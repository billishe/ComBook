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
	<meta http-equiv="refresh" content="40">
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
			<br><br><br>			
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
							$chat = new chat('billion', $chatto);
							$chat->get();
							$chat->message($message);
						}
					?>
				</table>
			</div>
			<div name="forum" id="forum">
			<br><br><br>			
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
			</div>
			<div name="share" id="share">
			<br><br><br>
			<h1>Share File</h1><hr>
					<input type="file" name=""/>
				<?php
					echo "z";
				?>
			</div>
			<div id="Add">
			<br><br><br>
			<h1>Add Account</h1><hr>
			<form method="POST" style="width:100%;border:0px;">
				<input type="text" name="name" placeholder="Username">
				<input type="password" name="password" placeholder="Password">
				<input type="text" name="position" placeholder="position">
				<input type="text" name="type" placeholder="Type: Manager/Employee">
				<input type="text" name="mgrName" placeholder="Manager Name">
				<input type="submit" name="submitadd" class="MyButns" value="Add">
				</form>
				<?php 
					if (isset($_POST["submitadd"])) {
						$name = $_POST["name"];
						$pass = $_POST["password"];
						$position = $_POST["position"];
						$type = $_POST["type"];
						$mgrName = $_POST["mgrName"];
						$admin = new Admin("Billion","21212121", "", "", "");
						echo $admin->addAccount($name,$pass, $position, $type, $mgrName);
					}
				?>
			</div>
			<div id="Delete">
			<h1>Delete Account</h1><hr>
			<form method="POST" style="width:300px;border:0px;">
			<h2>Please input the name of the user you want to delete...</h2>
				<input type="text" name="name" placeholder="Username"><br><br><br>
				<input style="width:60%;background-color: rgba(200, 22, 54, 1)"type="submit" name="submitdelete" class="MyButns" value="ONE CLICK DELETE!">
				</form>
				<?php 
					if (isset($_POST["submitdelete"])) {
						$name = $_POST["name"];
						$admin = new Admin("Billion","21212121", "", "", "");
						echo $admin->deleteAccount($name);
					}
				?>
			</div>
			<div name="myacc" id="myacc">
			<h1>My Account</h1><hr>
				<?php
					echo "m";
				?>
			</div>

		</div>
	</div>
	<section>
		<h3>Admin Privilages</h3><hr>
		<a href="#Add">+<span>Add New Account</span></a><br><br>
		<a href="#Delete">-<span>Delete an Account</span></a><br><br>
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