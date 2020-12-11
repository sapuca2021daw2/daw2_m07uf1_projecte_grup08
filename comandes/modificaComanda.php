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
    if (isset($_SESSION['client'])) {
        include("../header.php");
        include("../Producte.php");
        echo "<h1>Comanda nº" .  $_SESSION['comanda'][0] . "</h1>";
        $llistaProductes = $_SESSION["comanda"][1];
    ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Preu Unitari</th>
                <th>Quantitat</th>
            </tr>

            <?php
            if (!empty($llistaProductes)) {
                $x = 1;
            ?>

                <form action="modificacioComanda.php" method="POST">
                    <?php
                    foreach ($llistaProductes as $producte) {
                    ?>
                        <tr>
                            <?php
                            foreach ($producte as $clau => $valor) {
                                $p = unserialize($clau);
                            ?>
                                <input readonly type="text" name="codi<?php echo $x ?>" value="<?php echo $p->codiProducte ?>"></td>
                                <td><?php echo $p->nomProducte ?></td>
                                <td><?php echo $p->preu ?></td>
                                <td><input type="number" name="quantitat<?php echo $x ?>" min="0" max="5" value="<?php echo $valor ?>"></td>
                            <?php
                            } ?>
                        </tr>
                    <?php
                        $x++;
                    } ?>
                     </table>
                    <input type="submit" value="Modifica">

                </form><?php
                    }
                        ?>
       
    <?php
    }
    ?>
</body>

</html>