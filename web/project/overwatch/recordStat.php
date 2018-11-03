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
  <div class='buttonHolder'>
    <div class='resultsColumn'>
      <div class='card'>        
        <?php
        //echo "<h3>".$suggestNames[$x]."</h3>";
        echo "<img class='icon' id='suggestIcon".$_POST['character']."' src='images/".$_POST['character'].".png'>";
        try
        {
          $stmt = $db->prepare('SELECT * FROM statistics WHERE player=:player AND character=:character');
          $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $_POST['character']));
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex)
        {
        }

        if (!empty($rows)) {
          if($_POST["win"]) {
            $newWins = $rows[0]['wins'] + 1;
            $total = $newWins + $rows[0]['loses'];
            $winRate = $newWins / $total;
            $percent = round((float)$winRate * 100 ) . '%';
            echo "<h4>New Win Rate: ".$percent."</h4>";
            $stmt = $db->prepare('UPDATE statistics SET wins=:wins WHERE player=:player AND character=:character');
            $stmt->execute(array(':wins' => $newWins, ':player' => $_SESSION['playerId'], ':character' => $_POST['character']));
          } else {
            $newLoses = $rows[0]['loses'] + 1;
            $total = $rows[0]['wins'] + $newLoses;
            $winRate = $rows[0]['wins'] / $total;
            $percent = round((float)$winRate * 100 ) . '%';
            echo "<h4>New Win Rate: ".$percent."</h4>";
            $stmt = $db->prepare('UPDATE statistics SET loses=:loses WHERE player=:player AND character=:character');
            $stmt->execute(array(':loses' => $newLoses, ':player' => $_SESSION['playerId'], ':character' => $_POST['character']));
          }
        } else {
          $stmt = $db->prepare('INSERT INTO statistics (player, character, wins, loses) VALUES (:player, :character, :wins, :loses)');
          if($_POST["win"]) {
            echo "<h4>New Win Rate: 100%</h4>";
            $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $_POST['character'], ':wins' => 1, ':loses' => 0));
          } else {
            echo "<h4>New Win Rate: 0%</h4>";
            $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $_POST['character'], ':wins' => 0, ':loses' => 1));
          }
        }
        ?>
      </div>
    </div>
  </div>


</body>
</html>