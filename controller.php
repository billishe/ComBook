<?php
/*
* 
*/

class Employee{
	var $username;
	var $password;
	var $position;
	var $mgrName;
	var $type;
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
 	var $db = "combookdb";
 	var $conn;
	function __construct($username,$password,$position,$mgrName,$type)
	{
		$this->username = $username;
		$this->position = $position;
		$this->mgrName = $mgrName;
		$this->password = $password;
		$this->type = $type;
	}
	
	function signIn(){
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword, $this->db);
		if (!$conn) {
				echo "not connected to database";
		} else {
			$sql = "SELECT password FROM users WHERE username ='".$this->username."'";
			$result = mysqli_query($conn, $sql);
			$undb;
			if (!$result) {
						echo "not found";
			} else {
				while($a = mysqli_fetch_assoc($result)){
					$undb = $a["password"];
				}
				if ($undb == $this->password){
					session_start();
					$_SESSION['us'] = $this->username;
					$undb = $this->username;
					$sql = "SELECT type FROM users WHERE username ='".$undb."'";
					$result2 = mysqli_query($conn, $sql);
					while($a = mysqli_fetch_assoc($result2)){
						$type = "".$a["type"];
					}
					if($undb == "Billion"){
						header("location: desk-admin-not.php");	
					}else{
						header("location: desk-".$type."-not.php");	
					}

				} else {
					echo "Account Not Found! please try again...";
				}
			}					
		}
	}
	function attend(){
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword, $this->db);
		if (!$conn) {
				echo "not connected to database";
		} else {
			$t = time() % 86400;
			$ts = $t % 60;
			$tm = floor($t / 60);
			$tmr = $tm % 60;
			$th = floor($tm / 60);
			$thr = $th - 1;
			$time = $th." : ".$tmr." : ".$ts;
			$sql = "INSERT INTO `users` (`attended`) VALUES ('".$time."') WHERE `username` ='".$this->username."'";
			mysqli_query($conn, $sql);					
		}	
	}

	function setPassword($name, $newPass){
		if ($this->username == $name) {
			$this->password = $newPass;
			return true;
		}
		return false;
	}
	function setName($name, $pass){
		if ($this->password == $pass) {
			$this->username = $name;
			return true;
		}
		return false;
	}
	function chat($nameto,$message){
		$newChat = new Chat($this->name,$nameto);
		$newChat->message($message);
	}
}
// $x = new Employee("Edidiya","12345678","","","");
// $x->signIn();

/**
* 
*/
class Admin extends Employee
{
	var $name;
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
 	var $db;
	function __construct($username,$position,$mgrName,$password,$type)
	{
		# code...
		$this->name = $username;
	}
	function addAccount($name,$pass, $position, $type, $mgrName){
		$val = new Validate();

		if(empty($name)) {
				return "username can't be empty!";
		}else if(empty($pass)){
				return "username can't be empty!";
		}else if(empty($position)){
				return "username can't be empty!";
		}else if(empty($type)){
				return "username can't be empty!";
		}else if(empty($mgrName)){
				return "username can't be empty!";
		}else if($val->checkUname($name)){
				return "username already taken... please try another!";
		} else{
			$new = new Employee($name,$pass,$position,$mgrName,$type);
			$conn = mysqli_connect($this->servername, $this->uname, $this->pword);
			$sql = "CREATE Database `".$new->username."`";
			$this->db = $new->username;
			$sql2 = "CREATE TABLE `".$this->db."`.`chat` ( `name` VARCHAR(20) NOT NULL , `chat` VARCHAR(10000000) NOT NULL);";
			$sql3 = "CREATE TABLE `".$this->db."`.`tasks` ( `task` VARCHAR(10000000) NOT NULL);";
			$sql4 = "CREATE TABLE `".$this->db."`.`file` ( `name` VARCHAR(20) NOT NULL , `directory` VARCHAR(100) NOT NULL);";
			$db = "combookdb";
			$sql5 = " INSERT INTO `users` (`username`,`password`, `type`,`position`,`mgrName`) VALUES ('".$new->username."','".$new->password."','".$new->type."','".$new->position."','".$new->mgrName."')";

			if (!$conn) {
				return "Cannot connect to Database!";
			} else {
				mysqli_query($conn,  $sql);
				$conn = mysqli_connect($this->servername, $this->uname, $this->pword, $this->db);
				mysqli_query($conn,  $sql2);		
				mysqli_query($conn,  $sql3);
				mysqli_query($conn,  $sql4);
				$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$db);
				mysqli_query($conn,  $sql5);
				return "Account Successfully Added to Database!";
			}
		}
	}
	function deleteAccount($name){
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword);
		$sql = "DROP DATABASE ".$name;
		$db = "combookdb";
		mysqli_query($conn,  $sql);
		$sql = "Delete * From `users` where `username`=`".$name."`";
		mysqli_query($conn,  $sql);
		return "Account Successfully DELETED from Database!";
	}
}
/**
*
*
*/
class Manager extends Employee
{
	var $name;
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
 	var $db;
	function __construct($username,$position,$mgrName,$password,$type)
	{
		# code...
		$this->name = $username;
//		parent::__construct($username,$position,$mgrName,$password,$type);

	}
	function assign($employee,$task){
		$this->db = $employee;
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "INSERT INTO `tasks` (`task`) VALUES ('".$task."')";
		if($conn){
			mysqli_query($conn,$sql);
			return "The task is successfully assigned to ".$employee."!";
		}
	}
	function notify($notification){
		$new = new Notification();
		$new->add($this->name,$notification);
		return "Your notification is successfully sent to public!";
	}
}

