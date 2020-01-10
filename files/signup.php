<center>
    <main>
        <div class="container">
            <section class="section-default">
                <h1>Aanmelden</h1>
                <form action="files/functions/signup.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Gebruikersnaam" style="width:50%">
                    <input type="text" name="name" placeholder="Naam" style="width:50%">
                    <input type="text" name="adr" placeholder="Adres" style="width:50%">
                    <input type="text" name="mail" placeholder="E-mail" style="width:50%">
                    <input type="Password" name="pwd" placeholder="Wachtwoord" style="width:50%">
                    <input type="password" name="pwd-repeat" placeholder="Wachtwoord herhalen" style="width:50%"><br/>
                    Geslacht:
                    <select name="geslacht">
                        <option value="man">man</option>
                        <option value="vrouw">vrouw</option>
                    </select>
                    <button type="submit" class="signupbtn" name="signup-submit">Aanmelden</button>

                </form>
            </section>
        </div>
    </main>
</center>

<?php
require "footer.php";
?>