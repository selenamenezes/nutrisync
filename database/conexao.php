<?php
    $host = 'localhost';
    $banco = 'nutrisyncdb';
    $usuario = 'root';
    $senha = '';

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if($conn->connect_error){
        die("Erro na conexão: " . $conn->connect_error);
    }

    echo "Conexão bem-sucedida";
?>