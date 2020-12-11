<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION["client"])) {
        include("../header.php");

       if($us->eliminaUsuari($us)){
           echo "Sol·licitud de baixa enviada correctament";
       }
    }
    ?>

</body>

</html>