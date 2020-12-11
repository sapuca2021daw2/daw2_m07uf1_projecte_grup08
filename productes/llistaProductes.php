<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php
    if (isset($_SESSION['admin']) || isset($_SESSION['client'])) {
        include("../header.php");
        $llistaProductes = $us->veureLlistaProductes();
    ?>
        <table>
            <tr>
                <th>Codi</th>
                <th>Nom</th>
                <th>Secció</th>
                <th>Preu</th>
                <th>Imatge</th>
            </tr>
            <?php
            foreach ($llistaProductes as $p) { ?>
                <tr>
                    <td><a href="/daw2_m07uf1_projecte_grup08/productes/veureProductes.php?codi=<?php echo $p->codiProducte; ?>"><?php echo $p->codiProducte; ?></td></a>
                    <td><?php echo $p->nomProducte; ?></td>
                    <td><?php echo $p->seccio; ?></td>
                    <td><?php echo $p->preu; ?></td>
                    <td><img width="100px" src="<?php echo  $p->imatge ?>" alt=""></td>
                </tr>
            <?php
            } ?>
        </table>
    <?php } ?>
</body>

</html>