<head>
		<meta charset = "UTF-8">
		<title>red cross test</title>
		<!--link rel = "stylesheet" href = "style.css"> </style!-->
		<link href='https://fonts.googleapis.com/css?family=Montserrat:700|Droid+Sans' rel='stylesheet' type='text/css'>
		<script src = "js/script.js"> </script>
</head>
<div id = "header"><h1 >Login</h1></div>
<div id = "popup"> 
	<div id = 'popup_content'>
	<form action = "login.php" method = "post">
		Register<br/>
		Name: <br/>
		<input type = "text" name = "name"><br/></input>
		Username: <br/>
		<input type = "text" name = "user"><br/></input>
		Password: <br/>
		<input type = "password" name = "pass"><br/></input>
		Home Delegation: 
		<select name = "home"> 
			<option value = "" selected />
			<option value = "d.f." >D.F.</option>
			<option value = "1"> 1 </option>
			<option value = "2"> 2 </option>
			<option value = "3"> 3 </option>
		</select><br/>
			
		<input type = "submit" value = "Register"> </input>
		
		<input type = "hidden" name = "register" value = "1" />
		<div id = 'close' onclick = 'closePopup()'>
		</div>
	</div> 
</div>
<div id = "content" >
<div id = "content_text" align = "center">
<br/>
<form align = "center" action = "login.php" method = "post">
	
	Username: <br/>
	<input type = "text" name = "user"><br/></input>
	Password: <br/>
	<input type = "password" name = "pass"><br/><br/></input>
	<input type = "submit" value = "Login"> </input>
	<input type = "hidden" name = "register" value = "0" />
	<input type = "button" id = "register" value = "Register" onclick = 'openPopup()'> </input>
</form>
<br /><br />

<?php
error_reporting(E_ERROR);
if (!empty($_POST["user"]) && !empty($_POST["pass"])) {
$db_name = "mock_red_cross";
$user = $_POST["user"];
$pass = $_POST["pass"];
if ($_POST["register"] == 1) {
	
	if(empty($_POST["name"]) || empty($_POST["home"])) {
		die("Registration Error: Please fill in all required information.");
	}
	$user = "root";
	$pass = "password";
}
	

$mysqli = new mysqli('127.0.0.1', $user, $pass);

if ($mysqli->connect_error) {
	#header("Location: index.html");
    #die('Connect Error (' . $mysqli->connect_errno . ') '
    #        . $mysqli->connect_error);
	die("Login error");
	
}
if ($_POST["register"] == 1) {
	
	$mysqli->query("USE ".$db_name);
	$query = "SELECT rank FROM users WHERE username = '".$_POST["user"]."'";
	$result = $mysqli->query($query);

	if ($result->fetch_assoc() != null) {
		die("Error: User ".$_POST["user"]." already exists");
	} else {
		$mysqli->query("INSERT INTO users VALUES ('".$_POST["user"]."', '".$_POST["name"]."', '".$_POST["home"]."', -1, '')");
		$mysqli->query("CREATE USER '".$_POST["user"]."' IDENTIFIED BY '".$_POST["pass"]."' ACCOUNT LOCK");
		$mysqli->query("INSERT INTO requests VALUES('".$_POST["user"]."', 'register', '".$_POST["home"]."')");
		die("Registered Sucessfully. Please wait for your account to be authorized.");
	}
	
	
	
}
session_start();
$_SESSION['db'] = $mysqli;
$query = "SELECT rank FROM users WHERE username = '".$user."'";	
$result1 = $mysqli->query("USE ".$db_name);
$result = $mysqli->query($query);
if (!$result) {
	die("Query error:".empty($result1).$query);
}
$row = $result->fetch_assoc();
$_SESSION['permission'] = $row['rank'];
if ($row['rank'] == -1) {
	die("Authorization error: Please wait for your account to be verified.");
}
#^^ that will tell you the permission that the user has
echo 'Connection OK';
header("Location: home.php");
}
die("Please enter a username and password");
?>