<?
include 'functions/login.php';
if (isset($_POST['wachtwoord']) && isset($_POST['gebruiker'])) {
	login($_POST['wachtwoord'], $_POST['gebruiker']);
}
header("Location: /home");