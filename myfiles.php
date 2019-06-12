<?php
  require("functions.php");
  global $description;
  global $dateFrom;
  global $dateTo;
  //kui pole sisse loginud
  if(!isset($_SESSION["userId"])){
	  header("Location: avaleht.php");
	  exit();
  }

  //väljalogimine
  if(isset($_GET["logout"])){
	session_destroy();
	header("Location: avaleht.php");
	exit();
  }
  $tulemus = showupload($description, $dateFrom, $dateTo);

?>
<?php echo $tulemus ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="modal.css">
  <script src="modal.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Failid</title>
</head>
<body>
  <div id="myModal" class="modal">

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="modalImg">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
  </div>
</body>
</html>
