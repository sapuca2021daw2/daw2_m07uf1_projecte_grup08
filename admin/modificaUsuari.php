<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php
    if (isset($_SESSION['admin'])) {
        include("../header.php");
        $usuari = $us->modificarUsuari();
    }
    ?>
    <h2>Usuari Modificat</h2>
    <label>ID:</label>
        <label><?php echo $usuari->idUsuari?></label><br>
        <label>USUARI:</label>
        <label><?php echo $usuari->nomUsuari?></label><br>
        <label>CONTRASENYA:</label>
        <label><?php echo $usuari->contrasenya?></label><br>
        <label>NOM:</label>
        <label><?php echo $usuari->nomComplet?></label><br>
        <label>ADREÇA:</label>
        <label><?php echo $usuari->adrCompleta?></label><br>
        <label>CORREO:</label>
        <label><?php echo $usuari->correu?></label><br>
        <label>TELÈFON:</label>
        <label><?php echo $usuari->telefon?></label><br>
        <label>VISA:</label>
        <label><?php echo $usuari->visa?></label><br>
</body>

</html>