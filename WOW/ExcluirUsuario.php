<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    $id = $dados["id"];

    if (!$id) {
        echo json_encode(["status" => "erro", "mensagem" => "Dados insuficientes para atualização."]);
        exit;
    }

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "av2";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error){
        echo json_encode(["status" => "erro", "mensagem" => "Falha na conexão com o banco de dados."]);
        exit;
    }

    $sql = "DELETE FROM `usuarios` WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Registro excluido com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>