<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
</head>

<body>
<?php 
if (isset($_SESSION['admin'])) 
{
    include("../header.php");

    ?>
   
    <form action="/daw2_m07uf1_projecte_grup08/productes/afegeixProducte.php" method="POST">
        <label>Codi:</label>
        <input type="text" name="codiProducte" /><br>
        <label>Nom:</label>
        <input type="text" name="nomProducte" /><br>
        <label>Secció:</label>
        <select name="seccio">
        <option value=""></option>
            <option value="jardi">Jardí</option>
            <option value="decoracio">Decoració</option>
            <option value="menage">Parament</option>
            <option value="roba">Roba</option>
            <option value="tecnologia">Tecnologia</option>
        </select><br>
        <label>Preu:</label>
        <input type="text" name="preu" /><br>
        <label>Imatge:</label>
        <input type="file" name="imatge" accept="image/png, image/jpeg" /><br>
        <input type="submit" value="Envia">
    </form>
    <?php
}else{
    echo "No tens accés a aquesta secció";
} ?>

</body>

</html>