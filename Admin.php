<?php
include("iAdmin.php");


class Admin extends Usuari implements iAdmin
{

    public function __construct($idUsuari, $nomUsuari, $contrasenya, $rol)
    {
        $this->idUsuari = $idUsuari;
        $this->nomUsuari = $nomUsuari;
        $this->contrasenya = $contrasenya;
        $this->rol = $rol;
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

    function veureComandes($fitx)
    {
        
        include("../Comanda.php");

        $llistaComandes = array();
        $filename = "../fitxers/".$fitx;
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        while (!feof($fitxer)) {

            $comanda = unserialize(fgets($fitxer));
            if($comanda){
                array_push($llistaComandes, $comanda);
            }
        }
        fclose($fitxer);
        return $llistaComandes;
    
    }

    function veureComandesEliminar($fitx)
    {
        
        include("../Comanda.php");

        $llistaComandes = array();
        $filename = "../fitxers/".$fitx;
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            if($comanda=$this->buscaComandes($ob[1])){
                $llistaComandes[$ob[0]] = $comanda;
                //array_push($llistaComandes, array($ob[0]=>$comanda));
            }
            
        }
        fclose($fitxer);
        return $llistaComandes;
    
    }


    function esborrarComanda($codiComanda)
    {
       
            //PROGRAMAT AMB JS

    }

    protected function modificarComanda()
    {
    }

    function modificarUsuari($usuari)
    {

        $id = $_POST["id"];
        $usuari = $_POST["usuari"];
        $pass = $_POST["pass"];
        $nom = $_POST["nom"];
        $addr = $_POST["addr"];
        $mail = $_POST["mail"];
        $telefon = $_POST["telefon"];
        $visa = $_POST["visa"];
        $rol = $_POST["rol"];

        $filename = "../fitxers/usuaris.txt";
        $filenameTemp = "../fitxers/usuarisTmp.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

        if ($nom != "") {
            $dadesUsuari = $id . "," . $usuari . "," . $pass . "," . $rol . "," . $nom . "," . $addr . "," . $mail . "," . $telefon . "," . $visa . "\n";
            $us = new Client($id, $usuari, $pass, $rol, $nom, $addr, $mail, $telefon, $visa);
        } else {
            $dadesUsuari = $id . "," . $usuari . "," . $pass . "," . $rol ;
            $us = new Admin($id, $usuari, $pass, $rol);
        }


        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            if ($ob[0] == $id) {
                fwrite($fitxerTemp, $dadesUsuari);
            } else {
                if ($ob[0] != "") {
                    if (trim($ob[3]) == "admin") {
                        fwrite($fitxerTemp, $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] );
                    } else {
                        fwrite($fitxerTemp, $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] . "," . $ob[4] . "," . $ob[5] . "," . $ob[6] . "," . $ob[7] . "," . $ob[8] . "\n");
                    }
                }
            }
        }
        unlink($filename);
        rename($filenameTemp, $filename);
        fclose($fitxer);
        fclose($fitxerTemp); 
        return $us;
    }

    public function afegirProducte()
    {

        $pathImatge = "/daw2_m07uf1_projecte_grup08/productes/imatges/";
        $seccio = $_POST["seccio"];
        $nomProducte = $_POST["nomProducte"];
        $codiProducte = $_POST["codiProducte"];
        $imatge = $_POST["imatge"];
        $preu = $_POST["preu"];
        include("../Producte.php");

        $pr = new Producte($codiProducte, $nomProducte, $seccio, $preu, $pathImatge . $imatge);
        $dadesProducte = $pr->codiProducte . ","  . $pr->nomProducte . ","  . $pr->seccio . ","  . $pr->preu . "," . $pr->imatge . "\n";
        $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/productes.txt";
        $fitxer = fopen($filename, "a") or die("No s'ha pogut crear el fitxer");
        fwrite($fitxer, $dadesProducte);
        fclose($fitxer);
        return $pr;
    }

    public function esborraProducte()
    {
        //PROGRAMAT AMB JS
    }

    public function modificaProducte()
    {

        include("Producte.php");
        $pathImatge = "/daw2_m07uf1_projecte_grup08/productes/imatges/";
        $seccio = $_GET["seccio"];
        $nomProducte = $_GET["nomProducte"];
        $codiProducte = $_GET["codiProducte"];
        $imatge = $_GET["imatge"];
        $imatgeAnterior = $_GET["imatgeAnterior"];
        $preu = $_GET["preu"];

        if ($imatge != "") {
            $dadesProducte = $codiProducte . "," . $nomProducte . "," . $seccio . "," . $preu . "," . $pathImatge . $imatge . "\n";
            $pr = new Producte($codiProducte, $nomProducte, $seccio, $preu, $pathImatge . $imatge);
        } else {
            $dadesProducte = $codiProducte . "," . $nomProducte . "," . $seccio . "," . $preu . "," . $imatgeAnterior . "\n";
            $pr = new Producte($codiProducte, $nomProducte, $seccio, $preu, $imatgeAnterior);
        }

        $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/productes.txt";
        $filenameTemp = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/productesTmp.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        $fitxerTemp = fopen($filenameTemp, "w") or die("No s'ha pogut crear el fitxer");

        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            if ($ob[0] == $pr->codiProducte) {
                fwrite($fitxerTemp, $dadesProducte);
            } else {
                if ($ob[0] != "") {
                    fwrite($fitxerTemp, $ob[0] . "," . $ob[1] . "," . $ob[2] . "," . $ob[3] . "," . $ob[4]);
                }
            }
        }
        unlink($filename);
        rename($filenameTemp, $filename);
        fclose($fitxer);
        fclose($fitxerTemp);
        return $pr;
    }

    public function esborraUsuari()
    {
        //PROGRAMAT AMB JS
    }

    function eliminaUsuari($usuari){
        
    }
    
    public function veureUsuaris()
    {

        $llistaUsuaris = [];

        $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/usuaris.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");

        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            $us = new Client($ob[0], $ob[1], $ob[2], $ob[3], $ob[4], $ob[5], $ob[6], $ob[7], trim($ob[8]));
            array_push($llistaUsuaris, $us);
        }
        fclose($fitxer);
        
        return $llistaUsuaris;
    }

    public function veureUsuarisRevisar()
    {

        $llistaUsuaris = array();

        $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/baixes.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");

        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));
            if($ob[0]!=""){
            $us = new Client($ob[1], $ob[2], $ob[3], $ob[4], $ob[5], $ob[6], $ob[7], $ob[8], trim($ob[9]));
            array_push($llistaUsuaris, array($ob[0]=>$us));
            }
        }
        fclose($fitxer);
        
        return $llistaUsuaris;
    }

    private function buscaComandes($codi)
    {
        if($codi){
        $filename = "../fitxers/comandes.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        while (!feof($fitxer)) {
            $comanda = unserialize(fgets($fitxer));

            if ($codi == $comanda->idComanda) {
                $co = serialize($comanda);
                break;
            }
        }
        fclose($fitxer);
        return $co;
    }
}
}
