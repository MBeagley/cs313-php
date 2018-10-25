<?php
session_start();
echo "<script>console.log('start');</script>";


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
echo "<script>console.log('db connect');</script>";

$stmt = $db->prepare('SELECT * FROM players WHERE username=:username');
$stmt->execute(array(':username' => $_POST['loginUsername']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<script>console.log('statment made');</script>";
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
  <title>Overwatch Character Picker</title>
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
  if ($rows[0]['password'] == $_POST['loginPassword']) {
    echo "<h1>Logged in as".$_POST['loginUsername']."</h1>";
  }
  else {
    echo "<h1>Login Error</h1>"
  }
  ?>
  

</body>
</html>