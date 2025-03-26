<?php

    /* criar funcao caso precise formatar tel e cpf */

    function cadastro_usuario($conn, $altura, $cpf, $imc, $nome, $peso, $sexo, $telefone){
        if (empty($cpf) || empty($nome) || empty($sexo) || empty($telefone) || empty($altura) || empty($peso) || empty($imc)) {
            return "Preencha todos os campos.";
        }

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        if($registro->num_rows > 0){
            return "Usuário já cadastrado.";
        }

        $nome_title = ucwords(strtolower($nome));

        $cursor = "insert into usuario (cpf, peso, altura, imc, sexo, nome, telefone) values ('$cpf', '$peso', '$altura', '$imc', '$sexo', '$nome_title', '$telefone')";

        if($conn->query($cursor)){
            return "Bem vindo, $nome_title!";
        }else {
            return "Erro ao cadastrar usuário: " . $conn->error;
        }
        
    }

    function editar_usuario($conn, $altura, $imc, $nome, $peso, $sexo, $telefone, $cpf){
        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        $lista_update = [];

        if($registro->num_rows == 0){
            return "Usuário não cadastrado.";
        }

        if($nome !== null){
            $nome_title = ucwords(strtolower($nome));
            $lista_update[] = "nome = '$nome_title'";
        }

        if($altura !== null){
            $lista_update[] = "altura = '$altura'";
        }

        if($imc !== null){
            $lista_update[] = "imc = '$imc'";
        }

        if($peso !== null){
            $lista_update[] = "peso = '$peso'";
        }

        if($sexo !== null){
            $lista_update[] = "sexo = '$sexo'";
        }

        if($telefone !== null){
            $lista_update[] = "telefone = '$telefone'";
        }

        if(empty($lista_update)){
            return "Nenhum campo para atualizar";
        }

        $cursor = "update usuario set " . implode(", ", $lista_update) . " where cpf = '$cpf'";

        if($conn->query($cursor)) {
            return "Usuário atualizado!";
        }else {
            return "Erro ao atualizar o usuário: " . $conn->error;
        }
    }

    function deletar_usuario($conn, $cpf){
        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        if($registro->num_rows == 1){
            $cursor = "delete usuario where cpf = '$cpf'";

            if($conn->query($cursor)){
                echo "Usuário deletado.";
            }else{
                echo "Erro ao deletar o usuário: " . $conn->error;
            }
            
        }else {
            echo "Usuário não cadastrado.";
        }
    }
?>