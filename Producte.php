<?php
     class Producte{
        private $seccio="";
        private $nomProducte="";
        private $codiProducte="";
        private $imatge="";
        private $preu=0;

        public function __construct($codiProducte, $nomProducte, $seccio, $preu, $imatge){
            $this->seccio = $seccio;
            $this->nomProducte = $nomProducte;
            $this->codiProducte = $codiProducte;
            $this->imatge = $imatge;
            $this->preu = $preu;
        }

        

        public function __get($prop){
			if(property_exists($this,$prop)){
				return $this->$prop;
			}
            return -1;
        }
        
        public function __set($prop,$valor){
			if(property_exists($this,$prop)){
				$this->$prop=$valor;
			}
        }

        
    }
?>