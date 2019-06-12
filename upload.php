<?php
require ("functions.php");
//kui pole sisselogitud
  if(!isset($_SESSION["userId"])){
	header("Location:avaleht.php");
	exit();
  }
  //Väljalogimine
  if(isset($_GET["logout"])){
	session_destroy();
	header("Location:avaleht.php");
	exit();
  }
  $mybgcolor = "#FFFFFF";
  $mytxtcolor = "#000000";
if(isset($_POST['submit'])){
  $file = $_FILES['fileToUpload'];

  $dateFrom = date('Y-m-d', strtotime($_POST['algus']));
  $dateTo = date('Y-m-d', strtotime($_POST['lopp']));

  $description = $_REQUEST['Description'];
  $filename = $_FILES['fileToUpload']['name'];
  $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
  $fileSize = $_FILES['fileToUpload']['size'];
  $fileError = $_FILES['fileToUpload']['error'];
  $fileType = $_FILES['fileToUpload']['type'];


  $fileExt = explode('.', $filename);
  $fileActualExt = strtolower(end($fileExt));
  $description .="." .$fileActualExt;
  $allowed = array('jpg', 'jpeg','png','pdf');

  if(in_array($fileActualExt, $allowed)){
    if($fileError ===0){
      if($fileSize < 5000000){
        $fileNameNew =  $description;
        $fileDestination = 'uploads/'.$fileNameNew;
        if(file_exists($fileDestination)){
          echo "Sellise nimega fail on juba olemas!";
        } else {
        move_uploaded_file($fileTmpName, $fileDestination);
        upload($description, $dateFrom, $dateTo);
        }
      } else {
        echo "fail on liiga suur";
      }
    } else {
      echo "oli viga üleslaadimisel";
    }
  }else{
    echo "Ei saa sellist tüüpi faili laadida";
  }

}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="pealeht.css">
  <script src="pealeht.js"></script>
  <title>Faili üleslaadimine</title>
</head>
<body>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <p>Fail:</p>
      <input type="file" name="fileToUpload" id="fileToUpload">
      <p>Faili nimi:</p>
      <textarea rows="2" cols="35" name="Description" id="Description"></textarea>
      <br/>
      <p>Lepingu algus: </p>
      <input type="date" id="algus" name="algus">
      <br>
      <p>Lepingu lõpp: </p>
      <input type="date" id="lopp" name="lopp">
      <br>
      <br>
      <input TYPE="submit" name="submit" value="Upload file">
  </form>
</body>
</html>
