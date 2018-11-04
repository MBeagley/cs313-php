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

  <div class="topnav">
    <a href="characterSelect.php">Character Select</a>
    <a class="active" href="stats.php">Statistics</a>
    <div class="topnav-right">
      <?php
      if (empty($_SESSION['player'])) {
        echo "<a>Not Logged In</a>";    
        echo "<a class='active' href='login.php'>Login</a>";
      } else {
        echo "<a>Player: ".$_SESSION['player']."</a>";
        echo "<a class='active' href='login.php'>Logout</a>";
      }
      ?>
    </div>
  </div>

  <hr/>
  <h2 align="center">Statistics</h2>
  <hr/>
  <div class='row'>
    <?php
    $counter = 0;
    foreach ($db->query('SELECT * FROM characters') as $row)
    {
      echo "<div class='enemyColumn'>";
      echo "<div class='card'>";
      echo "<h3>".$row['name']."</h3>";
      echo "<img class='icon' id='suggestIcon".$row['id']."' src='images/".$row['id'].".png'>";

      try
      {
        $stmt = $db->prepare('SELECT * FROM statistics WHERE player=:player AND character=:character');
        $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $row['id']));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch (PDOException $ex)
      {
        echo '<h4>Win Rate: n/a</h4>';
      }

      if (!empty($rows)) {
        $total = $rows[0]['wins'] + $rows[0]['loses'];
        $winRate = $rows[0]['wins'] / $total;
        $percent = round((float)$winRate * 100 ) . '%';
        echo "<h4>Win Rate: ".$percent."</h4>";
      } else {
        echo '<h4>Win Rate: n/a</h4>';
      }
      echo "</div>";      
      echo "</div>";

      $counter++;
      if ($counter % 6 == 0) {
        echo "</div>";  
        echo "<div class='row'>";
      }

    }
    ?>
  </div>
  <hr/>


</body>
</html>