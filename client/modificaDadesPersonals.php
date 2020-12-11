<?php session_start();
include("../Usuari.php");
include("../Client.php");


$us = unserialize($_SESSION['client']);
$id = $_POST["id"];
$usuari = $_POST["usuari"];
$pass = $_POST["pass"];
$nom = $_POST["nom"];
$addr = $_POST["addr"];
$mail = $_POST["mail"];
$telefon = $_POST["telefon"];
$visa = $_POST["visa"];
$rol = $_POST["rol"];

$usMod = new Client($id, $usuari, $pass, $rol, $nom, $addr, $mail, $telefon, $visa);

$us->modificarUsuari($usMod);

header("Location: dadesPersonals.php");

?>