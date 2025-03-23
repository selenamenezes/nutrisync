<?php
    abstract class Config {
        // NUTRICIONISTA
        abstract function marcarConsulta();
        abstract function cancelarConsulta();

        // CONSULTA
        abstract function confirmarConsulta();
        
        // PACIENTE
        abstract function agendarConsulta();

        // HISTORICO MEDICO
        abstract function exibirHistorico();

        // LOGIN
        abstract function realizarLogin();
        abstract function validarCredenciais();
        abstract function realizarCadastro();
    }
?>