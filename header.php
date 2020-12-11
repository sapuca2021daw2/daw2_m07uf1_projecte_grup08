<?php 
include("Usuari.php");
include("Client.php");
include("Admin.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .head{
            height: 50px; 
            border-bottom:1px solid;
            margin-bottom: 20px;
        }

        .sess{
            position: absolute;
            top: 25px; right: 185px; 
        }

        .btnMenu{
            margin: auto;
        padding: 10px;
           
        }

    </style>
</head>

<body>
    <?php if(isset($_SESSION['client'])){
        $us = unserialize($_SESSION["client"]);
        $user= $us->nomUsuari;?>
        <form action="../carret/veureCarret.php" method="POST">
        <input style="position: absolute; height: 30px; top: 15px; right: 85px; margin-bottom: 25px;" type="submit" value="Carret" name="carr"/>
    </form>

<!--         <a href="../comandes/veureCarret.php"><input style="position: absolute; height: 30px; top: 15px; right: 85px; margin-bottom: 25px;" type="button" value="Carret" /></a>
 --><?php
    }else if (isset($_SESSION['admin'])){
        $us = unserialize($_SESSION["admin"]);
        $user= $us->nomUsuari . " (admin)";
    }

    ?>

    <div class="head" >
        <div >
        <label class="sess">Sessió iniciada per <?php echo $user?></label>
        <a href="/daw2_m07uf1_projecte_grup08/logout.php"><input style="position: absolute; height: 30px; top: 15px; right: 15px; margin-bottom: 25px;" type="button" value="Log Out" /></a>
        </div>
        <?php
if($us instanceof Client){?>

        <div class="btnMenu">
        <a href="../../daw2_m07uf1_projecte_grup08/client/client.php"><input type="button" value="Inici"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/productes/productes.php"><input type="button" value="Productes"></a>
<!--         <a href="../../daw2_m07uf1_projecte_grup08/comandes/comandes.php"><input type="button" value="Comandes"></a>
 -->        <a href="../../daw2_m07uf1_projecte_grup08/client/areaPersonal.php"><input type="button" value="Àrea Personal"></a>
        </div>

        <?php } else { ?>

    
    
        <div class="btnMenu">
        <a href="../../daw2_m07uf1_projecte_grup08/admin/admin.php"><input type="button" value="Inici"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/productes/productes.php"><input type="button" value="Productes"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/comandes/comandes.php"><input type="button" value="Comandes"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/comandes/comandesRevisar.php"><input type="button" value="Eliminar Comandes"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/admin/gestioUsuaris.php"><input type="button" value="Usuaris"></a>
        <a href="../../daw2_m07uf1_projecte_grup08/admin/gestioUsuarisRevisar.php"><input type="button" value="Eliminar Usuaris"></a>

        </div>

    <?php } ?>
    </div>


</body>

</html>