<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
</head>

<body>
    <?php
    if (isset($_SESSION['admin'])||isset($_SESSION['client'])) { 
        include("../header.php");
        ?>
        <h1>PRODUCTES</h1>
        <form action="/daw2_m07uf1_projecte_grup08/productes/llistaProductes.php" method="GET">
            <label>Secció:</label>
            <select name="seccio">
                <option value=""></option>
                <option value="jardi">Jardí</option>
                <option value="decoracio">Decoració</option>
                <option value="menage">Parament</option>
                <option value="roba">Roba</option>
                <option value="tecnologia">Tecnologia</option>
            </select>
            <input type="submit" value="Veure Producte" />
        </form>
        <?php
        if (isset($_SESSION['admin'])){?>

<a href="../productes/nouProducte.php"><input type="button" value="Afegeix Productes"></a>

        

    <?php }} else {
        echo "No ets un usuari registrat";
    } ?>

</body>

</html>