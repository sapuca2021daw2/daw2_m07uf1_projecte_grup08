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

    <form action="modificaDadesPersonals.php" method="POST">
        <label>ID:</label>
        <input type="text" readonly name="id" value="<?php echo $us->idUsuari ?>"/><br>
        <label>USUARI:</label>
        <input type="text" name="usuari" value="<?php echo $us->nomUsuari ?>"/><br>
        <label>CONTRASENYA:</label>
        <input type="password" name="pass" value="<?php echo $us->contrasenya ?>"/><br>
        <label>NOM:</label>
        <input type="text" name="nom" value="<?php echo $us->nomComplet ?>"/><br>
        <label>ADREÇA:</label>
        <input type="text" name="addr" value="<?php echo $us->adrCompleta ?>"/><br>
        <label>CORREO:</label>
        <input type="text" name="mail" value="<?php echo $us->correu ?>"/><br>
        <label>TELÈFON:</label>
        <input type="text" name="telefon" value="<?php echo $us->telefon ?>"/><br>
        <label>VISA:</label>
        <input type="text" name="visa" value="<?php echo $us->visa ?>"/><br>
        <input type="text" hidden name="rol" value="<?php echo $us->rol ?>"/><br>
        <input type="submit" name="" value="Modifica">
        <a href="solicitaBaixa.php"><input type=button value="Baixa Usuari"></a>
    </form>
<?php }
?>
</body>

</html>