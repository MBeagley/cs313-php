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

  <button type="button" onclick="toggleHidden('login')">Login</button>
  <button type="button" onclick="toggleHidden('register')">Register</button>

  <div id="login">
    <form action="/action_page.php">
      Username:<br>
      <input type="text" name="username">
      <br>
      Password:<br>
      <input type="text" name="password">
      <br><br>
      <input type="submit" value="Submit">
    </form>
  </div>

  <div id="register">
    <form action="/action_page.php">
      Username:<br>
      <input type="text" name="username">
      <br>
      Password:<br>
      <input type="text" name="password">
      <br><br>
      <input type="submit" value="Submit">
    </form>
  </div>

</body>
</html>