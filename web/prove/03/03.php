<?php

$prods = array
(
	array("nes","Nintendo Entertainment System (NES)","Lorem ipsum dolor sit amet...",70),
	array("nesControll","Controller (NES)","Lorem ipsum dolor sit amet...",10)
);

function display($prods) {
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
}

?>