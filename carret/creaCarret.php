<?php session_start(); 
include("../Usuari.php");
include("../Client.php");
include("../Admin.php");

if (isset($_SESSION['admin']) || isset($_SESSION['client'])) {
    $us = unserialize($_SESSION["client"]);
    $us->creacioCarret();
    header("Location: veureCarret.php");
}
?>