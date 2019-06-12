<?php
require ("../../config.php");
$database = "if18_andri_ka_1";
session_start();
function signin($email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, firstname, email, password FROM kasutajad WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($idFromDb, $firstNameFromDb, $emailFromDb, $passwordFromDb);
	if($stmt->execute()){
		//Kui päring õnnestus
	  if($stmt->fetch()){
		  $stmt -> close();
		 //kasutaja on olemas
		$stmt= $mysqli->prepare ("UPDATE kasutajad SET counter= counter + 1 WHERE id=$idFromDb");
		$stmt ->execute();
		  if(password_verify($password,$passwordFromDb)){
			//Kui salasõna klapib
			$notice = "Logisite sisse";
			//Määran sessiooni muutujad
			$_SESSION["userId"] = $idFromDb;
			$_SESSION["userName"] = $firstNameFromDb;
			$_SESSION["userEmail"] = $emailFromDb;
			$_SESSION["userCounter"] = $counterFromDb;
			//liigume kohe vaid sisselogitudele mõeldud pealehele
			//$stmt->close();
			//$mysqli->close();
			header("Location: pealeht.php");
			exit();
		  } else {
		    $notice = "Vale salasõna";
		  }
	  } else {
	    $notice = "Sellist kasutajat(" .$email .") ei leitud";
	  }
	} else {
	  $notice = "Sisenemisel tekkis viga" .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
  }//sisselogimine lõppeb
function signup($firstName, $lastName, $email, $password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//kontrollime, ega kasutajat juba olemas pole
	$stmt = $mysqli->prepare("SELECT id FROM kasutajad WHERE email=?");
	echo $mysqli->error;
	$stmt->bind_param("s",$email);
	$stmt->execute();
	if($stmt->fetch()){
		//leiti selline, seega ei saa uut salvestada
		$notice = "Sellise kasutajatunnusega (" .$email .") kasutaja on juba olemas! Uut kasutajat ei salvestatud!";
	} else {
		$stmt->close();
		$stmt = $mysqli->prepare("INSERT INTO kasutajad (firstname, lastname, email, counter, password) VALUES(?,?,?,1, ?)");
    	echo $mysqli->error;
	    $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	    $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	    $stmt->bind_param("ssss", $firstName, $lastName, $email, $pwdhash);
	    if($stmt->execute()){
		  $notice = "ok";
	    } else {
	      $notice = "error" .$stmt->error;
	    }
	}
	return $notice;
	$stmt ->close();
	$mysqli->close();
  }
	function upload($description, $dateFrom, $dateTo, $dateNotice){
		global $tempFileName;
		$notice ="";
		$id = $_SESSION["userId"];
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//kontroll, kas fail on juba olems
		$stmt = $mysqli ->prepare("SELECT failinimi FROM failid WHERE failinimi=?");
		echo $mysqli->error;
		$stmt -> bind_param("s", $description);
		$stmt->execute();
		if($stmt->fetch()){
			echo "Sellise nimega pilt on olemas.";
		}else{
			$stmt -> close();
			$stmt = $mysqli->prepare("INSERT INTO failid (failinimi, algus, lopp, teavitus, kasutaja_id) VALUES(?,?,?,?,?)");
			$stmt->bind_param("ssssi", $description, $dateFrom, $dateTo, $dateNotice, $id);
			echo "teade: ".$mysqli->error;
			$stmt->execute();
			echo $stmt->error;
		}
		$stmt ->close();
		$mysqli->close();
		return $notice;
	}
	function showupload($description, $dateFrom, $dateTo){
		$id = $_SESSION["userId"];
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, failinimi, algus, lopp FROM failid WHERE kasutaja_id = $id");
		echo $mysqli->error;
		$stmt->bind_result($photoId, $description, $dateFrom, $dateTo);
		$stmt -> execute();
		echo '<div class="photoRow" id="photoRow"> ';
		echo "\n";
		while($stmt->fetch()){
				echo '<div class="photoColumn" id="photoColumn"> ';
				echo "\n";
				echo '<img data-fn=' .$description .' class="photo" src="uploads/' .$description .'" data-id="' .$photoId .'" alt="' .$description .'" style="width:20%; height:20%; max-width:300px">';
				echo "\n";
				echo " <a href=deleteThisFile.php?id=" .$photoId ."&file=".$description ." class='deleteBtn' >Delete</a> ";
				echo "\n";
				echo '</div>';
		}
		echo "\n";
		echo '</div>';
		echo "\n";
		if(empty($html)){
			$html = "<p>Kahjuks pilte pole!</p> \n";
		}
	}
	function deleteImage($fileToDelete){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("DELETE FROM failid WHERE failinimi= '$fileToDelete'");
		echo $mysqli->error;
		if($stmt -> execute()){
			echo "fail kustutati.";
		}else{
			echo "faili ei kustutatud.";
		}
		$stmt ->close();
		$mysqli->close();
	}
	function test_input($data) {
		//echo "Koristan!\n";
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}