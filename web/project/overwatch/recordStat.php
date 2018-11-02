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

  <ul>
    <?php
    if (empty($_SESSION['player'])) {
      echo "<li><a class='active' href='login.php'>Login</a></li>";
      echo "<li><a>Not Logged In</a></li>";    
    } else {
      echo "<li><a class='active' href='login.php'>Logout</a></li>";
      echo "<li><a>Player: ".$_SESSION['player']."</a></li>";    
    }
    ?>
  </ul>
  <hr/>


  <?php
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
      $stmt = $db->prepare('UPDATE statistics SET wins=:wins WHERE player=:player AND character=:character');
      $stmt->execute(array(':wins' => $newWins, ':player' => $_SESSION['playerId'], ':character' => $_POST['character']));
    } else {
      $newLoses = $rows[0]['loses'] + 1;
      $stmt = $db->prepare('UPDATE statistics SET loses=:loses WHERE player=:player AND character=:character');
      $stmt->execute(array(':loses' => $newLoses, ':player' => $_SESSION['playerId'], ':character' => $_POST['character']));
    }
  } else {
    $stmt = $db->prepare('INSERT INTO statistics (player, character, wins, loses) VALUES (:username, :password, :wins, :loses)');
    if($_POST["win"]) {
      $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $_POST['character'], ':wins' => 1, ':loses' => 0));
    } else {
      $stmt->execute(array(':player' => $_SESSION['playerId'], ':character' => $_POST['character'], ':wins' => 0, ':loses' => 1));
    }
  }
  ?>


</body>
</html>