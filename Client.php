<?php
include("iClient.php");

class Client extends Usuari implements iClient
{

    private $nomComplet = "";
    private $adrCompleta = "";
    private $correu = "";
    private $telefon = 0;
    private $visa = 0;

    public function __construct($idUsuari, $nomUsuari, $contrasenya, $rol, $nomComplet, $adrCompleta, $correu, $telefon, $visa)
    {
        $this->idUsuari = $idUsuari;
        $this->nomUsuari = $nomUsuari;
        $this->contrasenya = $contrasenya;
        $this->rol = $rol;
        $this->nomComplet = $nomComplet;
        $this->adrCompleta = $adrCompleta;
        $this->correu = $correu;
        $this->telefon = $telefon;
        $this->visa = $visa;
    }

    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
        return -1;
    }

    public function __set($prop, $valor)
    {
        if (property_exists($this, $prop)) {
            $this->$prop = $valor;
        }
    }

    public function __toString()
    {
        return $this->idUsuari . "," . $this->nomUsuari . "," . $this->contrasenya . "," . $this->rol . "," . $this->nomComplet . "," . $this->adrCompleta . "," . $this->correu . "," . $this->telefon . "," . $this->visa . "\n";
    }

    function veureComandes($fit)
    {
        include("../Comanda.php");
        $us = unserialize($_SESSION["client"]);
        $llistaComandes = array();
        $filename = "../fitxers/" . $fit;
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        while (!feof($fitxer)) {
            $comanda = unserialize(fgets($fitxer));

            if ($comanda->idUsuariComanda == $us->idUsuari) {
                array_push($llistaComandes, $comanda);
            }
        }
        fclose($fitxer);
        return $llistaComandes;
    }

    function esborrarComanda($comanda)
    {
        try {
            $filename = "../fitxers/comandesEliminar.txt";
            $fitxer = fopen($filename, "a") or die("No s'ha pogut crear el fitxer");
            date_default_timezone_set('Europe/Andorra');
            fwrite($fitxer, date('d/m/Y H:i:s') . "," . $comanda . "\n");
            fclose($fitxer);
            return true;
        } catch (Exception $e) {
            echo 'Alguna cosa ha fallat: ',  $e->getMessage(), "\n";
            return false;
        }
    }

    function esborrarCarret()
    {
        unset($_SESSION["productes"]);
    }

    function modificarComanda()
    {

        include("Producte.php");
        include("Comanda.php");
        $us = unserialize($_SESSION['client']);
        $numComanda = $_SESSION['comanda'][0];
        $productes = array();
        $codi = array();
        $quantitat = array();
        $prod = array();
        $x = 0;

        foreach ($_POST as $key => $value) {
            
                if (substr($key, 0, 3) == "cod") {
                    array_push($codi, $value);
                } else {
                    array_push($quantitat, $value);
                }
            
        }

        foreach ($codi as $c) {
            array_push($productes, array($c => $quantitat[$x]));
            $x++;
        }

        try {
           
            date_default_timezone_set('Europe/Andorra');
            foreach ($productes as $producte) {
                foreach ($producte as $clau => $valor) {
                    if ($valor != 0) {
                        $pr = $this->buscaProductes($clau);
                        $p = serialize($pr);
                        array_push($prod, array($p => $valor));
                    }
                }
            }

            $comanda = new Comanda($numComanda, date("d-M-Y H:m:s"), $us->idUsuari, $prod);
            $filename = "../fitxers/comandes.txt";
            $filenameTemp = "../fitxers/comandesTmp.txt";
            $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
            $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

            while (!feof($fitxer)) {
                $pl = unserialize(fgets($fitxer));
                if (!empty($pl)) {
                    if ($pl->idComanda == $comanda->idComanda) {
                        if(!empty($prod)){
                        fwrite($fitxerTemp, serialize($comanda) . "\n");
                        }
                    } else {
                        fwrite($fitxerTemp, serialize($pl) . "\n");
                    }
                }
            }

            unlink($filename);
            rename($filenameTemp, $filename);
            fclose($fitxer);
            fclose($fitxerTemp);
            return true;
        } catch (Exception $e) {
            echo 'Alguna cosa ha fallat: ',  $e->getMessage(), "\n";
            return false;
        }
    }

    function modificarUsuari($usMod)
    {
        try {
            $filename = "../fitxers/usuaris.txt";
            $filenameTemp = "../fitxers/usuarisTmp.txt";
            $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
            $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

            while (!feof($fitxer)) {

                $ob = explode(",", fgets($fitxer));
                if ($ob[0] == $usMod->idUsuari) {
                    fwrite($fitxerTemp, $usMod);
                    $_SESSION["client"] = serialize($usMod);
                } else {
                    fwrite($fitxerTemp, implode(",", $ob));
                }
            }
            unlink($filename);
            rename($filenameTemp, $filename);
            fclose($fitxer);
            fclose($fitxerTemp);
        } catch (Exception $e) {
            echo 'Alguna cosa ha fallat: ',  $e->getMessage(), "\n";
        }
    }

    function eliminaUsuari($usuari)
    {

        try {
            $filename = "../fitxers/baixes.txt";
            $fitxer = fopen($filename, "a") or die("No s'ha pogut crear el fitxer");
            date_default_timezone_set('Europe/Andorra');
            fwrite($fitxer, date('d/m/Y H:i:s') . "," . $usuari);
            fclose($fitxer);
            return true;
        } catch (Exception $e) {
            echo 'Alguna cosa ha fallat: ',  $e->getMessage(), "\n";
            return false;
        }
    }

    public function creacioComanda()
    {
        include("../Comanda.php");

        try {
            date_default_timezone_set('Europe/Andorra');
            $numComanda = rand(1, 100000);
            $us = unserialize($_SESSION['client']);

            if (isset($_SESSION["productes"])) {
                $comanda = new Comanda($numComanda, date("d-M-Y H:m:s"), $us->idUsuari, $_SESSION["productes"]);
                $c = serialize($comanda);

                $filename = "../fitxers/comandes.txt";
                $fitxer = fopen($filename, "a") or die("No s'ha pogut crear el fitxer");

                fwrite($fitxer, $c . "\n");
                fclose($fitxer);

                unset($_SESSION["productes"]);
                return true;
            }
        } catch (Exception $e) {
            echo 'Alguna cosa ha fallat: ',  $e->getMessage(), "\n";
            return false;
        }
    }

    public function creacioCarret()
    {
        include("../Producte.php");
        $producte = $_POST["producte"];
        $quantitat = $_POST["quantitat"];

        $pr = $this->buscaProductes($producte);
        $p = serialize($pr);
        if (isset($_SESSION["productes"])) {
            array_push($_SESSION["productes"], array($p => $quantitat));
        } else {
            $_SESSION["productes"] = array();
            array_push($_SESSION["productes"], array($p => $quantitat));
        }
        $_SESSION["carret"] = true;
    }


    /* function veureUsuari() //NO CAL PERQUÈ AGAFA LES DADES DE LA VARIABLE $_SESSION
    {

        $usuari = $_GET["usuari"];
        $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/usuaris.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");

        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            if ($ob[0] == $usuari) {
                if (trim($ob[3]) == "admin") {
                    $us = new Admin($ob[0], $ob[1], $ob[2], $ob[3]);
                } else if ($ob[3] == "client") {
                    $us = new Client($ob[0], $ob[1], $ob[2], $ob[3], $ob[4], $ob[5], $ob[6], $ob[7], $ob[8]);
                }
                break;
            }
        }

        fclose($fitxer);
        return $us;
    } */

    private function buscaProductes($codi)
    {
        $id = $codi;
        $filename = "../fitxers/productes.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            if ($id == $ob[0]) {
                $pr = new Producte($ob[0], $ob[1], $ob[2], $ob[3], trim($ob[4]));
                break;
            }
        }
        fclose($fitxer);
        return $pr;
    }
}
