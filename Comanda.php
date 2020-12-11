<?php
     class Comanda{
        private $idComanda="";
        private $data="";
        private $idUsuariComanda="";
        private $productes=array();

        public function __construct($idComanda, $data, $idUsuariComanda,$productes){
            $this->idComanda = $idComanda;
            $this->data = $data;
            $this->idUsuariComanda = $idUsuariComanda;
            $this->productes = $productes;
            
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