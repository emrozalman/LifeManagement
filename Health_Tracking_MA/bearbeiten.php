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
	if(!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
		header("Location: http://$host$uri/$extra");
	}	
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Termine bearbeiten</title>
<style>
body { font-size: 80%; font-family: sans-serif; }
</style>
</head>
<body>	

<?php
$id = $_GET["id"];
if($stmt = $mysqli->prepare("SELECT id, tag, augentropfen, d3, bakterien, floradix, sango, 
							b12, fischoel, zink, acerola, opc, bitter, essig, k2, bkomplex, zitrone, flohsamen 
							FROM health WHERE id=?")) {
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->bind_result($id, $tag, $augentropfen, $d3, $bakterien, $floradix, $sango, $b12, $fischoel,
						$zink, $acerola, $opc, $bitter, $essig, $k2, $bkomplex, $zitrone, $flohsamen);
	$stmt->fetch();
	$stmt->close();
	$mysqli->close();
}
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
	<p><input type="text" name="tag" maxlength="25" value="<?php echo $tag ?>"> Tag</p>	
	<p><input type="checkbox" name="augentropfen" <?php if($augentropfen == "YES") { echo "checked"; } ?>> Augentropfen<br>	
	<input type="checkbox" name="d3" <?php if($d3 == "YES") { echo "checked"; } ?>> D3<br>	
	<input type="checkbox" name="bakterien" <?php if($bakterien == "YES") { echo "checked"; } ?>> Bakterien<br>	
	<input type="checkbox" name="floradix" <?php if($floradix == "YES") { echo "checked"; } ?>> Floradix<br>
	<input type="checkbox" name="sango" <?php if($sango == "YES") { echo "checked"; } ?>> Sango<br>
	<input type="checkbox" name="b12" <?php if($b12 == "YES") { echo "checked"; } ?>> B12<br>
	<input type="checkbox" name="fischoel" <?php if($fischoel == "YES") { echo "checked"; } ?>> Fischöl<br>
	<input type="checkbox" name="zink" <?php if($zink == "YES") { echo "checked"; } ?>> Zink<br>
	<input type="checkbox" name="acerola" <?php if($acerola == "YES") { echo "checked"; } ?>> Acerola<br>
	<input type="checkbox" name="opc" <?php if($opc == "YES") { echo "checked"; } ?>> OPC<br>
	<input type="checkbox" name="bitter" <?php if($bitter == "YES") { echo "checked"; } ?>> Bitter<br>
	<input type="checkbox" name="essig" <?php if($essig == "YES") { echo "checked"; } ?>> Essig<br>
	<input type="checkbox" name="k2" <?php if($k2 == "YES") { echo "checked"; } ?>> K2<br>
	<input type="checkbox" name="bkomplex" <?php if($bkomplex == "YES") { echo "checked"; } ?>> BKomplex<br>
	<input type="checkbox" name="flohsamen" <?php if($flohsamen == "YES") { echo "checked"; } ?>> FLS<br>
	<input type="checkbox" name="zitrone" <?php if($zitrone == "YES") { echo "checked"; } ?>> Zitrone</p>	
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit">
</form>
</body>
</html>
	
<?php


} else {
	if($stmt = $mysqli->prepare("UPDATE health
				SET tag=?, augentropfen=?, d3=?, bakterien=?, floradix=?,
				sango=?, b12=?, fischoel=?, zink=?, acerola=?, opc=?,
				bitter=?, essig=?, k2=?, bkomplex=?, zitrone=?, flohsamen=? WHERE id=?")) {
		$id = (int)$_POST["id"];
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
		
		$stmt->bind_param("sssssssssssssssssi", $tag, $augentropfen, $d3, $bakterien, $floradix, $sango, $b12, $fischoel,
						$zink, $acerola, $opc, $bitter, $essig, $k2, $bkomplex, $zitrone, $flohsamen, $id);
		$stmt->execute();
		$stmt->close();
		$mysqli->close();
		header("Location: http://$host$uri/$extra");
	}
}

?>