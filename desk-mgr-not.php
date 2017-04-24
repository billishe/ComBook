<?php
	session_start();
		include("controller.php");
		$a = new Employee($_SESSION["us"], "", "", "", "");
		$a->attend();
	if(!(isset($_SESSION["us"]))){
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<!--No BOOTSTRAP IS USED FOR THIS COMBOOK PROJECT EVERY THING HERE IS THE PRODUCT OF: HTML,CSS,JAVASCRIPT,and,PHP-->
<head>
	<title>ComBook-<?php echo $_SESSION["us"]?></title>
	<meta http-equiv="refresh" content="25"/>
	<meta http-equiv="refresh" content="7200" url="signout.php"/>
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
			<li><a href="desk-mgr-tas.php">My Tasks</a></li>
			<li><a href="desk-mgr-acc.php">My Account</a></li>
			<li><a href="desk-mgr-for.php">Forum</a></li>
			<li><a href="desk-mgr-ch.php">Chat</a></li>
			<li><a href="desk-mgr-not.php">DESK</a></li>
		</ul>
		<div id="welcome">Welcome <?php if(isset($_SESSION["us"])){echo $_SESSION["us"];}?></div>
	</nav>
	<div class="main">
		<div name="notif" id="notif">
			<br>		
			<h1>Notification</h1><hr>
			<?php 
				
				$n = new Notification();
				$n->get();

			?>
		</div>	
	</div>
	<section>
		<h3>Manager Privilages</h3><hr>
		<a href="desk-mgr-task.php"><span>Assign Task</span></a><br><br>
		<a href="desk-mgr-notif.php"><span>Notify public</span></a><br><br>
		<hr><h3>Employee Privilages</h3><hr>
		<a href="desk-mgr-ch.php"><img src="send.jpg"><span>CHAT</span></a><br><br>
		<a href="desk-mgr-for.php"><img src="forum.png"><span>FORUM</span></a><br><br>
		<a href="desk-mgr-sh.php"><img src="file.png"><span>SHARE FILE</span></a><br><br>
		<a href="desk-mgr-acc.php"><img src="setting.png"><span>MY ACCOUNT</span></a><br><br>
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