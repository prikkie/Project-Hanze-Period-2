<link href="/css/menu.css" rel="stylesheet" type="text/css"/>

<div class="topnav" id="myTopnav">
    <a href="http://projecthanze.com/home" class="active">Home</a>

	<?php
	if ($_SESSION['account_id'] == true) {

		?>
		<a href="http://projecthanze.com/producten">Producten</a>
		<div class="dropdown">

			<button class="dropbtn">Welkom <?php echo $_SESSION['gebr'] ?>
				<i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
				<?php
				if ($_SESSION['recht'] == 'A' || $_SESSION['recht'] == 'M') {
					echo " <a href='http://projecthanze.com/admin/home'>Admin</a>";

				}
				?>
				<a href='http://projecthanze.com/account'>Account Wijzigen</a>
				<a href='http://projecthanze.com/orders'>Mijn Orders</a>
				<a href="http://projecthanze.com/logout">Logout</a>
			</div>

		</div>


		<?php
	} else {
		?>
        <a href="http://projecthanze.com/signup">Registreren</a>
		<?
	}
	?>

</div>



