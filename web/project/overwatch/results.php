<?php

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
  echo "<p>Enemy 1: ".$_POST["enemy1"]."</p>";
  echo "<p>Enemy 2: ".$_POST["enemy2"]."</p>";
  echo "<p>Enemy 3: ".$_POST["enemy3"]."</p>";
  echo "<p>Enemy 4: ".$_POST["enemy4"]."</p>";
  echo "<p>Enemy 5: ".$_POST["enemy5"]."</p>";
  echo "<p>Enemy 6: ".$_POST["enemy6"]."</p>";
  echo "<br/>";
  echo "<p>Ally 1: ".$_POST["ally1"]."</p>";
  echo "<p>Ally 2: ".$_POST["ally2"]."</p>";
  echo "<p>Ally 3: ".$_POST["ally3"]."</p>";
  echo "<p>Ally 4: ".$_POST["ally4"]."</p>";
  echo "<p>Ally 5: ".$_POST["ally5"]."</p>";
  ?>

</body>
</html>