<?php
    header('Content-type: application/json');

    $id = $_GET["id"];
    $tabela = $_GET["tabela"];

    if(!$id){
        echo json_encode(["erro" => "Dados Insuficientes"]);
        exit;
    }


    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "av2";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error){
        echo json_encode(["erro" => "Falha na conexão"]);
        exit;
    }

    if ($tabela == "1") {
        $nomeTabela = "usuarios";
    } else if ($tabela == "2") {
        $nomeTabela = "servicos";
    } else {
        $nomeTabela = "funcionarios";
    }

    $comando = "SELECT * FROM `$nomeTabela` WHERE id = $id";

    $resultado = $conn->query($comando);

    if ($resultado && $resultado->num_rows > 0) {
        $dados = $resultado->fetch_assoc();
    
        if ($tabela == "1") {
            $dados['tipoPerfil'] = "Cliente/Usuário";
        } else if ($tabela == "2") {
            $dados['tipoPerfil'] = "Serviço Prestado";
        } else {
            $dados['tipoPerfil'] = "Funcionário";
        }
    
        echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["erro" => "Registro não encontrada"], JSON_UNESCAPED_UNICODE);
    }

    $conn->close();
?>