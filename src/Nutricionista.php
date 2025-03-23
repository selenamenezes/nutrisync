<?php
    class Nutricionista {
        private $crn;
    
        function __construct($nome, $sexo, $telefone, $crn){
            parent::__construct(null, null, null, $nome, null, $sexo, $telefone);
            $this->crn = $crn;
        }

        function getCrn(){
            return $this->crn;
        }
    }
?>