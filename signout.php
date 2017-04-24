<?php
	session_start();
	unset($_SESSION["us"]);
	session_destroy();
	header("location: index.php");
?>