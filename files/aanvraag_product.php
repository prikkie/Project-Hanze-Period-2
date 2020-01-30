<div id="product-aanvragen">
	<center>
		<h2>Product aanvragen</h2>
		<form action="verwerk_product" method="post">
			<table>
				<tr>
					<td>Jouw department:</td>
					<td><input type="text" disabled value="<?php echo $_SESSION['department'] ?>"></td>

				</tr>
				<tr>
					<td>Product-naam</td>
					<td><input type="text" required name="n_naam"</td>
				</tr>
				<tr>
					<td>Omschrijving</td>
					<td><input type="text" required name="n_omschrijving"</td>
				</tr>
                <tr>
                    <td>Link</td>
                    <td><input type="text" required name="n_link"></td>
                </tr>
                <tr>
                    <td>Reden Aanvraag</td>
                    <td><input type="text" required name="n_reden"></td>
                </tr>
                <input type="hidden" name="n_auth" value="nee">
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" required name="aanvragen">Aanvragen!</button>
                    </td>
                </tr>
            </table>
        </form>
</div>