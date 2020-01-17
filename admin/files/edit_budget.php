<?php
if (isset($_GET['sid']) && $_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || ['recht'] == "M") {
	$sid = $_GET['sid'];

	$query = "SELECT * FROM  departments where id = $sid";

	if ($result = $conn->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$budget = $row["budget"];


			?>
            <section class="section-default">
                <h2>Budget wijzigen</h2>
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>Budget</td>
                            <td><input type="text" value="<?php echo $budget; ?>" name="budget"</td>
                        </tr>
                        <tr>
                            <td>Toevoegen</td>
                            <td>
                                <button type="submit" name="aanpassen">Aanpassen!</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </section>
			<?php
		}
		$result->free();
	}
	?>
    </table>
	<?php
} else {
	header("Location: http://projecthanze.com/admin/home");
} ?>

<?php
$budget = $_POST['budget'];

if (isset($_POST['aanpassen'])) {
	$query = "UPDATE departments SET budget = '$budget' WHERE id = '$sid'";
	$conn->query($query);
	header("Location: /admin/budget");
}
?>