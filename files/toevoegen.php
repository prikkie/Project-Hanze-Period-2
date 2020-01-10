<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Record Form</title>
</head>
<body>
<form action="functions/table_insert.php" method="post">
    <p>
        <label for="naam">Naam product:</label>
        <input type="text" name="naam" id="naam">
    </p>
    <p>
        <label for="prijs">Prijs in euro's:</label>
        <input type="text" name="prijs" id="prijs">
    </p>
    <p>
        <label for="omschrijving">Omschrijving:</label>
        <input type="text" name="omschrijving" id="omschrijving">
    </p>
    <p>
        <label for="voorraad">Startvoorraad:</label>
        <input type="text" name="voorraad" id="voorraad">
    </p>
    <p>
        <label for="categorie">Categorie:</label>
        <input type="text" name="categorie" id="categorie">
    </p>
    <p>
        <label for="categorie">Actief? (0/1):</label>
        <input type="text" name="actief" id="actief">
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>