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

$statement = $db->query('SELECT username, password FROM players WHERE username = $username');
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  if ($row['password'] == $password) {
    echo "<h2>You are logged in as ".$username."</h2>";
  }
  echo 'user: ' . $row['username'] . ' password: ' . $row['password'] . '<br/>';
}

echo '<script>console.log("end")</script>';

?>