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

$suggestList = array();
$teamStrengths = array();

for ($x = 1; $x <= 6; $x++) {
  $id = "enemy" . $x;
  $stmt = $db->prepare('SELECT * FROM characters WHERE id=:id');
  $stmt->execute(array(':id' => $_POST[$id]));
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $suggestList[] = $rows[0]['weak_against'];
}

$suggestList = array_unique($suggestList);

// for ($x = 1; $x <= 5; $x++) {
//   $id = "ally" . $x;
//   $stmt = $db->prepare('SELECT * FROM characters WHERE id=:id');
//   $stmt->execute(array(':id' => $_POST[$id]));
//   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//   $teamStrengths[] = $rows[0]['strong_against'];
// }

// $arrlength = count($teamStrengths);
// for($x = 0; $x < $arrlength; $x++) {
//   if (($key = array_search($teamStrengths[$x], $suggestList)) !== false) {
//     unset($suggestList[$key]);
//   }
// }
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
  <h2 align="center">Suggested Characters</h2>
  <hr/>
  <div class='row'>
    <?php
    foreach ($suggestList as $x) {
      echo "<div class='enemyColumn'>";
      echo "<div class='card'>";
      echo "<img class='icon' id='suggestIcon".$x."' src='images/".$x.".png'>";
      echo "</div>";      
      echo "</div>";      
    }
    ?>
  </div>

</body>
</html>