/**
* 
*/

class Forum
{
	var $forumLog = array();
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
 	var $db;
	function __construct()
	{
		

	}
	function chat($name,$message){
		$this->db = "combookdb";
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "INSERT INTO `forum` (`Name`,`Chat`) VALUES ('".$name."','".$message."')";
		if ($conn) {
			mysqli_query($conn,$sql);
			return true;
		}
	}
	function get(){
		$this->db = "combookdb";
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "SELECT * FROM `forum`";
		if($conn){
			$result = mysqli_query($conn,$sql);
			$i = 0;
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
					$forumLog[$i][0] = $row[0];
					$forumLog[$i][1] = $row[1];
					echo ">".$forumLog[$i][0]."-".$forumLog[$i][1]."<br>";
					$i++;
			}
		}
		}
}

// $x = new Forum();
// $x->get();
/**
* 
*/
class Notification
{
	var $notification;
	var $name;
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
 	var $db;
	function __construct()
	{
		# code...
	}
	function add($name,$notification){
		$this->db = "combookdb";
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "INSERT INTO `notification` (`title`,`notification`) VALUES ('".$name."','".$notification."')";
		if ($conn) {
			mysqli_query($conn,$sql);
			return true;
		}
	}
	function get(){
		$this->db = "combookdb";
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "SELECT * FROM `notification`";
		if($conn){
			$result = mysqli_query($conn,$sql);
			$i = 0;
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
					$notification[0] = $row[0];
					$notification[1] = $row[1];
					print "From Mr.". $notification[0]. " : ".$notification[1]."<br><hr>";
					$i++;
			}
		}
	}
}
/**
* 
*/	
class Task
{
	var $description;
	var $employeeName;
	var $managerName;
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
	function __construct($employeeName)
	{
		$this->employeeName = $employeeName;
	
	}
	function get(){
		$db = $this->employeeName;
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$db);
		$sql = "SELECT * FROM `tasks`";
		if($conn){
			$result = mysqli_query($conn,$sql);
			$i = 0;
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
					$this->description = $row[0];
					echo "<br>"."&gt;".$this->description;
			}
		}
	}
}
/**
* 
*/
class File
{
	var $name;
	var $sharedWith;
	var $directory;
	function __construct($name,$directory)
	{
		$this->name = $name;
		$this->directory = $directory;
		$this->db = "combookdb";
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "INSERT INTO `file` (`name`,`directory`) VALUES ('".$name."','".$directory."')";
		if ($conn) {
			mysqli_query($conn,$sql);
			return true;
		}
	}
	function share($employee){
		$this->db = "combookdb";
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$this->db);
		$sql = "INSERT INTO `file` (`sharedwith`) VALUES ('".$employee."')";
		if ($conn) {
			mysqli_query($conn,$sql);
			return true;
		}			
	}
}
/**
* 
*/
class chat
{
	var $name1;
	var $name2;
	var $chatLog1;
	var $chatLog2;
	var $servername = "localhost";
 	var $uname = "root";
 	var $pword = "";
	function __construct($from,$to)
	{
		# code...
		$this->name1 = $from;
		$this->name2 = $to;

	}
	function message($message){
		$db = $this->name2;
		$db2 = $this->name1;
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$db);
		$conn2 = mysqli_connect($this->servername, $this->uname, $this->pword,$db2);
		$sql = "INSERT INTO `chat` (`name`,`chat`) VALUES ('".$this->name1."','".$message."')";
		if ($conn) {
			mysqli_query($conn,$sql);
			mysqli_query($conn2,$sql);
			
		}	

	}
	function get(){
		$db = $this->name1;
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$db);
		$sql = "SELECT * FROM `chat`";
			$result = mysqli_query($conn,$sql);
			if($result){
				while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
					$this->chatlog1 = $row[0];
					$this->chatlog2 = $row[1];
					print "&gt;".$this->chatlog1." : ";
					print $this->chatlog2."<br>";
				}
			}
		}
	function delete(){
		$db = $this->name1;
		$conn = mysqli_connect($this->servername, $this->uname, $this->pword,$db);
		$sql = "DELETE FROM `chat`";
		$result = mysqli_query($conn,$sql);
	}
}

// $x = new chat("Billion","Biruk");
// $x->get();

/**
* 
*/

class Validate
{
	
	function __construct()
	{
		# code...

	}
	function ListEmployees($opt){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "combookdb";
		$conn = mysqli_connect($servername, $username, $password, $db);
					if (!$conn) {
						echo "not connected to database";
					} else {
						$sql = "SELECT * FROM users";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
									$i =1;
									while($a = mysqli_fetch_assoc($result)){
										$undb = $a["username"];
										$_POST['opt'.$i] = $undb;
										$i++;
									}
						}
					}
				}
	function checkUname($uname){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "combookdb";
		$conn = mysqli_connect($servername, $username, $password, $db);
		$sql = "SELECT * FROM users WHERE username = '".$uname."'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
		else { return false;}

	}
}
?>