<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php

    if (!isset($_SESSION['admin']) && !isset($_SESSION['client'])) { 
     
       
        ?>
        <form action="/daw2_m07uf1_projecte_grup08/creaSessio.php" method="POST">
            <label>Usuari:</label><br>
            <input type="text" id="usuari" name="usuari" value=""><br>
            <label>Contrasenya</label><br>
            <input type="password" id="password" name="password" value=""><br><br>
            <input type="submit" value="Login">
            <a href="/daw2_m07uf1_projecte_grup08/registreUsuari.html"><input type="button" value="Registra't">
            </a>
        </form>
        

    <?php } else {
        $user = unserialize($_SESSION['admin']);
        $user2 = unserialize($_SESSION['client']);
        include('header.php'); 
      ?>
        <h1>SESSIÓ DE L'USUARI <?php echo $user2->nomUsuari;?> <?php echo $user->nomUsuari;?> INICIADA</h1>
    <?php }
    ?>


</body>

</html>