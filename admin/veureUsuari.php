<?php session_start();?>
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
        $usuari = $us->veureUsuari();
    }
    ?>
    <form action="/daw2_m07uf1_projecte_grup08/admin/modificaUsuari.php" method="POST">
        <label>ID:</label>
        <input type="text" name="id" value="<?php echo $usuari->idUsuari?>"/><br>
        <label>USUARI:</label>
        <input type="text" name="usuari" value="<?php echo $usuari->nomUsuari?>"/><br>
        <label>CONTRASENYA:</label>
        <input type="password" name="pass" value="<?php echo $usuari->contrasenya?>"/><br>
        <?php 
        if($usuari->nomComplet!=-1){?>
        <label>NOM:</label>
        <input type="text" name="nom" value="<?php echo $usuari->nomComplet?>"/><br>
        <label>ADREÇA:</label>
        <input type="text" name="addr" value="<?php echo $usuari->adrCompleta?>"/><br>
        <label>CORREO:</label>
        <input type="text" name="mail" value="<?php echo $usuari->correu?>"/><br>
        <label>TELÈFON:</label>
        <input type="text" name="telefon" value="<?php echo $usuari->telefon?>"/><br>
        <label>VISA:</label>
        <input type="text" name="visa" value="<?php echo $usuari->visa?>"/><br>
        <?php }
?>        <input type="text" name="rol" value="<?php echo $usuari->rol?>" hidden/><br>

        <input type="submit" name="" value="Modifica">
    </form>
    </body>
</html>

