<?php
    class Usuario {
        private $altura;
        private $cpf;
        private $imc;
        private $nome;
        private $peso;
        private $sexo;
        private $telefone;

        function __construct($altura, $cpf, $imc, $nome, $peso, $sexo, $telefone){
            $this->altura = $altura;
            $this->cpf = $cpf;
            $this->imc = $imc;
            $this->nome = $nome;
            $this->peso = $peso;
            $this->sexo = $sexo;
            $this->telefone = $telefone;
        }

        public function getAltura() {
            return $this->altura;
        }
    
        public function getCpf() {
            return $this->cpf;
        }
    
        public function getImc() {
            return $this->imc;
        }
    
        public function getNome() {
            return $this->nome;
        }
    
        public function getPeso() {
            return $this->peso;
        }
    
        public function getSexo() {
            return $this->sexo;
        }
    
        public function getTelefone() {
            return $this->telefone;
        }
    }

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