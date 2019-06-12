<?php
	require("functions.php");
	echo "<body style='background-color:#FFFFFF'>";
	$email = "";
	$firstName = "";
  $lastName = "";

	//muutujad võimalike veateadetega
	$firstNameError = "";
    $lastNameError = "";
	$emailError = "";
	$passwordError = "";
	$error = "";

	//kui on uue kasutaja loomise nuppu vajutatud
	if(isset($_POST["submitUserData"])){
	//var_dump($_POST); //Tähtis array $_POST
	if (isset($_POST["firstName"]) and !empty($_POST["firstName"])){
		//$name=$_POST["firstName"];
		$firstName = test_input($_POST["firstName"]);
	}else{
		$firstNameError="Palun sisesta eesnimi!";
	}
   if(isset($_POST["submitUserData"])){
	//var_dump($_POST); //Tähtis array $_POST
	if (isset($_POST["lastName"]) and !empty($_POST["lastName"])){
		//$name=$_POST["firstName"];
		$lastName = test_input($_POST["lastName"]);
	}else{
		$lastNameError="Palun sisesta perekonnanimi!";
	}
	if(isset($_POST["email"]) and !empty($_POST["email"])){
		$email = test_input($_POST["email"]);
	}else{
		$emailError = "Sisestage korrektne email!";
	}

	//passwordi kontroll
	if(!empty($_POST["password"]) and ($_POST["password"] == $_POST["password2"])){
		//$password=$_POST["password"];
		$password = test_input($_POST["password"]);
		$password2 = test_input($_POST["password2"]);

	if (strlen($_POST["password"]) < '8' ) {
		$passwordError = "Salasõna peab olema vähemalt 8 tähemärgi pikkune!";
		} 
	}
	else {
		if($_POST["password"] != $_POST["password2"]) {
			$passwordError = "Salasõnad ei kattu!";
			if (strlen($_POST["password"]) < '8' ) {
				$passwordError = "Salasõna peab olema vähemalt 8 tähemärgi pikkune!";
				} 
			} else{
		    $passwordError = "Palun sisestage salasõna!";
			}
	}
	//kui kõik on korras, siis salvestame kasutaja
	if(empty($firstNameError) and empty($lastNameError) and empty($emailError) and empty($passwordError)){
		$notice = signup($firstName, $lastName, $email, $password, $password2);
		echo $notice;
		echo"<script language='javascript'>
				alert('Kasutaja loodud!');
				window.location.href = 'avaleht.php';
		</script>";
	}else{
		$error = "Kasutaja loomisel tekkis viga!";
	}
	}//kui on nuppu vajutatud lõppeb ära
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="newuser.css">
	<title>Konto loomine</title>
</head>
<body>
	<br>

	<div id="main">
	   <div> <img src="signature.png" id="logo" alt="logo"></div>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		    <h1>Konto loomine</h1>
			<input name="firstName" type="text" placeholder="Eesnimi" value="<?php echo $firstName; ?>"><br>
      <input name="lastName" type="text" placeholder="Perekonnanimi" value="<?php echo $lastName; ?>"><br>
			<input type="email" name="email" placeholder="E-Mail" value="<?php echo $email; ?>"><br>
			<input type="password" name="password" type="text" placeholder="Salasõna" ><br>
			<input type="password" name="password2" type="text" placeholder="Salasõna uuesti" ><br>
			<input name="submitUserData" type="submit" value="Loo kasutaja"><br>
		<br>
			<a style="text-align:left;" href="avaleht.php">Tagasi avalehele</a>
		</form>
		<a1><?php echo $error; ?></a1>
		<a1><?php echo $passwordError; ?></a1>
		<a1><?php echo $emailError; ?></a1>
		<a1><?php echo $lastNameError; ?></a1>
		<a1><?php echo $firstNameError; ?></a1>
	</div>
</body>
</html>
