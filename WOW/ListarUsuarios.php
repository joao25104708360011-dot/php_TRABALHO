<?php
    header('Content-type: application/json');
    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";

    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error){
        echo json_encode(["erro" => "Falha na conexão: " . $conn->connect_error]);
        exit;
    }

    $tudo = array();
    $aux = $conn->query("SELECT * FROM `usuarios`");

    while($row = $aux->fetch_assoc()) { 
        $tudo[] = $row; 
    }

    echo json_encode($tudo, JSON_UNESCAPED_UNICODE);
?>