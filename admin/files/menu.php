<link href="/css/menu.css" rel="stylesheet" type="text/css"/>

<div class="topnav" id="myTopnav">
    <a href="home" class="active">Home</a>


	<?php
	if ($_SESSION['logged_in'] == true) {
		?>
        <a href="http://projecthanze.com/admin/producten">Producten</a>
        <a href="http://projecthanze.com/admin/gebruikers">Gebruikers</a>
        <a href="http://projecthanze.com/admin/orders">Orders</a>
        <a href="http://projecthanze.com/admin/logout">Logout</a>

		<?php
	}
	?>
</div>


