<?php

$prods = array
  (
    array("nes","Nintendo Entertainment System (NES)","Lorem ipsum dolor sit amet...",70),
    array("nesControll","Controller (NES)","Lorem ipsum dolor sit amet...",10),
    array("excitebike","Excitebike (NES)","Lorem ipsum dolor sit amet...",15),
    array("snes","Super Nintendo Entertainment System (SNES)","Lorem ipsum dolor sit amet...",80),
    array("snesControll","Controller (SNES)","Lorem ipsum dolor sit amet...",20),
    array("donkeykong","Donkey Kong Country (SNES)","Lorem ipsum dolor sit amet...",20),
    array("n64","Nintendo 64 (N64)","Lorem ipsum dolor sit amet...",90),
    array("n64Controll","Controller (N64)","Lorem ipsum dolor sit amet...",15),
    array("mario","Super Mario 64 (N64)","Lorem ipsum dolor sit amet...",30),
    array("psx","Sony PlayStation (PSX)","Lorem ipsum dolor sit amet...",75),
    array("psxControll","Controller (PSX)","Lorem ipsum dolor sit amet...",12),
    array("parappa","PaRappa the Rapper (PSX)","Lorem ipsum dolor sit amet...",120)
  );

function display($prods) {
	for ($x = 0; $x < count($prods); $x++) {
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
}

?>