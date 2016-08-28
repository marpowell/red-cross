<form action = "sqltest.php" method = "post">	
	Query <br/>
	<input type = "text" name = "query"><br/></input>
	<input type = "submit" value = "Submit"> </input>
</form>

<?php
#error_reporting(E_ERROR);
if (!empty($_POST["query"])) {
$query = $_POST["query"];

$mysqli = new mysqli('127.0.0.1', 'root', 'password');

if ($mysqli->connect_error) {
	#header("Location: index.html");
    #die('Connect Error (' . $mysqli->connect_errno . ') '
    #        . $mysqli->connect_error);
	die("Login error");
	
}
session_start();
$_SESSION['db'] = $mysqli;
$result1 = $mysqli->query("USE mock_red_cross");
$result = $mysqli->query($query);
$row = $result->fetch_all();
if ($result1) {
	echo "true";
}else {
	echo "false";
}
echo "<br/>".var_dump($row);
#^^ that will tell you the permission that the user has
echo '<br/>Connection OK';

}
?>
