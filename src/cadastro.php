<?php
    require_once './database/conexao.php';
    require_once './utils/validacao.php';

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

        if (!validar_telefone($telefone)){
            return "Telefone inválido.";
        }

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        if($registro->num_rows > 0){
            return "Usuário já cadastrado.";
        }

        $cursor = "select email from usuario where email = '$email'";
        $registro = $conn->query($cursor);

        if($registro->num_rows > 0){
            return "E-mail já cadastrado.";
        }

        $senha_cript = password_hash($senha, PASSWORD_DEFAULT);
        $nome_title = ucwords(strtolower($nome)); 

        $cursor = "insert into usuario (cpf, nome, telefone, senha, email) values ('$cpf', '$nome_title', '$telefone', '$senha_cript', '$email')";
   
        return $conn->query($cursor) ? "Bem vindo, $nome_title!" : "Erro ao cadastrar usuário: " . $conn->error;
    }

    function cadastrar_nutricionista();
?>