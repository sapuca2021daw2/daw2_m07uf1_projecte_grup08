<?php

$id= $_POST["id"];
$usuari= $_POST["usuari"];
$pass= $_POST["pass"];
$nom= $_POST["nom"];
$addr= $_POST["addr"];
$mail= $_POST["mail"];
$telefon= $_POST["telefon"];
$visa= $_POST["visa"];
$rol = "client";

include("Usuari.php");
include("Client.php");

$us = new Client($id,$usuari,$pass,$rol,$nom,$addr,$mail,$telefon,$visa);

$dadesUsuari= $us->idUsuari . ","  . $us->nomUsuari . ","  . $us->contrasenya . "," . $us->rol . "," . $us->nomComplet . ","  . $us->adrCompleta . ","  . $us->correu . ","  . $us->telefon . ","  . $us->visa . "\n"  ;
$filename="/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/usuaris.txt";
$fitxer=fopen($filename,"a") or die ("No s'ha pogut crear el fitxer");
fwrite($fitxer,$dadesUsuari);
fclose($fitxer);

header('Location: /daw2_m07uf1_projecte_grup08/index.php');


?>