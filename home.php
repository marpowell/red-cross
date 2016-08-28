<head>
		<meta charset = "UTF-8">
		<title>red cross test</title>
		<link rel = "stylesheet" href = "style.css"> </style>
		<link href='https://fonts.googleapis.com/css?family=Montserrat:700|Droid+Sans' rel='stylesheet' type='text/css'>
		<script src = "js/script.js"> </script>
</head>
<div id = "header">
<?php
session_start();
if (empty($_GET["page"]) or $_GET["page"] == "home") {
	echo "<h1 id = 'head_section'>HOME ";
	$_GET["page"] = "home";

} else {
	echo "<h1 id = 'head_section'><a href = \"home.php?page=home\">HOME</a> ";
}
if (!empty($_GET["page"]) and $_GET["page"] == "proj") {
	echo "CREATE PROJECT ";
} elseif ($_SESSION["permission"] >= 2) {
	echo "<a href = \"home.php?page=proj\">CREATE PROJECT</a> ";
}
if (!empty($_GET["page"]) and $_GET["page"] == "view") {
	echo "VIEW REQUESTS ";
} elseif ($_SESSION["permission"] >= 2) {
	echo "<a href = \"home.php?page=view\">VIEW REQUESTS</a> ";
}
if (!empty($_GET["page"]) and $_GET["page"] == "user") {
	echo "CREATE USER<br/></h1>";
} else {
	echo "<a href = \"home.php?page=user\">CREATE USER</a><br/></h1>";
}

?>
</div>
<div id = "content"> <div id = "content_text"> 
<?php

$mysqli = $_SESSION['db'];
if ($_GET["page"] == "home") {
?>
<a href = "">Project1 - Description1</a><br /> 
<a href = "">Project2 - Description2</a> <br />
<a href = ""> Project3 - Description3</a> 
<?php	
} elseif ($_GET["page"] == "proj") {
?>

<form action = "home.php" method = "post">
Project Name:
<input type = "text" name = "proj_name" />
<input type = "hidden" name = "type" value = "project" />
<input type = "submit" />
</form>
<?php	
} elseif ($_GET["page"] == "view") {
	$mysqli->query("SELECT * from requests"); #make a better query to do this
	
} elseif ($_GET["page"] == "user") {
	
}
?>
</div> </div>