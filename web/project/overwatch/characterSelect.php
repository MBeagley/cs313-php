<?php

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

  <hr/>
  <h2 align="center">Enemy Team</h2>
  <hr/>
  <div class="row">
    <div class="enemyColumn">
      <div class="card">
        <h3>Enemy 1</h3>
        <img id="enemyIcon1" src="images/1.png">
        <select id="enemy1" onchange="displayIcon('enemyIcon1', 'enemy1')">
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="enemyColumn">
      <div class="card">
        <h3>Enemy 2</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="enemyColumn">
      <div class="card">
        <h3>Enemy 3</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="enemyColumn">
      <div class="card">
        <h3>Enemy 4</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="enemyColumn">
      <div class="card">
        <h3>Enemy 5</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="enemyColumn">
      <div class="card">
        <h3>Enemy 6</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>
  </div>

  <hr/>
  <h2 align="center">Ally Team</h2>
  <hr/>
  <div class="row">
    <div class="allyColumn">
      <div class="card">
        <h3>Ally 1</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="allyColumn">
      <div class="card">
        <h3>Ally 2</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="allyColumn">
      <div class="card">
        <h3>Ally 3</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="allyColumn">
      <div class="card">
        <h3>Ally 4</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="allyColumn">
      <div class="card">
        <h3>Ally 5</h3>
        <select>
          <?php
          foreach ($db->query('SELECT * FROM characters') as $row)
          {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
          }
          ?>
        </select>
      </div>
    </div>
  </div>

  <hr/>

</body>
</html>