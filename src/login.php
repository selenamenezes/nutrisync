<?php
    require_once './src/utils/validacao.php';
    require_once './src/cadastro.php';
    require_once './src/entities/usuario.php';

    function login_usuario($conn, $email, $senha){
        if(empty($email) || empty($senha)){
            return "Preencha todos os campos.";
        }

        if(!validar_cpf($cpf)){
            return "CPF inválido.";
        }

        $cursor = "select senha from usuario where email = '$email'";
        $registro = $conn->query($cursor);

        if($registro->num_rows > 0){
            $usuario = $registro->fetch_assoc(); // cria um 'dicionario' do registro
            $senha_cript = $usuario['senha'];   // atribui a senha do banco q esta criptografada

            return validar_senha_usuario($senha, $senha_cript) ? "Login realizado com sucesso!" : "Senha incorreta.";
        }else{
            return "Usuário não cadastrado.";
        }
    }

    function login_nutricionista($conn, $email, $senha, $crn){
        if(empty($crn) || empty($senha) || empty($crn)){
            return "Preencha todos os campos.";
        }

        if(!validar_crn($crn)){
            return "CRN inválido.";
        }

        $cursor = "select senha from nutricionista where crn = '$crn'";
        $registro = $conn->query($cursor);

        if($registro->num_rows > 0){
            $nutricionista = $registro->fetch_assoc();
            $senha_cript = $nutricionista['senha'];

            return validar_senha_usuario($senha, $senha_cript) ? "Login realizado com sucesso!" : "Senha incorreta.";
        }else{
            return "CRN não cadastrado.";
        }
    }
?>