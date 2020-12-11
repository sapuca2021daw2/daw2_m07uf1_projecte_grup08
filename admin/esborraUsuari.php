<?php
session_start();

if (isset($_SESSION['admin'])) {
    $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/usuaris.txt";
    $filenameTemp = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/usuarisTmp.txt";
    $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
    $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $codiUsuari = $_REQUEST["q"];

        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));

            $dadesUsuari = $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] . "," . $ob[4] . "," . $ob[5] . "," . $ob[6] . "," . $ob[7] . "," . $ob[8];

            if ($ob[0]!="") {
                if ($codiUsuari != $ob[0]) {
                    if (trim($ob[3]) == "admin") {
                        $dadesUsuari = $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3];
                    } else if ($ob[3] == "client") {
                        $dadesUsuari = $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] . "," . $ob[4] . "," . $ob[5] . "," . $ob[6] . "," . $ob[7] . "," . $ob[8];
                    }
                    fwrite($fitxerTemp, $dadesUsuari);
                }
            }
        }
    }
unlink($filename);
rename($filenameTemp, $filename);
fclose($fitxer);
fclose($fitxerTemp);

$filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/baixes.txt";
$filenameTemp = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/baixesTmp.txt";
$fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
$fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

while (!feof($fitxer)) {
    $ob = explode(",", fgets($fitxer));

    if ($ob[0]!="") {
        if ($codiUsuari != $ob[1]) {
            if (trim($ob[3]) == "admin") {
                $dadesUsuari = $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3];
            } else if ($ob[3] == "client") {
                $dadesUsuari = $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] . "," . $ob[4] . "," . $ob[5] . "," . $ob[6] . "," . $ob[7] . "," . $ob[8];
            }
            fwrite($fitxerTemp, $dadesUsuari);
        }
    }
}

unlink($filename);
rename($filenameTemp, $filename);
fclose($fitxer);
fclose($fitxerTemp);



}
