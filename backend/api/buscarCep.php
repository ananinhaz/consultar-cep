<?php
require '../config/database.php'; // Conecta com o banco de dados
require '../models/endereco.php';

$cep = $_GET['cep'] ?? '';

// Valida o formato do CEP. O CEP deve conter 8 dígitos numéricos
if (!$cep || !preg_match('/^[0-9]{8}$/', $cep)) {
    echo json_encode(['erro' => 'CEP inválido']);
    exit;
}

// Faz uma requisição para API ViaCEP para consultar o endereço
$response = file_get_contents("https://viacep.com.br/ws/$cep/json/");
$data = json_decode($response, true);

// Verifica se a resposta contém erro (CEP não encontrado)
if (isset($data['erro'])) {
    echo json_encode(['erro' => 'CEP não encontrado']);
    exit;
}

// Cria um objeto da classe Endereco, passando o PDO
$endereco = new Endereco($pdo);

// Chama o método salvar() para armazenar o endereço no banco
$endereco->salvar($cep, $data['logradouro'], $data['bairro'], $data['localidade'], $data['uf']);

// Retorna os dados do endereço encontrado em JSON
echo json_encode($data);
?>
