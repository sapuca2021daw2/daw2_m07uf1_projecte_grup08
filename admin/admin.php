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
    if (isset($_SESSION['admin'])) {
        include("../header.php");
        $user= unserialize($_SESSION['admin']);
    ?>
        <h1>Benvingut <?php echo $user->nomUsuari  ?></h1>

    <?php

    } else {
        
        echo "No ets administrador";
    }
    ?>
</body>

</html>