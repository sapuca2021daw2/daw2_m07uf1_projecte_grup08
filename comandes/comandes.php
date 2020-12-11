<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <?php
    include("../header.php");
    include("../Producte.php");

    $llistaComandes = $us->veureComandes("comandes.txt"); ?>
    <h1>COMANDES</h1>
    <table>
        <tr>
            <th>Id Comanda</th>
            <th>Data</th>
            <th>Preu Total</th>
        </tr>
        <?php

        foreach ($llistaComandes as $comanda) {
            if ($comanda) {
        ?>
                <tr>
                    <td><a href="obreComanda.php?comanda=<?php echo $comanda->idComanda ?> "><?php echo $comanda->idComanda ?></a></td>
                    <td><?php echo $comanda->data ?></td>
                    <?php

                    foreach ($comanda->productes as $producte) {
                        foreach ($producte as $clau => $valor) {
                            $p = unserialize($clau);
                            $total += $p->preu * $valor;
                        }
                    }

                    ?>
                    <td><?php echo $total ?></td>
                </tr>
        <?php
                $total = 0;
            }
        }
        ?>
</body>

</html>