<?php
session_start();
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

  <div class="row">
    <div class='loginColumn'>
      <div class='card'>
        <div id="login">
          <h3>Login</h3>
          <form action="login_action.php" method="post" >
            Username:<br>
            <input type="text" name="loginUsername">
            <br>
            Password:<br>
            <input type="text" name="loginPassword">
            <br><br>
            <h3>Login coming soon</h3>
            <!-- <input type="submit" value="Submit"> -->
          </form>
        </div>
      </div>
    </div>

    <div class='loginColumn'>
      <div class='card'>
        <div id="register">
          <h3>Register</h3>
          <form action="register_action.php" method="post" >
            Username:<br>
            <input type="text" name="registerUsername">
            <br>
            Password:<br>
            <input type="text" name="registerPassword">
            <br><br>
            <input type="submit" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>

  

</body>
</html>