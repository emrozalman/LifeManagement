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

if(empty($_POST["tag"])) {	
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Termin eingeben</title>
<style>
body { font-size: 80%; font-family: sans-serif; }

</style>
</head>
<body>	
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
	<p><input type="text" name="tag" maxlength="25"> Tag</p>	
	<p><input type="checkbox" name="augentropfen"> Augentropfen<br>	
	<input type="checkbox" name="d3"> D3<br>	
	<input type="checkbox" name="bakterien"> Bakterien<br>	
	<input type="checkbox" name="floradix"> Floradix<br>
	<input type="checkbox" name="sango"> Sango<br>
	<input type="checkbox" name="b12"> B12<br>
	<input type="checkbox" name="fischoel"> Fischöl<br>
	<input type="checkbox" name="zink"> Zink<br>
	<input type="checkbox" name="acerola"> Acerola<br>
	<input type="checkbox" name="opc"> OPC<br>
	<input type="checkbox" name="bitter"> Bitter<br>
	<input type="checkbox" name="essig"> Essig<br>
	<input type="checkbox" name="k2"> K2<br>
	<input type="checkbox" name="bkomplex"> BKomplex<br>
	<input type="checkbox" name="flohsamen"> FLS<br>
	<input type="checkbox" name="zitrone"> Zitrone</p>	
	<input type="submit">
</form>
</body>
</html>
<?php
} else {
	if($stmt = $mysqli->prepare("INSERT INTO health (tag, augentropfen, d3, bakterien, floradix, sango, b12, 
			fischoel, zink, acerola, opc, bitter, essig, k2, bkomplex, zitrone, flohsamen) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
		$tag = $_POST["tag"];
		$augentropfen = "NO";
		if(isset($_POST["augentropfen"])){
			$augentropfen = "YES";
		}
		$d3 = "NO";
		if(isset($_POST["d3"])){
			$d3 = "YES";
		}
		$bakterien = "NO";
		if(isset($_POST["bakterien"])){
			$bakterien = "YES";
		}
		$floradix = "NO";
		if(isset($_POST["floradix"])){
			$floradix = "YES";
		}
		$sango = "NO";
		if(isset($_POST["sango"])){
			$sango = "YES";
		}
		$b12 = "NO";
		if(isset($_POST["b12"])){
			$b12 = "YES";
		}
		$fischoel = "NO";
		if(isset($_POST["fischoel"])){
			$fischoel = "YES";
		}
		$zink = "NO";
		if(isset($_POST["zink"])){
			$zink = "YES";
		}
		$acerola = "NO";
		if(isset($_POST["acerola"])){
			$acerola = "YES";
		}
		$opc = "NO";
		if(isset($_POST["opc"])){
			$opc = "YES";
		}
		$bitter = "NO";
		if(isset($_POST["bitter"])){
			$bitter = "YES";
		}
		$essig = "NO";
		if(isset($_POST["essig"])){
			$essig = "YES";
		}
		$k2 = "NO";
		if(isset($_POST["k2"])){
			$k2 = "YES";
		}
		$bkomplex = "NO";
		if(isset($_POST["bkomplex"])){
			$bkomplex = "YES";
		}
		$zitrone = "NO";
		if(isset($_POST["zitrone"])){
			$zitrone = "YES";
		}
		$flohsamen = "NO";
		if(isset($_POST["flohsamen"])){
			$flohsamen = "YES";
		}
							
		$stmt->bind_param("sssssssssssssssss", $tag, $augentropfen, $d3, $bakterien, $floradix, $sango, $b12, 
			$fischoel, $zink, $acerola, $opc, $bitter, $essig, $k2, $bkomplex, $zitrone, $flohsamen);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
		header("Location: http://$host$uri/$extra");
	}	
}
?>