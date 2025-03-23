<?php
    class UsuarioDados{
        private $conn;

        function __construct($conexao){
            $this->conn = $conexao;
        }

        function getConexao(){
            return $this->conn;
        }
    }
?>