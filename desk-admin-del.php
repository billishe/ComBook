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
			<li><a href="desk-admin-tas.php">My Tasks</a></li>
			<li><a href="desk-admin-acc.php">My Account</a></li>
			<li><a href="desk-admin-for.php">Forum</a></li>
			<li><a href="desk-admin-ch.php">Chat</a></li>
			<li><a href="desk-admin-not.php">DESK</a></li>
		</ul>
		<div id="welcome">Welcome <?php if(isset($_SESSION["us"])){echo $_SESSION["us"];}?></div>
	</nav>
	<div class="main">
			<div id="Delete">
				<h1>Delete Account</h1><hr>
				<form method="POST" style="width:300px;border:0px;">
					<h2>Please input the name of the user you want to delete...</h2>
					<input type="text" name="name" placeholder="Username"><br><br><br>
					<input style="width:60%;background-color: rgba(200, 22, 54, 1)"type="submit" name="submitdelete" class="MyButns" value="ONE CLICK DELETE!">
				</form>
				<?php 
					include("controller.php");
					if (isset($_POST["submitdelete"])) {
						$name = $_POST["name"];
						$admin = new Admin("Billion","21212121", "", "", "");
						echo $admin->deleteAccount($name);
					}
				?>
			</div>
	</div>
	<section>
		<h3>Admin Privilages</h3><hr>
		<a href="desk-admin-add.php">+<span>Add New Account</span></a><br><br>
		<a href="desk-admin-del.php">-<span>Delete an Account</span></a><br><br>
		<hr><h3>Employee Privilages</h3><hr>
		<a href="desk-admin-ch.php"><img src="send.jpg"><span>CHAT</span></a><br><br>
		<a href="desk-admin-for.php"><img src="forum.png"><span>FORUM</span></a><br><br>
		<a href="desk-admin-sh.php"><img src="file.png"><span>SHARE FILE</span></a><br><br>
		<a href="desk-admin-acc.php"><img src="setting.png"><span>MY ACCOUNT</span></a><br><br>
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