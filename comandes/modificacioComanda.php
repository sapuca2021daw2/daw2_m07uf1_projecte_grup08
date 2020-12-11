<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if(isset($_SESSION["client"])){
            include("../header.php");
            $us = unserialize($_SESSION["client"]);
            if($us->modificarComanda()){
                echo "Comanda modificada correctament";
            } 
        }
    ?>
    <br>
    <a href="comandes.php"><input type="submit" value="Torna a Comandes"></a>
    </body>
</html>