<?php
header('Content-Type: application/json');
$metodo = $_SERVER['REQUEST_METHOD'];


if ($metodo == 'POST') {
    $dados_recebidos = json_decode(file_get_contents('php://input'), true);
    $arquivo = $dados_recebidos['arquivo'];
    $conteudo = json_encode($dados_recebidos['dados'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    if (file_put_contents($arquivo, $conteudo)) {
        echo json_encode(["status" => "sucesso"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "erro"]);
    }
}


if ($metodo == 'GET') {
    $arquivo = $_GET['arquivo'];
    if (file_exists($arquivo)) {
        echo file_get_contents($arquivo);
    } else {
        echo "[]";
    }
}
?>