<?php
session_start();
require 'files/includes/db_connect.php';

$cart_products = initCart($conn);

//Kijkt welke pagina opgevraagd is, kijkt of het bestaat, veranderd $pagina. Bestaat deze niet? Gaat de gebruiker naar de home pagina
if (isset($_GET['nav']) && file_exists('files/' . $_GET['nav'] . '.php')) {
	$pagina = $_GET['nav'];
} else {
	header("Location: http://projecthanze.com/home");
}


if ($pagina != "home") {
	echo "<div id='menu'>";
	include 'files/menu.php';

	echo "</div>";
}
?>
    <div id="body">
	    <?php
		// Als $pagina niet geinitialiseerd is, gaat hij tergu naar home. Anders geeft hij de $pagina weer.
		if (empty($pagina)) {
			header("Location: http://projecthanze.com/home");
		} else {
			include("files/" . $pagina . ".php");
		}
		?>
    </div>
<?php


?>