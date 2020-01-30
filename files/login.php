<?
include 'functions/login.php';
if (isset($_POST['wachtwoord']) && isset($_POST['gebruiker'])) {
	login(test_input($_POST['wachtwoord']), test_input($_POST['gebruiker']));
}
header("Location: /home");