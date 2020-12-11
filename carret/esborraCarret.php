<?php session_start();
include("../Usuari.php");
include("../Client.php");

$us=unserialize($_SESSION['client']);

$us->esborrarCarret();

header("Location: veureCarret.php");


?>
