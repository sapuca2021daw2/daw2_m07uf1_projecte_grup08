<?php
session_start();

if (isset($_SESSION['admin'])) {
    $filename = "../fitxers/productes.txt";
    $filenameTemp = "../fitxers/productesTmp.txt";
    $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
    $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $codiProducte = $_REQUEST["q"];

        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            $dadesProducte = $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] . "," . $ob[4] . "\n";


            if ($codiProducte != $ob[0]) {
                fwrite($fitxerTemp, $dadesProducte);
            }
        }
    }
    unlink($filename);
    rename($filenameTemp, $filename);
    fclose($fitxer);
    fclose($fitxerTemp);
}
