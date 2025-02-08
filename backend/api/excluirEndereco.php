<?php
require '../config/database.php';
require '../models/endereco.php';

$cep = $_GET['cep'] ?? '';

if (!$cep || !preg_match('/^[0-9]{8}$/', $cep)) {
    echo json_encode(['erro' => 'CEP inválido']);
    exit;
}

// Cria um objeto Endereco e tenta excluir o endereço com o CEP fornecido
$endereco = new Endereco($pdo);
if ($endereco->excluir($cep)) { // Exclui o endereço no banco
    echo json_encode(['sucesso' => 'Endereço excluído com sucesso!']);
} else {
    echo json_encode(['erro' => 'Erro ao excluir o endereço']);
}
?>
