<!DOCTYPE html>
<html>
<!--No BOOTSTRAP IS USED FOR THIS COMBOOK PROJECT EVERY THING HERE IS THE PRODUCT OF: HTML,CSS,JAVASCRIPT,and,PHP-->
<head>
	<title>ComBook</title>
	<link rel="shortcut icon" type="image/x-icon" href="logo.png">

	<link rel="stylesheet" type="text/css" href="style.css">
	  <link rel="stylesheet" type="text/css" href="popup.css">

</head>
<body onload="myFunction()">
 <div id="loader">
<center>
	<h1>ComBook</h1>
</center>
</div>
 <div id="open"  style="display:none;" class="animate">
	<!--Navigation bar -->
	<nav class="navig">
		<a href="index.php"><img src="logo.png">ComBook</a>
		<ul class="tabs">
			<li><a href="#">HELP</a></li>
			<li><a href="about.html">ABOUT</a></li>
			<li><a href="#forgot">Forgot My Password</a></li>
			<li><a href="#login">LOGIN</a></li>
		</ul>
	</nav>
	<!--image slider-->	
	<div class="gallery">
	<br><br><br><br>
	<div class="popup" onclick="myFunction2()">Welcome
		<span class="popuptext" id="myPopup">ComBook v1.0 Your workplace handler!</span>
	</div>
	<br><br>
	<a href="#login">PROCEED TO LOGIN &gt;&gt;</a>
	</div>
	<div class="login">
		<table>
		<div id="tips">
			<br>
			<center  id="login"><h1>Welcome Back...</h1>
			</center><hr width="50%">
			<tr>
			<td>
			<div class="alert">
  			<span class="closebtn" onclick="this.parentElement.style.display='none';">close&times;</span>
			<h3>Today's Tip</h3>
			<p>Please reduce using your phone while at work, 
			Studies suggest that using phone while at work 
			reduces productivity. Less calls means more
			productivity <br>And of course: more bonus:)</p>
			</div>
			</td><td>
		</div>
		<form method="POST" action=" ">
			<div class="formContent">
			<h1>LOGIN</h1><hr>
			<p>Press the 'forgot my password' button to report to admin if you forgot it. cheers!</p>
			<input type="text" name="uname" placeholder="User name"><br><br>
			<input type="password" name="pwd" placeholder="Password"><br><br>
			<input type="submit" class="MyButns" name="submit" value="Login"><br><br>
			<div class="error">
				<?php 
				if(isset($_POST["submit"])){
					include("controller.php");
					$un = $_POST["uname"];
					$pwd = $_POST["pwd"];
					$emp = new Employee($un, $pwd, "", "", "");
					$emp->signIn();
				}
				?>
			</div>
			<a name="fmp" href="#forgot" class="onGrey">Forgot My password</a>

		</form>
		</td>
		</tr>
		</table>
	</div>
	<div class="forgot" id="forgot">
		<center>
	<h1>Report Missing Password</h1><hr>
		<p><b>Note:</b>You can report a lost password here and take it from the system admin in person on working hours monday-friday for security reasons</p>
		<form id="form2">
			<h2>Forgot My Password</h2><hr>
			<p>Please enter username for your forgotten password...</p>
			<input type="text" name="unf" placeholder="username">
			<input type="button" name="forgot" class="MyButns" value="Report">
		</form>
		</center>
	</div>
	<footer>
		<div>
			<p>&copy; 2016 All rights reserved.</p>
		</div>
		<div>
			<a href="name.html">DESIGNERS</a></p>

		</div>
	</footer>
</div>
<script>
var myVar;
function myFunction() {
	document.body.style.backgroundColor = "lightblue";
    myVar = setTimeout(showPage, 3000);
}
function showPage() {

  document.getElementById("loader").style.display = "none";
  document.getElementById("open").style.display = "block";
}
function myFunction2() {
    var popup = document.getElementById('myPopup');
    popup.classList.toggle('show');
}
</script>
</body>

</html>