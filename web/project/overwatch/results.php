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

//create arrays
$suggestList = array();
$enemyStrengths = array();
$allyTeam = array();

//loop through enemy array
for ($x = 1; $x <= 6; $x++) {
  $id = "enemy" . $x;
  $stmt = $db->prepare('SELECT * FROM characters WHERE id=:id');
  $stmt->execute(array(':id' => $_POST[$id]));
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //add to lists
  $suggestList[] = $rows[0]['weak_against'];
  $enemyStrengths[] = $rows[0]['strong_against'];
}

//remove duplicates
$suggestList = array_unique($suggestList);
$enemyStrengths = array_unique($enemyStrengths);

//fill ally team array
for ($x = 1; $x <= 5; $x++) {
  $id = "ally" . $x;
  $allyTeam[] = $_POST[$id];
}

//remove if enemy team is strong_against or ally is playing
$suggestList = array_diff($suggestList, $enemyStrengths, $allyTeam);
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
  echo "<h4>Player: ".$_SESSION['player']."</h4>";
  ?>
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