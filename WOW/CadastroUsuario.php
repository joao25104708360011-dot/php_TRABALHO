<?php
    header('Content-type: application/json');
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if(!$dados){
        echo json_encode(["status" => "erro", "mensagem" => "Dados não recebidos."]);
        exit;
    }

    $id = $dados['id'];
    $nome = $dados['nome'];
    $phone = $dados['telefone'];
    $email = $dados['email'];

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "av2";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error){
        die("Conexão falhou.");
    }

    $sql =  "INSERT INTO `usuarios` (id, nome, telefone, email) VALUES ('$id', '$nome', '$phone', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Usuário cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => $conn->error]);
    }
    $conn->close();
?>