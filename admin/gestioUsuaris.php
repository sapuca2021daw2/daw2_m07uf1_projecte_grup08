<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
    <script language="javascript" src="../js/esborraUsuari.js"></script>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <?php
    if (isset($_SESSION['admin'])) {
        include("../header.php");
        $llistaUsuaris = $us->veureUsuaris();
    ?>

        <table>
            <tr>
                <th>Codi</th>
                <th>Nom</th>
                <th>Contrasenya</th>
                <th>Rol</th>
                <th>Nom Complet</th>
                <th>Adreça</th>
                <th>Correu</th>
                <th>Telèfon</th>
                <th>Visa</th>
                <th></th>
            </tr>
            <?php
            foreach ($llistaUsuaris as $u) {
                if ($u->idUsuari != "") {
            ?>
                    <tr>
                        <td><?php echo $u->idUsuari; ?></td>
                        <td><?php echo $u->nomUsuari; ?></td>
                        <td><?php echo $u->contrasenya; ?></td>
                        <td><?php echo $u->rol; ?></td>
                        <td><?php echo $u->nomComplet ?></td>
                        <td><?php echo $u->adrCompleta; ?></td>
                        <td><?php echo $u->correu; ?></td>
                        <td><?php echo $u->telefon; ?></td>
                        <td><?php echo $u->visa ?></td>
                        <td>
                            <input type="button" value="Elimina" onclick="esborraUsuari(<?php echo $u->idUsuari ?>)" />
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </table>
    <?php } ?>
</body>

</html>