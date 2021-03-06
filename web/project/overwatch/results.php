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
$suggestNames = array();
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

  $nameId = $rows[0]['weak_against'];

  $stmt = $db->prepare('SELECT name FROM characters WHERE id=:id');
  $stmt->execute(array(':id' => $rows[0]['weak_against']));
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  $suggestNames[$nameId] = $rows[0]['name'];
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

  <div class="topnav">
    <a class="active" href="characterSelect.php">Character Select</a>
    <a href="stats.php">Statistics</a>
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
  <h2 align="center">Suggested Characters</h2>
  <hr/>
  <form action="recordStat.php" method="post" id="myForm">
    <div class='row'>
      <?php
      foreach ($suggestList as $x) {


        echo "<div class='enemyColumn'>";
        echo "<div class='card'>";
        echo "<h3>".$suggestNames[$x]."</h3>";
        echo "<img class='icon' id='suggestIcon".$x."' src='images/".$x.".png'>";

        try
        {
          $stmt = $db->prepare('SELECT * FROM statistics WHERE player=:player AND character=:character');
          $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $x));
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

        echo "<h4>Select</h4>";
        echo "<input type='radio' onclick=\"displayHidden('submitDiv')\" name='character' value='".$x."'>";
        echo "</div>";      
        echo "</div>";      
      }
      ?>
    </div>
    <hr/>
    <div id="submitDiv" class="buttonHolder" style="display:none;">      
      <input type="submit" value="Won" name="win" />
      <input type="submit" value="Lost" name="lose"/>
    </div>
    <hr/>
  </form>


</body>
</html>