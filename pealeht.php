<?php
  require("functions.php");
  //Kui pole sisse loginud
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="pealeht.css">
  <script src="pealeht.js"></script>
  <title>Pealeht</title>
</head>
<body>
  <div id="mySidenav" class="sidenav">
    <h1 id="text">Tere, <?php echo $_SESSION["userName"]; ?>!</h1>
      <a style="font-family: 'digital-clock-font'; cursor:pointer" href="upload.php">Lae üles</a>
  <br>
  <br>
  <a id="text" style="font-family: 'digital-clock-font';cursor:pointer" href="myfiles.php">Sinu lepingud</a>
  <br>
  <br>
  <a href="?logout=1">Logi välja</a>
  </div>
</body>
</html>