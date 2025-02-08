<?php
require '../config/database.php';
require '../models/endereco.php';

// Recupera e define as variáveis de ordenação da URL
$ordem = $_GET['ordem'] ?? 'cidade';
$direcao = $_GET['direcao'] ?? 'ASC';

$endereco = new Endereco($pdo);
echo json_encode($endereco->listar($ordem, $direcao));
?>
