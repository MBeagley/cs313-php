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
  <h2 align="center">Enemy Team</h2>
  <hr/>
  <form action="results.php" method="post" id="myForm">
    <div class="row">
      <?php
      for ($x = 1; $x <= 6; $x++) {
        echo "<div class='enemyColumn'>";
        echo "<div class='card'>";
        echo "<h3>Enemy ".$x."</h3>";
        echo "<img class='icon' id='enemyIcon".$x."' src='images/1.png' onload=\"displayIcon('enemyIcon".$x."', 'enemy".$x."')\">";
        echo "<span class='custom-dropdown'>";
        echo "<select name='enemy".$x."' form='myForm' id='enemy".$x."' onchange=\"displayIcon('enemyIcon".$x."', 'enemy".$x."')\">";
        foreach ($db->query('SELECT * FROM characters') as $row)
        {
          echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
        echo "</select>";
        echo "</span>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>

    <hr/>
    <h2 align="center">Ally Team</h2>
    <hr/>
    <div class="row">
      <?php
      for ($x = 1; $x <= 5; $x++) {
        echo "<div class='allyColumn'>";
        echo "<div class='card'>";
        echo "<h3>Ally ".$x."</h3>";
        echo "<img class='icon' id='allyIcon".$x."' src='images/1.png' onload=\"displayIcon('allyIcon".$x."', 'ally".$x."')\" style='width:100%'>";
        echo "<span class='custom-dropdown'>";
        echo "<select name='ally".$x."' form='myForm' id='ally".$x."' onchange=\"displayIcon('allyIcon".$x."', 'ally".$x."')\">";
        foreach ($db->query('SELECT * FROM characters') as $row)
        {
          echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
        echo "</select>";
        echo "</span>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
    <hr/>
    <div class="buttonHolder">
      <input type="submit" value="Submit">
    </div>
    <hr/>
  </form>

</body>
</html>