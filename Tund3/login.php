<!DOCTYPE HTML>

<?php
	$signupFirstName= "";
	$signupFamilyName= "";
	$signupEmail= "";
	$gender = "";
	$signupBirthMonth =null;
	$signupBirthDay =null;
	$signupBirthYear =null;

	if (isset($_POST["signupFamilyName"])){
		$signupFamilyName = $_POST["signupFamilyName"];
	}
	if (isset($_POST["signupEmail"])){
		$signupEmail = $_POST["signupEmail"];
	}
	if (isset($_POST["signupFirstName"])){
		$signupFirstName = $_POST["signupFirstName"];
	}
	if (isset($_POST["gender"]) && !empty($_POST["gender"])){
		$gender = intval($_POST["gender"]);
	}
	//Kas sünnikuu on sisestatud
	if(isset($_POST["signupBirthMonth"])) {
		$signupBirthMonth = intval($_POST["signupBirthMonth"]);
	}
	
	
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
	$signupMonthSelectHTML .= '</select>'
	
	
	
?>
<html>
	<body>
		<form>
		<label>Username: </label><br/>
		<input type="email" name="LoginEmail"><br/>
		<label>Password </label><br/>
		<input type="password" name="LoginPassword"><br/>
		<input type="submit" value="Login">
		</form>	
		
		<form method="POST">
		<label>Type in your name: </label><br/>
		<label>First Name: </label><br/>
		<input type="text" name="signupFirstName" value="<?php echo $signupFirstName; ?>"> <br/>
		
		<label>Last Name </label><br/>
		<input type="text" name="signupFamilyName" value="<?php echo $signupFamilyName ; ?>"> <br/>
		
		<label>Sisesta oma sünnikuupäev</label><br/>
		<?php
			echo $signupMonthSelectHTML 
		
		?>
		</br>
		
		
		
		<label>Enter your gender: </label><br/>
		<label>Male </label><input type="radio" name="gender" value="1" <?php if ($gender == '1') {echo 'checked';} ?>> 
		<label>Female </label><input type="radio" name="gender" value="2" <?php if ($gender == '2') {echo 'checked';} ?>> <br/> 
		<!--Value 1 ja 2 on samaväärsed nagu M ja N soo määramiseks. -->
		<label>Email: </label><br/>
		<input type="email" name="signupEmail" value="<?php echo $signupEmail; ?>"> <br/>
		
		<label>Password: </label><br/>
		<input type="password" name="signupPassword"> <br/>
		<input type="submit" value="Register">		
		
		</form>
	</body>
</html>