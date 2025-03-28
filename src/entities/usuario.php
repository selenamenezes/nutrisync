<?php
    require_once './database/conexao.php';
    require_once './src/utils/validacao.php';

    // para consulta
    // cpf usado para buscar paciente na hora da consulta e preencher os dados
    function dados_usuario($conn, $altura, $imc, $peso, $cpf, $data_nasc){
        // precisa validar esses valores ou mexeram no front?
        if (empty($altura) || empty($imc) || empty($peso) || empty($cpf) || empty($data_nasc)) {
            return "Preencha todos os campos para realizar o agendamento da consulta.";
        }

        $idade = idade($data_nasc);

        if (!validar_cpf($cpf)) {
            return "CPF inválido.";
        }

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        return $conn->query($cursor) ? "Dados do usuário coletados!" : "Erro ao inserir os dados: " . $conn->error;
    }

    // cpf usado para buscar paciente e editar os dados
    function editar_usuario($conn, $altura, $imc, $nome, $peso, $sexo, $telefone, $cpf){

        if (!validar_cpf($cpf)) {
            return "CPF inválido.";
        }

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);
        

        $lista_update = [];

        if($registro->num_rows == 0){
            return "Usuário não cadastrado.";
        }

        $lista_update[] = $nome !== null ? "nome = '" . ucwords(strtolower($nome)) . "'" : null;
        $lista_update[] = $altura !== null ? "altura = '$altura'" : null;
        $lista_update[] = $imc !== null ? "imc = '$imc'" : null;
        $lista_update[] = $peso !== null ? "peso = '$peso'" : null;
        $lista_update[] = $sexo !== null ? "sexo = '$sexo'" : null;
        $lista_update[] = $telefone !== null ? "telefone = '$telefone'" : null;
        $lista_update[] = $cpf = !== null ? "cpf = '$cpf'" : null;

        # remove os valores nulos da lista
        $lista_update = array_filter($lista_update);

        if(empty($lista_update)){
            return "Nenhum campo para atualizar";
        }

        $cursor = "update usuario set " . implode(", ", $lista_update) . " where cpf = '$cpf'";

        return $conn->query($cursor) ? "Usuário atualizado com sucesso!" : "Erro ao atualizar o usuário: " . $conn->error;
    }

    function deletar_usuario($conn, $cpf){

        if (!validar_cpf($cpf)) {
            return "CPF inválido.";
        }

        $cursor = "select cpf from usuario where cpf = '$cpf'";
        $registro = $conn->query($cursor);

        if($registro->num_rows == 1){
            $cursor = "delete usuario where cpf = '$cpf'";

            if($conn->query($cursor)){
                return "Usuário deletado.";
            }else{
                return "Erro ao deletar o usuário: " . $conn->error;
            }
            
        }else {
            return "Usuário não cadastrado.";
        }
    }
?>