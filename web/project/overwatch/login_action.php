<?php
session_start();

echo '<script>console.log("start")</script>';

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

echo '<script>console.log("db connect")</script>';

$statement = $db->query("SELECT * FROM 'players' WHERE 'username' = '" .mysql_escape_string($_POST['username']). "';");
echo '<script>console.log("made statement")</script>';
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo '<script>console.log("in while loop")</script>';
  if ($row['password'] == $password) {
    echo "<h2>You are logged in as ".$username."</h2>";
  } else {
    echo "<h2>Login error</h2>";
  }
  echo '<script>console.log("end while loop")</script>';
}

echo '<script>console.log("end")</script>';

?>