<?php
    class Consulta {
        private $dia;
        private $hora;
        private $id;
        private $telefone;
        private $nutricionista_fk;
        private $usuario_fk;

        function __construct($dia, $hora, $id, $telefone, $nutricionista_fk, $usuario_fk){
            $this->dia = $dia;
            $this->hora = $hora;
            $this->id = $id;
            $this->telefone = $telefone;
            $this->nutricionista_fk = $nutricionista_fk;
            $this->usuario_fk = $usuario_fk;
        }

        public function getDia() {
            return $this->dia;
        }
    
        public function getHora() {
            return $this->hora;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function getTelefone() {
            return $this->telefone;
        }
    
        public function getNutricionistaFk() {
            return $this->nutricionista_fk;
        }
    
        public function getUsuarioFk() {
            return $this->usuario_fk;
        }
    } 
?>