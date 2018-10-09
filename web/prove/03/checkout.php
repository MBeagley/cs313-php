<?php
session_start();

if (empty($_SESSION['count'])) {
  $_SESSION['count'] = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Chakra+Petch" rel="stylesheet">
  <script src="browse.js"></script>
  <title>RetroRama</title>
</head>
<body>

  <div class="header">
    <h1>RetroRama</h1>
    <p>For all your classic gaming needs.</p>
  </div>

  <div class="navbar" id="navbar">
    <a href="browse.php">Products</a>
    <a class="active" href="#checkout">Checkout</a>
    <div class="navbar-right">
      <?php
      echo "<a id='cart' href='cart.php'>Cart(".$_SESSION['count'].")</a>";
      ?>
    </div>
  </div>

  <div>
    <h2>Please enter shipping address</h2>
  </div>

  <div class="form">
    <form action="confirm.php" method="post">
      First name:<br>
      <input type="text" name="firstname">
      <br>
      Last name:<br>
      <input type="text" name="lastname">
      <br>
      Address:<br>
      <input type="text" name="address">
      <br>
      City:<br>
      <input type="text" name="city">
      <br>
      State:<br>
      <input type="text" name="state">
      <br>
      Zip Code:<br>
      <input type="text" name="zip">
      <br>
      <input type="submit" value="Submit">
    </form>
  </div>

</body>
</html>
