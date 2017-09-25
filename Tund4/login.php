<!DOCTYPE HTML>

<?php
	
	require("../../config.php");
	echo $serverHost;
	
	$signupFirstName= "";
	$signupFamilyName= "";
	$signupEmail= "";
	$gender = "";
	$signupBirthMonth =null;
	$signupBirthDay =null;
	$signupBirthYear =null;
	$signupBirthDate ="";
	$signupPassword ="";
	
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupBirthMonthError = "";
	$signupBirthYearError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	//Perekonnanimi
	if (isset ($_POST["signupFamilyName"])){
		if (empty ($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFamilyName = $_POST["signupFamilyName"];
		}
	}
	//Email
	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
	//Eesnimi
	if (isset ($_POST["signupFirstName"])){
		if (empty ($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName = $_POST["signupFirstName"];
		}
	}
	

	//Sugu
	if (isset($_POST["gender"]) && !empty($_POST["gender"])){
		$gender = intval($_POST["gender"]);
	}
	//Sünnikuupäev
	if (isset ($_POST["signupBirthDay"])){
		$signupBirthDay = $_POST["signupBirthDay"];
		//echo $signupBirthDay;
	}

	//Kas sünnikuu on sisestatud
	if(isset($_POST["signupBirthMonth"])) {
		$signupBirthMonth = intval($_POST["signupBirthMonth"]);
	}
	
	//Sünniaasta
	if (isset ($_POST["signupBirthYear"])){
		$signupBirthYear = $_POST["signupBirthYear"];
		//echo $signupBirthYear;
	}
	//Kui sünnikuupäev on sisestatud siis kontroll, kas on valiidne
	if (isset($_POST["signupBirthDay"]) and isset($_POST["signupBirthMonth"]) and isset($_POST["signupBirthYear"])){
		if (checkdate(intval($_POST["signupBirthMonth"]), intval($_POST["signupBirthDay"]), intval($_POST["signupBirthYear"]))){
			$birthDate = date_create($_POST["signupBirthMonth"] ."/" .$_POST["signupBirthDay"] ."/" .$_POST["signupBirthYear"]);
			$signupBirthDate = date_format($birthDate, "Y-m-d");
		} else {
			$signupBirthDayError = "Viga sünnikuupäeva sisestamisel!";
		}
	}
	
	//UUE KASUTAJA ANDMEBAASI KIRJUTAMINE, kui kõik on olemas
	if (empty($signupFirstNameError) and empty($signupFamilyNameError) and empty($signupBirthDayError) and empty($signupGenderError) and empty($signupEmailError)
		and empty($signupPasswordError)){
		echo "Hakkan Salvestama";
		//Krüpteerin passwordi
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		//echo "\n parooli " .$_Post["signupPassword"] ."räsi on " .$signupPassword;
		//loome andmebaasi ühenduse
		$database = "if17_riho_4";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		//valmistame ette käsu andmebaasi serverile
		$stmt = $mysqli->prepare("INSERT INTO vp_users (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer(täisarv)
		//d - decimal
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//stmt->execute();
		if($stmt->execute()){
			echo "\n Õnnestus";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	
	
	/*
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupBirthMonthError = "";
	$signupBirthYearError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	*/
	
	//loome kuupäeva valiku
	$signupDaySelectHTML = "";
	$signupDaySelectHTML .= '<select name="signupBirthDay">' ."\n";
	$signupDaySelectHTML .= '<option value="" selected disabled>Sünnikuupäev</option>' ."\n";
	for ($i = 1; $i < 32; $i ++){
		if($i == $signupBirthDay){
			$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupDaySelectHTML.= "</select>" ."\n";
	
	//Sünnikuu valik
	$signupMonthSelectHTML = "";
	$monthNameEt =["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$signupMonthSelectHTML .='<select name="signupBirthMonth"> \n';
	$signupMonthSelectHTML .='<option value="" selected disabled>Vali sünnikuu</option> \n';
	
	foreach ($monthNameEt as $key=>$month){
		if ($key + 1 === $signupBirthMonth){
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'" selected>' 
			.$month .'</option> \n';
		} else{
		$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' 
		.$month .'</option> \n';
		}
	}
	$signupMonthSelectHTML .= '</select>' ."\n";
	
	//loome aasta valiku
	$signupYearSelectHTML = "";
	$signupYearSelectHTML .= '<select name="signupBirthYear"> \n';
	$signupYearSelectHTML .= '<option value="" selected disabled>aasta</option>' ."\n";
	$yearNow = date("Y");
	for ($i = $yearNow; $i > 1900; $i --){
		if($i == $signupBirthYear){
			$signupYearSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupYearSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupYearSelectHTML.= "</select>" ."\n";
	
	
	
?>
<html>
	<body>
		<form method="POST">
		<label>Username: </label><br/>
		<input type="email" name="LoginEmail"><br/>
		<label>Password </label><br/>
		<input type="password" name="LoginPassword"><br/>
		<input type="submit" value="Login">
		</form>	
		
		<form method="POST">
		<label>Type in your name: </label><br/>
		<label>First Name: </label><br/>
		<input type="text" name="signupFirstName" value="<?php echo $signupFirstName; ?>"> <span><?php echo $signupFirstNameError ?></span><br/>
		
		<label>Last Name </label><br/>
		<input type="text" name="signupFamilyName" value="<?php echo $signupFamilyName ; ?>"> <span><?php echo $signupFamilyNameError ?></span> <br/>
		
		<label>Sisesta oma sünnikuupäev</label><br/>
		<?php
			echo $signupDaySelectHTML .$signupMonthSelectHTML .$signupYearSelectHTML
		
		?>
		</br>
		<span><?php echo $signupBirthDayError ?></span></br>
		
		
		
		<label>Enter your gender: </label><br/>
		<label>Male </label><input type="radio" name="gender" value="1" <?php if ($gender == '1') {echo 'checked';} ?>> 
		<label>Female </label><input type="radio" name="gender" value="2" <?php if ($gender == '2') {echo 'checked';} ?>> <br/> 
		<!--Value 1 ja 2 on samaväärsed nagu M ja N soo määramiseks. -->
		<label>Email: </label><br/>
		<input type="email" name="signupEmail" value="<?php echo $signupEmail; ?>"> <span><?php echo $signupEmailError ?></span> <br/>
		
		<label>Password: </label><br/>
		<input type="password" name="signupPassword"> <br/>
		<input type="submit" value="Register">		
		
		</form>
	</body>
</html>