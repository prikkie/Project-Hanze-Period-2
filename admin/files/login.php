<?php
if (isset($_POST['wachtwoord']) && isset($_POST['gebruiker'])) {
	loginAdmin(test_input($_POST['wachtwoord']), test_input($_POST['gebruiker']));
}
header("Location: /admin/home");