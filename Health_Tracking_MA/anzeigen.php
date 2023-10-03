<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="Stylesheet" href="../CSS/style.css">
<title>Health Tracking</title>
<style>
</style>
</head>
<body>	

	<nav>
		<ul>
			<li><a href="../home.php">Home</a></li>
			<li><a href="../Health_Tracking_M/anzeigen.php">Mona</a></li>
			<li><a href="../Health_Tracking_G/anzeigen.php">Geeti</a></li>
			<li><a href="../Health_Tracking_S/anzeigen.php">Sama</a></li>
			<li><a href="../Health_Tracking_MA/anzeigen.php">Masud</a></li>
			<li><a href="../logout.php">Logout</a></li>
		</ul>
	</nav><br>
	
	<a href="../php_1/php_1.html">PHP I</a>
	
	<h2>Masud</h2>

	<?php
	   
    $mysqli = new mysqli("mysql09.manitu.net", "u88061", "yTDkTZAsJVmBkuhv", "db88061");
	//$mysqli = new mysqli("localhost", "root", "", "myDB");
	if ($mysqli->connect_error) {
	  echo "Fehler bei der Verbindung: " . mysqli_connect_error();
	  exit();
	}
		
	if($ergebnis = $mysqli->prepare("SELECT id, tag, augentropfen, d3, bakterien, floradix, sango, flohsamen, b12, 
			fischoel, zink, acerola, opc, bitter, essig, k2, bkomplex, zitrone FROM health ORDER BY tag")) {
		$ergebnis->execute();
		$ergebnis->bind_result($id, $tag, $augentropfen, $d3, $bakterien, $floradix, $sango, $flohsamen, $b12, 
			$fischoel, $zink, $acerola, $opc, $bitter, $essig, $k2, $bkomplex, $zitrone);
		
		echo "<table>\n";
		echo "<tr><th>Tag</th><th>Tropen</th><th>D3</th><th>Bakterien</th><th>Floradix</th>
		<th>Sango</th><th>FLS</th><th>B12</th><th>Fischöl</th><th>Zink</th><th>Acerola</th>
		<th>OPC</th><th>Bitter</th><th>Essig</th><th>K2</th><th>BKomplex</th>
		<th>Zitrone</th><th class=\"bearbeiten\">Edit</th><th class=\"loeschen\">Delete</th></tr>";
		//echo "<table border='solid 5px'>";	
		while($ergebnis->fetch()) {
			echo "<tr>";			
			echo "<td id=\"tag\"> $tag </td>";	
			if($augentropfen == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($d3 == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($bakterien == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($floradix == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($sango == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($flohsamen == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($b12 == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($fischoel == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($zink == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($acerola == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($opc == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($bitter == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($essig == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($k2 == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($bkomplex == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}
			if($zitrone == "YES") {
				echo "<td class=\"genommen\"></td>";
			} else {
				echo "<td></td>";
			}			
			
			echo "<td class=\"bearbeiten\"><a href='bearbeiten.php?id=" . (int)$id . "'>Edit</a> </td>";
			echo "<td class=\"loeschen\"><a href='loeschen.php?id=" . (int)$id . "'>Delete</a> </td>";			
		}
		echo "</table>\n";	
		
		$ergebnis->close();
	}
	
	$mysqli->close();
		
	?>
	
	<p><a href="neu.php">Tag Hinzufügen</a></p>	

</body>
</html>

<?php
} else {
	$host = $_SERVER["HTTP_HOST"];
	$uri = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	$extra = "../index.php";
	header("Location: http://$host$uri/$extra");
}
?>