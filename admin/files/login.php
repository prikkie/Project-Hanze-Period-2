<?php
if (isset($_POST['wachtwoord']) && isset($_POST['gebruiker'])) {
	loginAdmin($_POST['wachtwoord'], $_POST['gebruiker']);
}
header("Location: /admin/home");