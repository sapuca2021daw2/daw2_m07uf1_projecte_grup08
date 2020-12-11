<?php
abstract class Usuari
{
    protected $idUsuari = "";
    protected $nomUsuari = "";
    protected $contrasenya = "";
    protected $rol;

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

    function veureLlistaProductes()
    {
        $seccio = $_GET["seccio"];
        $llistaProductes = [];
        include("../Producte.php");
        $filename = "/var/www/html/daw2_m07uf1_projecte_grup08/fitxers/productes.txt";
        $fitxer = fopen($filename, "r") or die("No s'ha pogut crear el fitxer");
        while (!feof($fitxer)) {
            $ob = explode(",", fgets($fitxer));

            if ($seccio == $ob[2]) {
                $pr = new Producte($ob[0], $ob[1], $ob[2], $ob[3], trim($ob[4]));
                array_push($llistaProductes, $pr);
            }
        }
        fclose($fitxer);
        return $llistaProductes;
    }


    public function veureDetallProducte()
    {
        $id = $_GET["codi"];
        include("../Producte.php");
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

    abstract protected function veureComandes($fitxer);

    abstract protected function esborrarComanda($comanda);

    abstract protected function modificarComanda();

    abstract protected function modificarUsuari($usuari);

    abstract protected function eliminaUsuari($usuari);

}
