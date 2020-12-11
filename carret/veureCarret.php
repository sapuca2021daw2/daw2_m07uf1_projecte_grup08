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
        include("../Producte.php");
        include("../header.php");
        $totalProductes = 0;
        $totalPreu = 0;
        if (isset($_POST["carr"])) {
            $_SESSION["carret"] = true;
        };
        
    ?>

        <table class="comanda">
            <tr>
                <th>Nom</th>
                <th>Preu Unitari</th>
                <th>Quantitat</th>
                <th>Preu Total</th>
            </tr>
            <?php
            if ($_SESSION["carret"]) {
                echo "<h1>CARRET</h1>";
                $llistaProductes = $_SESSION["productes"];
            } else {
                echo "<h1>Comanda nº" .  $_SESSION['comanda'][0] . "</h1>";
                $llistaProductes = $_SESSION["comanda"][1];
            }

            if(!empty($llistaProductes)){
            foreach ($llistaProductes as $producte) {
            ?>
                <tr>
                    <?php
                    foreach ($producte as $clau => $valor) {
                        $p = unserialize($clau);
                    ?>
                        <td><?php echo $p->nomProducte ?></td>
                        <td><?php echo $p->preu ?></td>
                        <td><?php echo $valor ?></td>
                        <td><?php echo $p->preu * $valor ?></td>
                    <?php
                        $totalPreu += $p->preu * $valor;
                        $totalProductes += $valor;
                    }
                    ?>
                </tr>
            <?php }} ?>
            <tr>
                <td colspan="2"></td>
                <td>Total Productes: <?php echo $totalProductes ?> </td>
                <td>Total: <?php echo $totalPreu ?></td>
            </tr>
        </table>
        <?php
        if ($_SESSION['carret']&&!empty($llistaProductes)) {
        ?>
            <a href="../productes/productes.php"><input type="submit" value="Afegeix Productes"></a>
            <a href="../comandes/creaComanda.php"><input type="submit" value="Finalitza Compra"></a>
            <a href="esborraCarret.php"><input type="submit" value="Esborra Carret"></a>
    <?php }
    if(!$_SESSION['carret']&& $us instanceof Client){ ?>
        <a href="../comandes/modificaComanda.php"><input type="submit" value="Modifica Comanda"></a>
        <a href="../comandes/eliminaComanda.php"><input type="submit" value="Elimina Comanda"></a>
<?php
    }
        //$_SESSION["carret"]=true;
    } ?>
</body>

</html>