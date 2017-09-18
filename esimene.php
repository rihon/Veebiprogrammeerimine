<?php
	//Muutujad
	$myName= "Riho";
	$myFamilyName= "Noormets";
	//$practiceStarted= "2017-09-11 8.15";
	$practiceStarted= date("d.m.Y") ." " ."8.15";
	
	//echo strtotime($practiceStarted);
	//echo strtotime("now");
	$timePassed= round(strtotime("now")- strtotime($practiceStarted)) / 60;
	//echo $timePassed;
	$hourNow = date("H");
	$partOfDay= "";
	
	if ($hourNow < 8){
	$partOfDay= "varane hommik";
	}
	if ($hourNow >= 8 and $hournow < 16){
	$partOfDay= "koolipäev";
	}
	if ($hourNow >= 16){
		$partOfDay = "vaba aeg";
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
	echo date("d.m.Y");
	echo "</p>";
	echo "<p>Lehe laadimise hetkel oli kell: " .date("H:i:s") ."</p>";
	echo "<p>Praegu on " .$partOfDay .".</p>";
	?>
	<p> PHP käivitatakse lehe laadimisel ja siis tehakse kogu töö ära.
	Hiljem kui vaja midagi jälle kalkuleerida, siis laetakse kogu leht uuesti</p>
	<?php
	echo "<p>Lehe autori täisnimi on: " .$myName ." " .$myFamilyName .".</p>";
	?>
</body>
</html>