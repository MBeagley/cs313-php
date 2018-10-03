<?php
session_start();
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
  <?php

  $prods = array
  (
    array("nes","Nintendo Entertainment System (NES)","Lorem ipsum dolor sit amet...",70),
    array("nesControll","Controller (NES)","Lorem ipsum dolor sit amet...",10)
  );
  ?>

  <div class="header">
    <h1>RetroRama</h1>
    <p>For all your classic gaming needs.</p>
  </div>

  <div class="navbar" id="navbar">
    <a class="active" href="#home">Products</a>
    <a href="checkout.html">Checkout</a>
    <div class="navbar-right">
      <a id="cart" href="cart.html">Cart(0)</a>
    </div>
  </div>

  <div>
    <ul>
      <li>
        <?php
        for ($x = 0; $x <= count($prods); $x++) {
          echo "<li>";
          echo "<img src='images/".$prods[$x][0].".jpg' />";
          echo "<h2>".$prods[$x][1]."</h2>";
          echo "<p>.".$prods[$x][2]."</p>";
          echo "<h3>$".$prods[$x][3]."</h3>";
          echo "<p>";
          echo "<input id='".$prods[$x][0]."' type='number' name='quantity' min='1' max='10' value='1'>";
          echo "<button type='button' onclick='addItem(document.getElementById('".$prods[$x][0]."').value)'>Add to Cart</button>";
          echo "</p>";
          echo "</li>";
        }
        ?>
        <!-- <img src="images/nes.jpg" />
        <h2>Nintendo Entertainment System (NES)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$70</h3>
        <p>
          <input id="nes" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('nes').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/nesControll.jpg" />
        <h2>Controller (NES)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$10</h3>
        <p>
          <input id="nesControll" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('nesControll').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/excitebike.jpg" />
        <h2>Excitebike (NES)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$15</h3>
        <p>
          <input id="excitebike" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('excitebike').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/snes.jpg" />
        <h2>Super Nintendo Entertainment System (SNES)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$80</h3>
        <p>
          <input id="snes" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('snes').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/snesControll.jpg" />
        <h2>Controller (SNES)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$20</h3>
        <p>
          <input id="snesControll" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('snesControll').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/donkeykong.jpg" />
        <h2>Donkey Kong Country (SNES)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$20</h3>
        <p>
          <input id="donkeykong" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('donkeykong').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/n64.jpg" />
        <h2>Nintendo 64 (N64)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$90</h3>
        <p>
          <input id="n64" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('n64').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/n64Controll.jpg" />
        <h2>Controller (N64)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$15</h3>
        <p>
          <input id="n64Controll" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('n64Controll').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/mario.jpg" />
        <h2>Super Mario 64 (N64)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$30</h3>
        <p>
          <input id="mario" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('mario').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/psx.jpg" />
        <h2>Sony PlayStation (PSX)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$75</h3>
        <p>
          <input id="psx" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('psx').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/psxControll.jpg" />
        <h2>Controller (PSX)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$12</h3>
        <p>
          <input id="psxControll" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('psxControll').value)">Add to Cart</button>
        </p>
      </li>

      <li>
        <img src="images/parappa.jpg" />
        <h2>PaRappa the Rapper (PSX)</h2>
        <p>Lorem ipsum dolor sit amet...</p>
        <h3>$120</h3>
        <p>
          <input id="parappa" type="number" name="quantity" min="1" max="10" value="1">
          <button type="button" onclick="addItem(document.getElementById('parappa').value)">Add to Cart</button>
        </p>
      </li> -->
    </ul>
  </div>

</body>
</html>
