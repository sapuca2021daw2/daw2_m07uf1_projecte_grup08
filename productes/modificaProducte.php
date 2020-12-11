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
        $pr = $us->modificaProducte();
    }
    ?>
    <h2>Producte Modificat</h2>
    <label>Codi:</label>
    <label><?php echo $pr->codiProducte ?></label><br>
    <label>Nom:</label>
    <label><?php echo $pr->nomProducte ?></label><br>
    <label>Secció:</label>
    <label><?php echo $pr->seccio ?></label><br>
    <label>Preu:</label>
    <label><?php echo $pr->preu ?></label><br>
    <label>Imatge:</label><br>
    <img width="250px" src="<?php echo $pr->imatge ?>" alt=""><br>
    </body>
</html>

