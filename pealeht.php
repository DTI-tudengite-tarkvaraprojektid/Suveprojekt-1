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
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <h1 id="sidenavMenu">Menüü</h1>
      <a style="font-family: 'digital-clock-font'; cursor:pointer" href="upload.php">Upload</a>
  <br>
  <br>
  <a id="text" style="font-family: 'digital-clock-font';cursor:pointer" href="myfiles.php">View files</a>
  <br>
  <br>
  <a href="?logout=1">Logout</a>
  </div>
  <span style="font-size:20px; color:black;cursor:pointer" onclick="openNav()">&#9776; Lisavalikud</span>
</body>
</html>
