<link href="/css/menu.css" rel="stylesheet" type="text/css"/>

<div class="topnav" id="myTopnav">
	<a href="http://projecthanze.com/admin/home" class="active">Home</a>
	<a href="http://projecthanze.com/admin/gebruikers">Gebruikers</a>

	<?php
	if ($_SESSION['logged_in'] == true && (($_SESSION['department'] == "Finance" || $_SESSION['department'] == "Logistic" || $_SESSION['department'] == "Purchase") || $_SESSION['recht'] == "A")) {
		?>
		<a href="http://projecthanze.com/admin/producten">Producten</a>
		<a href="http://projecthanze.com/admin/suppliers">Suppliers</a>

		<?php
	}
	?>

	<a href="http://projecthanze.com/admin/orders">Orders</a>
	<a href="http://projecthanze.com/admin/requests">Aanvragen</a>
	<a href="http://projecthanze.com/admin/budget">Budget</a>
	<a href="http://projecthanze.com/admin/logout">Logout</a>
</div>


