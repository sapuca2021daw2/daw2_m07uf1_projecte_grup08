<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productes</title>
    <script language="javascript" src="../js/esborraProducte.js"></script>
    <style>
        .la{
            display: inline-block;
  width: 100px;
  text-align: left;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['admin']) || isset($_SESSION['client'])) {
        include("../header.php");
        $pr = $us->veureDetallProducte();
        if (isset($_SESSION['admin'])) {
    ?>
            <form id="esbPr" action="/daw2_m07uf1_projecte_grup08/productes/modificaProducte.php" method="PUT">
                <label>Codi:</label>
                <input type="text" name="codiProducte" value="<?php echo $pr->codiProducte ?>" readonly /><br>
                <label>Nom:</label>
                <input type="text" name="nomProducte" value="<?php echo $pr->nomProducte ?>" /><br>
                <label>Secció:</label>
                <select name="seccio">
                    <option value=""></option>
                    <option value="jardi" <?= $pr->seccio == "jardi" ? 'selected' : ''; ?>>Jardí</option>
                    <option value="decoracio" <?= ($pr->seccio == 'decoracio') ? 'selected' : ''; ?>>Decoració</option>
                    <option value="menage" <?= ($pr->seccio == 'menage') ? 'selected' : ''; ?>>Parament</option>
                    <option value="roba" <?= ($pr->seccio == 'roba') ? 'selected' : ''; ?>>Roba</option>
                    <option value="tecnologia" <?= ($pr->seccio == 'tecnologia') ? 'selected' : ''; ?>>Tecnologia</option>
                </select><br>
                <label>Preu:</label>
                <input type="text" name="preu" value="<?php echo $pr->preu ?>" /><br>
                <label>Imatge:</label><br>
                <img width="100px" src="<?php echo  $pr->imatge ?>" alt=""><br>
                <input type="text" name="imatgeAnterior" value="<?php echo $pr->imatge ?>" hidden />
                <input type="file" name="imatge" accept="image/png, image/jpeg" value="lool" /><br>
                <input type="submit" value="Modifica">
                <input type="button" value="Elimina" onclick="esborraProducte(<?php echo $pr->codiProducte ?>)">
            </form>
        <?php
        } else { ?>
            <div >
                <div style="float: left;  width:200px; margin-top:50px; font-size:24px">
                    <label class="la">Codi:</label>
                    <label><?php echo $pr->codiProducte ?></label><br>
                    <label class="la">Nom:</label>
                    <label><?php echo $pr->nomProducte ?></label><br>
                    <label class="la">Secció:</label>
                    <label><?php echo $pr->seccio ?></label><br>
                    <label class="la">Preu:</label>
                    <label><?php echo $pr->preu ?></label><br>
                    
                </div>
                <div >
                    <img width="250px" src="<?php echo $pr->imatge ?>" alt=""><br>
                </div>
                <div>
                    <form action="../carret/creaCarret.php" method="POST">
                        <input type="text" name="producte" value="<?php echo $pr->codiProducte ?>" hidden />
                        <input type="number" name="quantitat" min="1" max="5" value="1" />
                        <input type="submit" value="Afegeix">

                    </form>
                </div>
            </div>
    <?php
        }
    }
    ?>
</body>

</html>