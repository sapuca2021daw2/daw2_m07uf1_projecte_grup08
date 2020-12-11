<?php session_start();

include("../Comanda.php");

if (isset($_SESSION['admin'])) {
    $filename = "../fitxers/comandes.txt";
    $filenameTemp = "../fitxers/comandesTmp.txt";
    $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
    $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $codiComanda = $_REQUEST["q"];

        while (!feof($fitxer)) {
            $comanda = unserialize(fgets($fitxer));
            if ($codiComanda != $comanda->idComanda && $comanda->idComanda != "") {
                fwrite($fitxerTemp, serialize($comanda) . "\n");
            }
        }

        unlink($filename);
        rename($filenameTemp, $filename);
        fclose($fitxer);
        fclose($fitxerTemp);

        $filename = "../fitxers/comandesEliminar.txt";
        $filenameTemp = "../fitxers/comandesEliminarTmp.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");


        while (!feof($fitxer)) {
            $com = explode(",", fgets($fitxer));
            if (trim($com[1]) != $codiComanda && trim($com[1] != "")) {
                fwrite($fitxerTemp, $com[0] . "," . $com[1]);
            }
        }

        unlink($filename);
        rename($filenameTemp, $filename);
        fclose($fitxer);
        fclose($fitxerTemp);
    }
}
