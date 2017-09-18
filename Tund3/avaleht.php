<?php
	//Muutujad
	$myName= "Riho";
	$myFamilyName= "Noormets";
	$monthNameEt =["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$myAge= 0;
	$myBirthYear;
	$myLivedYearsList= "";
	
	//var_dump $monthNameEt;
	echo $monthNameEt[8];
	
	$hourNow = date("H");
	
	
	if ($hourNow < 8){
	$partOfDay= "varane hommik";
	}
	if ($hourNow >= 8 and $hourNow < 16){
	$partOfDay= "koolipäev";
	}
	if ($hourNow >= 16){
		$partOfDay = "vaba aeg";
	}
	//Nüüd vaatame, kas ja mida kasutaja sisestas
	//var_dump($_POST);
	if (isset($_POST["yearBirth"])){
		$myBirthYear = $_POST["yearBirth"];
		$myAge= date("Y") - $myBirthYear;
		
		//Tekitame loendi kõigist elatud aastatest
		$myLivedYearsList .="<ol> \n";
		for ($i= $myBirthYear; $i<= date("Y"); $i++){
			//echo $i;
			$myLivedYearsList .="<li>" .$i ."</li> \n";
		}
		$myLivedYearsList .="</ol> \n";
	}
		
?>

<!DOCTYPE html>
<html>


<head>
	<meta charset="utf-8">
	<title> Riho Noormets Veebiproge asjad</title>
</head>


<body>
	<h1>Greeny leht</h1>
	<p>Greeny</p>
	
	<?php
	echo "<p>Täna on 11. september</p>";
	echo "<p> Täna on ";
	$monthIndex = date("n") - 1; //n on kuu ilma lisa nullita ees
	echo date("d. ") .$monthNameEt[$monthIndex] .date(" Y");
	echo "</p>";
	echo "<p>Lehe laadimise hetkel oli kell: " .date("H:i:s") ."</p>";
	echo "<p>Praegu on " .$partOfDay .".</p>";
	?>
	<p> PHP käivitatakse lehe laadimisel ja siis tehakse kogu töö ära.
	Hiljem kui vaja midagi jälle kalkuleerida, siis laetakse kogu leht uuesti</p>
	<?php
	echo "<p>Lehe autori täisnimi on: " .$myName ." " .$myFamilyName .".</p>";
	?>
	<h2>Vanus</h2>
	<p>Järgnevalt palume sisestada oma sünniaasta</p>
	<form method="POST">
		<label>Teie sünniaasta</label>
		<input id="yearBirth" name="yearBirth" type="number" min="1900" max="2017" value="<?php echo $myBirthYear;?>">
		<input id="submitYearBirth" name="submitYearBirth" type="submit" value="Kinnita">
	</form>
	<p>Teie vanus on <?php echo $myAge; ?> aastat </p>
	<?php
		if ($myLivedYearsList !=""){
				echo"<h3>Oled elanud järgnevatel aastatel</h3> \n";
				echo $myLivedYearsList;
		}
	?>
	<h2>Paar linki</h2>
	<p>Õpime <a href="http://www.tlu.ee" target="_blank">Tallinna Ülikoolis</a></p>
	<p>Minu esimene php link on <a href="../esimene.php" target="_blank">siin</a></p>
	<p>Minu sõber Petrik teeb veebi <a href="../../../~sarrpetr/veebiprogrammeerimine/tund3/avaleht.php" target="_blank">siin</a></p>
	<p>Pilte ülikoolist näeb <a href="foto.php">siin</a></p>
</body>
</html>