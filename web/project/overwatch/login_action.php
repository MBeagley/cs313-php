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

$stmt = $db->prepare('SELECT * FROM players WHERE username=:username');
$stmt->execute(array(':username' => $_POST['username']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($rows[0]['password'] == $_POST['password']) {
  echo "<h1>Logged in as".$_POST['username']."</h1>";
}
else {
  echo "<h1>Login Error</h1>"
}

?>