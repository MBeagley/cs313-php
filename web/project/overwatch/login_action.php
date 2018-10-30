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
    $username = $_POST['loginUsername'];
    $stmt = $db->prepare('SELECT * FROM players WHERE username=:username');
    $stmt->execute(array(':username' => $username));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (PDOException $ex)
  {
    echo '<h3>Error! That username already exists. Please try a differnt one</h3>';
    echo '<a href="login.php" class="button">Return to Login/Register page</a>';
    die();
  }

  if (!empty($rows)){
    if ($rows[0]['password'] == $_POST['loginPassword']) {
      echo "<h1>Logged in as ".$username."!</h1>";
      $_SESSION['player'] = $username;
      $_SESSION['playerId'] = $rows[0]['id'];
      echo '<a href="login.php" class="button">Return to Login/Register page</a>';
      echo '<a href="characterSelect.php" class="button">Proceed to Character Select page</a>';
    } else {
      echo "<h3>Incorrect password. Please try again.</h3>";
      echo '<a href="login.php" class="button">Return to Login/Register page</a>';
    }
  } else {
    echo "<h3>No player with that username exists. Please try again or register!</h3>";    
    echo '<a href="login.php" class="button">Return to Login/Register page</a>';
  }
  
  ?>


</body>
</html>