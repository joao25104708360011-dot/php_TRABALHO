<?php

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($data) {
    $arquivo = $data['arquivo'];
    $conteudo = json_encode($data['dados'], JSON_PRETTY_PRINT);
    file_put_contents($arquivo, $conteudo);
    echo "Sucesso";
}
?>