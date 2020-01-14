<center>
    <main>
        <div class="container">
            <section class="section-default">
                <h1>Registreren</h1>
                <form action="files/functions/signup.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Gebruikersnaam" style="width:50%">
                    <input type="text" name="name" placeholder="Naam" style="width:50%">
                    <input type="text" name="adr" placeholder="Adres" style="width:50%">
                    <input type="text" name="mail" placeholder="E-mail" style="width:50%">
                    <input type="Password" name="pwd" placeholder="Wachtwoord" style="width:50%">
                    <input type="password" name="pwd-repeat" placeholder="Wachtwoord herhalen" style="width:50%"><br/>
                    <div class="select">
                        <select name="geslacht">
                            <option value="man">Man</option>
                            <option value="vrouw">Vrouw</option>
                        </select>
                    </div>
                    <div class="select">
                        <select name="department">
							<?php
							$sql = mysqli_query($conn, "SELECT id, naam FROM departments");
							while ($row = $sql->fetch_assoc()) {
								echo '<option value="' . $row['naam'] . '">' . $row['naam'] . '</option>';
							}
							?>
                        </select>
                    </div>
                    <button type="submit" class="signupbtn" name="signup-submit">Registreren</button>
                </form>
            </section>
        </div>
    </main>
</center>

<?php
require "footer.php";
?>