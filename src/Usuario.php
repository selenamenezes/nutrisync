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
?>