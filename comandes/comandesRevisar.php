<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <script language="javascript" src="../js/esborraComanda.js"></script>
</head>

<body>
    <?php
    include("../header.php");
    include("../Producte.php");


    $llistaComandes = $us->veureComandesEliminar("comandesEliminar.txt");

    ?>
    <h1>COMANDES PER ELIMINAR</h1>
    <table>
        <tr>
            <th>Id Comanda</th>
            <th>Id Usuari</th>
            <th>Data Comanda</th>
            <th>Data Sol·licitud</th>
            <th></th>

        </tr>
        <?php

        if (!empty($llistaComandes)) {
            foreach ($llistaComandes as $dat=>$com) {
                $comanda = unserialize($com); ?>
                <tr>
                    <td><?php echo $comanda->idComanda ?></td>
                    <td><?php echo $comanda->idUsuariComanda ?></td>
                    <td><?php echo $comanda->data ?></td>
                    <td><?php echo $dat ?></td>
                    <td>
                        <input type="button" value="Elimina" onclick="esborraComanda(<?php echo $comanda->idComanda ?>)" />
                    </td>
                </tr>
        <?php
            }
        }
        ?>
</body>

</html>