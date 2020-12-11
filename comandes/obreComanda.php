<?php session_start();

include("../Comanda.php");
include("../Usuari.php");
include("../Client.php");
include("../Admin.php");

$llistaComandes = array();

if($_SESSION["client"]){
    $us = unserialize($_SESSION["client"]);
}else if($_SESSION["admin"]){
    $us = unserialize($_SESSION["admin"]);
}

$filename = "../fitxers/comandes.txt";
$fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");

while (!feof($fitxer)) {
    $comanda = unserialize(fgets($fitxer));
    if($us instanceof Client){
        if ($comanda->idUsuariComanda == $us->idUsuari && $_GET["comanda"] == $comanda->idComanda) {
            $_SESSION['comanda'] = array($comanda->idComanda, $comanda->productes);
        }
    }else if($_GET["comanda"] == $comanda->idComanda){
        $_SESSION['comanda'] = array($comanda->idComanda, $comanda->productes);
    }
   
}
fclose($fitxer);

$_SESSION["carret"] = false;
header("Location: ../carret/veureCarret.php");
?>