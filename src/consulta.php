<?php
    require_once 'conexao.php';
    require_once 'usuario.php';

    // FALTA TESTAR

    function validar_crn($crn){
        // remove os caracteres que nao sao letras ou numeros
        $crn = preg_replace('/[^a-zA-Z0-9]/', '', $crn);

        // verifica o comprimento
        if(strlen($crn) < 6 || strlen($crn) > 8){
            return false;
        }

        // verifica se o formato eh valido (numero seguido de uma letra
        if (!preg_match('/^[0-9]+[A-Za-z]$/', $crn)) {
            return false;
        }

        return true;
    }

    function marcar_consulta($conn, $usuario_fk, $nutricionista_fk, $dia, $hora){
        // implementar formatacao do dia e hora (se precisar)
        if(empty($usuario_fk) || empty($nutricionista_fk) || empty(dia) || empty(hora)) {
            return "Preencha todos os campos.";
        }

        if (!validar_cpf($cpf)) {
            return "CPF inválido.";
        }

        if(!validar_crn($crn)){
            return "CRN inválido.";
        }

        $cursor = "select cpf from usuario where cpf = '$usuario_fk'";
        $registro = $conn->query($cursor);

        if($registro->num_rows == 0) {
            return "Usuário não encontrado.";
        }

        $cursor = "select crn from nutricionista where crn = '$nutricionista_fk'";
        $registro = $conn->query($cursor);

        if($registro->num_rows == 0){
            return "Nutricionista não encontrado.";
        }

        $cursor = "insert into consultas (usuario_fk, nutricionista_fk, dia, hora) values ('$usuario_fk', '$nutricionista_fk', '$dia', '$hora')";~
        if($conn->query($cursor)){
            return "Consulta agendada!";
        }else {
            return "Erro ao marcar a consulta: " . $conn->error;
        }
    }

    // vai ter funcao pra buscar as consultas agendadas? e quando elas forem feitas, vai remover do sistema?
?>