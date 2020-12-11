<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    if (isset($_SESSION['client'])) {
        include("../header.php");
    ?>
        <h1>ÀREA PERSONAL</h1>
        <a href="/daw2_m07uf1_projecte_grup08/client/dadesPersonals.php"><input type="button" value="Les meves dades"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/comandes/comandes.php"><input type="button" value="Comandes"></a>
    <?php
    } else {
        echo "No ets usuari registrat";
    }
    ?>
    <br>
    <br>
</body>

</html>