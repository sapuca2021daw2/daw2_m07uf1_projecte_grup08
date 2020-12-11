<?php

$usuari = $_POST["usuari"];
$password = $_POST["password"];
$usuaris = [];

include("Usuari.php");
include("Admin.php");
include("Client.php");

$filename = "fitxers/usuaris.txt";
$fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");

while (!feof($fitxer)) {
    $us = explode(",", fgets($fitxer));
    if (trim($us[3]) == "admin") {
        array_push($usuaris, new Admin($us[0], $us[1], $us[2], trim($us[3])));
    } else if (trim($us[3]) == "client") {
        array_push($usuaris, new Client($us[0], $us[1], $us[2], $us[3], $us[4], $us[5], $us[6], $us[7], trim($us[8])));
    }
}

foreach ($usuaris as $u) {
    if ($u->nomUsuari == $usuari && $u->contrasenya == $password) {

        if ($u instanceof Admin) {
            //session_name($usuari);
            session_start();
            $_SESSION['admin'] = serialize($u);
            header("Location: /daw2_m07uf1_projecte_grup08/admin/admin.php");
            exit();
        } else if ($u instanceof Client) {
            session_start();
            $_SESSION['client'] = serialize($u);
            header("Location: /daw2_m07uf1_projecte_grup08/client/client.php");
            exit();
        }
        break;
    }
} 
echo "Usuari o contrasenya incorrecte";
?>