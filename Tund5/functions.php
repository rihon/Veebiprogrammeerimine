<?php
/*
$x = 5;
$y = 6;
echo($x + $y);
addValues();
function addValues(){
	$z = $GLOBALS["x"] + $GLOBALS["y"];
	echo "Summa on: " .$z;
	$a = 3;
	$b = 4;
	echo "Teine summa on: " .($a + $b);
}	
echo "Kolmas summa on: " .($a + $b);
*/


	//TEKSTI PUHASTUS FUNKTSIOON
//sisestuse kontrollimise funktsioon
function test_input($data){//sulgudesse kirjutatakse argumente
	//Kontroll kas emailil pole tühikuid, kaldkriipsud
	$data = trim($data);//Ebavajalikud tühikud jms eemaldatud
	$data = stripslashes($data); //Kaldkriipsud eemaldada
	$data = htmlspecialchars($data);//Keelatud sümbolid ($)
	return $data;
}


$database = "if17_riho_4";
//alustan sessiooni
session_start();
//KASUTAJA SALVESTAMISE FUNKTSIOON
function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
//loome andmebaasiühenduse
			
			$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			//valmistame ette käsu andmebaasiserverile
			$stmt = $mysqli->prepare("INSERT INTO vp_users (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
			echo $mysqli->error;
			//s - string
			//i - integer
			//d - decimal
			$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
			//$stmt->execute();
			if ($stmt->execute()){
				echo "\n Õnnestus!";
			} else {
				echo "\n Tekkis viga : " .$stmt->error;
			}
			$stmt->close();
			$mysqli->close();
}	

//SISSELOGIMISE FUNKTSIOON
function signIn($email, $password) {
	$notice ="";
	//serveriga ühenduse loomine
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, email, password FROM vp_users WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
	$stmt->execute();
	
	//Kontrollime vastavust
	if($stmt->fetch()){
		$hash = hash("sha512", $password);
		if($hash == $passwordFromDb){
			$notice = "Logisite sisse!";
			
			//Määran sessiooni muutujad
			$_SESSION["userId"] = $id;
			$_SESSION["userEmail"] = $emailFromDb;
						
			//Liigume edasi pealehele (main.php)
			header("Location: main.php");
			exit();
		} else {
			$notice = "Vale salasõna!";
		}	
	} else {
		$notice = 'Sellise kasutajatunnusega "' .$email .'" ei ole registreeritud.';
	}	
	$stmt->close();
	$mysqli->close();
	return $notice;
	
}








?>
