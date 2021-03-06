<?php
session_start();


try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
  <title>Overwatch Character Selector</title>
</head>
<body>
  <div class="header-image">
    <div class="header-text">
      <h1 style="font-size:50px">Overwatch Character Selector</h1>
      <p>Matt Beagley's project for CS313</p>
    </div>
  </div>
  <hr/>

  <?php

  try
  {
   $stmt = $db->prepare('INSERT INTO players (username, password) VALUES (:username, :password)');
   $stmt->execute(array(':username' => $_POST['registerUsername'], ':password' => $_POST['registerPassword']));
   $newId = $db->lastInsertId();

 }
 catch (PDOException $ex)
 {
  echo "<div class='buttonHolder'>";
  echo '<h3>Error! That username already exists. Please try a differnt one.</h3>';
  echo '<a href="login.php" class="button">Return to Login/Register page</a>';
  echo "</div>";
  die();
}
echo "<div class='buttonHolder'>";
echo "<h3>Player ".$_POST['registerUsername']." successfully created!</h3>";
$_SESSION['player'] = $_POST['registerUsername'];
$_SESSION['playerId'] = $newId;

echo '<a href="login.php" class="button">Return to Login/Register page</a>';
echo '<a href="characterSelect.php" class="button">Proceed to Character Select page</a>';
echo "</div>";
?>


</body>
</html>