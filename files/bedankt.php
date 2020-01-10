<?php
echo '<h2 style="text-align:center;">Bedankt voor je bestelling ' . $_SESSION['gebr'] . "!</h2>";
echo "<br/>";
echo "<h3 style='text-align: center;'>Je bestelling is bevestigd en zal zo snel mogelijk klaar gemaakt worden. Houd je mail in de gaten voor de bevestigingsmail, hiermee kun je je bestelling ophalen.</h3>";
echo "<h4 style='text-align: center'>";
echo "Je kunt je bestelling afhalen bij de kantine in " . $_SESSION['afhaal'] . "!";
echo "</h4>";