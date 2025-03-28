<?php
    // usuario
    function validar_telefone($telefone){
        $telefone = preg_replace('/\D/', '', $telefone);

        if(strlen($telefone) < 10 || strlen($telefone) > 11){
            return false;
        }

        if(strlen($telefone) === 11){
            return '(' . substr($telefone, 0, 2) . ')' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4) . '-' . substr($telefone, 7, 4);
        }else {
            return '(' . substr($telefone, 0, 2) . ')' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4) . '-' . substr($telefone, 7, 4);
        }
    }
   
    function validar_cpf($cpf){
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    function idade($conn, $data_nasc){
        $nasc = new DateTime($data_nasc);
        $atual = new DateTime();
        $idade = $atual->diff($nasc);

        return $idade->y;
    }

    // nutricionista
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

    function validar_senha_usuario($senha, $senha_cript){
        return password_verify($senha, $senha_cript);
    }
?>