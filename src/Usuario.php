<?php
    require_once 'conexao.php';
    /* criar funcao caso precise formatar tel e cpf */

    function validar_cpf($cpf){
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }
        return true;
    }

    function idade($conn, $data_nasc){
        $nasc = new DateTime($data_nasc);
        $atual = new DateTime();
        $idade = $atual->diff($nasc);

        return $idade->y;
    }
   
    function cadastrar_usuario($conn, $nome, $email, $telefone, $data_nasc, $senha, $confirm_senha, $cpf){
        if (empty($cpf) || empty($nome) || empty($telefone) || empty($email) || empty($data_nasc) || empty($senha) || empty($confirm_senha)) {
            return "Preencha todos os campos.";
        }

        if($senha !== $confirm_senha){
            return "As senhas não coincidem.";
        }

        if (!validar_cpf($cpf)) {
            return "CPF inválido.";
        }

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        if($registro->num_rows > 0){
            return "Usuário já cadastrado.";
        }

        $senha_cript = password_hash($senha, PASSWORD_DEFAULT);
        $nome_title = ucwords(strtolower($nome)); 

        $cursor = "insert into usuario (cpf, nome, telefone, senha) values ('$cpf', '$nome_title', '$telefone', '$senha_cript')";
   
        if($conn->query($cursor)){
            return "Bem vindo, $nome_title!";
        }else {
            return "Erro ao cadastrar usuário: " . $conn->error;
        }
    }

    // para consulta
    function dados_usuario($conn, $altura, $imc, $peso, $cpf, $data_nasc){
        // precisa validar esses valores ou mexeram no front?
        if (empty($altura) || empty($imc) || empty($peso) || empty($cpf)) {
            return "Preencha todos os campos para realizar o agendamento da consulta.";
        }

        $idade = idade($data_nasc);

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        if($registro->num_rows == 1){
            $cursor = "insert into usuario(altura, imc, peso, idade) values('$altura', '$imc', '$peso', '$idade')";
        }else {
            return "Usuário não encontrado.";
        } 

        if($conn->query($cursor)){
            return "Dados do usuário coletados!";
        }else{
            return "Erro ao inserir os dados: " . $conn->error;
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