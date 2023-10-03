<?php
   
$mysqli = new mysqli("mysql09.manitu.net", "u88061", "yTDkTZAsJVmBkuhv", "db88061");
//$mysqli = new mysqli("localhost", "root", "", "myDB");
if ($mysqli->connect_error) {
  echo "Fehler bei der Verbindung: " . mysqli_connect_error();
  exit();
}

$host = $_SERVER["HTTP_HOST"];
$uri =  rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
$extra = "anzeigen.php";

if(!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
	header("Location: http://$host$uri/$extra");
}

$id = $_GET["id"];
if($stmt = $mysqli->prepare("DELETE FROM health WHERE id=?")) {
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->close();
	$mysqli->close();
	header("Location: http://$host$uri/$extra");
}
	
?>

