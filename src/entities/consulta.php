<?php
    require_once './database/conexao.php';
    require_once './src/entities/usuario.php';
    require_once './src/entities/nutricionista.php';
    require_once './src/utils/validacao.php';

    // FALTA TESTAR

    function marcar_consulta($conn, $usuario_fk, $nutricionista_fk, $dia, $hora){

        if(empty($usuario_fk) || empty($nutricionista_fk) || empty(dia) || empty(hora)) {
            return "Preencha todos os campos.";
        }

        $data = DateTime::createFromFormat('d/m/Y', $dia);

        if(!$data){
            return "Formato da data inválido. Use o formato dia/mês/ano.";
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

        $cursor = "insert into consultas (usuario_fk, nutricionista_fk, dia, hora) values ('$usuario_fk', '$nutricionista_fk', '$dia', '$hora')";
        if($conn->query($cursor)){
            return "Consulta agendada!";
        }else {
            return "Erro ao marcar a consulta: " . $conn->error;
        }

    }
?>