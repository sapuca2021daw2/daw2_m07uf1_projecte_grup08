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
        $llistaUsuaris = $us->veureUsuarisRevisar();
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
                <th>Data Petició</th>
                <th></th>
            </tr>
            <?php
            foreach ($llistaUsuaris as $u) {
                foreach($u as $clau=>$valor){
                if ($valor->idUsuari != "") {
            ?>
                    <tr>
                        <td><?php echo $valor->idUsuari; ?></td>
                        <td><?php echo $valor->nomUsuari; ?></td>
                        <td><?php echo $valor->contrasenya; ?></td>
                        <td><?php echo $valor->rol; ?></td>
                        <td><?php echo $valor->nomComplet ?></td>
                        <td><?php echo $valor->adrCompleta; ?></td>
                        <td><?php echo $valor->correu; ?></td>
                        <td><?php echo $valor->telefon; ?></td>
                        <td><?php echo $valor->visa ?></td>
                        <td><?php echo $clau ?></td>

                        <td>
                            <input type="button" value="Elimina" onclick="esborraUsuari(<?php echo $valor->idUsuari ?>)" />
                        </td>
                    </tr>
            <?php
                }
            } }?>
        </table>
    <?php } ?>
</body>

</html>