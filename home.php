<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="Stylesheet" href="CSS/style.css">
<title>Health Tracking</title>
<style>
.container {
	display: flex;
	justify-content: space-between;
}
.termin {
	background-color: LightGreen;	
}
.wichtig {
	background-color: Tomato;	
}
.lernen {
	background-color: Gold;
}
</style>
</head>
<body>

	<nav>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="Health_Tracking_M/anzeigen.php">Mona</a></li>
			<li><a href="Health_Tracking_G/anzeigen.php">Geeti</a></li>
			<li><a href="Health_Tracking_S/anzeigen.php">Sama</a></li>
			<li><a href="Health_Tracking_MA/anzeigen.php">Masud</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav><br>
	
	<?php
	$mysqli = new mysqli("mysql09.manitu.net", "u88061", "yTDkTZAsJVmBkuhv", "db88061");
	//$mysqli = new mysqli("localhost", "root", "", "myDB");
	if ($mysqli->connect_error) {
	  echo "Fehler bei der Verbindung: " . mysqli_connect_error();
	  exit();
	}
		
	if($ergebnis = $mysqli->prepare("SELECT id, task, description, priority, category FROM tasks ORDER BY priority")) {
		$ergebnis->execute();
		$ergebnis->bind_result($id, $task, $description, $priority, $category);
		
		echo "<div class='container'>";
		echo "<div class='item'><ul>\n";
		while($ergebnis->fetch()) {
			echo "<li class='$category'><strong>"	
				. "($priority) "
				. $task
				. "</strong>: "
				. $description
				. "| <a href='Tasks/bearbeiten.php?id="
				. (int)$id
				. "'>bearbeiten</a> "
				. "| <a href='Tasks/loeschen.php?id="
				. (int)$id
				. "'>löschen</a>"
				. "</li>";
		}
		echo "</ul>\n";	
		
		$ergebnis->close();
	}
	
	$mysqli->close();	
	?>
	
	<p><a href="Tasks/neu.php">Aufgabe hinzufügen</a></p>
	</div>
	
	<div class="item">Sama</div>
	<div class="item">Geeti</div>
	<div class="item">Mona</div>
	<div class="item">K..</div>
		
</body>
</html>

<?php
} else {
	$host = $_SERVER["HTTP_HOST"];
	$uri = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	$extra = "index.php";
	header("Location: http://$host$uri/$extra");
}
?>