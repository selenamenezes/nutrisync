<?php
    require_once 'teste_usuario.php';
    require_once 'conexao.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nome = $_POST['nome_completo'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data_nasc = $_POST['data_nascimento'];
        $senha = $_POST['senha'];
        $confirm_senha = $_POST['confirme_senha'];
        $cpf = $_POST['cpf'];

        $conn = conectar_banco();
    
        $resultado = cadastrar_usuario($conn, $nome, $email, $telefone, $data_nasc, $senha, $confirm_senha, $cpf);
    
        echo $resultado;

        $conn->close();
    }
?>