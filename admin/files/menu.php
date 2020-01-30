<link href="/css/menu.css" rel="stylesheet" type="text/css"/>

<div class="topnav" id="myTopnav">
	<a href="http://projecthanze.com/admin/home" class="active">Home</a>
	<?php
	if ($_SESSION['logged_in'] == true && ($_SESSION["recht"] == "M" || $_SESSION["recht"] == "A")) {
		?>
		<a href="http://projecthanze.com/admin/gebruikers">Gebruikers</a>
		<a href="http://projecthanze.com/admin/orders">Orders</a>

		<?php
		if (($_SESSION['department'] == "Finance" || $_SESSION['department'] == "Logistic" || $_SESSION['department'] == "Purchase") || $_SESSION['recht'] == "A") {
			?>
			<a href="http://projecthanze.com/admin/producten">Producten</a>
			<a href="http://projecthanze.com/admin/suppliers">Suppliers</a>

			<?php
			if ($_SESSION["department"] == "Finance" || $_SESSION["recht"] == "A") {
				echo '	<a href="http://projecthanze.com/admin/financieel">Financieel</a>';
			}
			if ($_SESSION["department"] == "Purchase" || $_SESSION["recht"] == "A") {
				echo '	<a href="http://projecthanze.com/admin/klacht_overzicht">Klachten</a>';
			}
			if ($_SESSION["department"] == "Logistic" || $_SESSION["recht"] == "A") {
				echo '	<a href="http://projecthanze.com/admin/logistiek">Logistiek</a>';
			}
		}
		?>


		<a href="http://projecthanze.com/admin/requests">Aanvragen</a>
		<a href="http://projecthanze.com/admin/budget">Budget</a>
		<a href="http://projecthanze.com/admin/logout">Logout</a>
		<?
	}
	?>
</div>


