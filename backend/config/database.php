<?php
$host = 'localhost'; // Host do banco de dados
$dbname = 'consultar_cep'; // Nome do baco de dados
$username = 'root'; // Usuário para conexão com o banco
$password = ''; // Senha para conexão com o banco

// Tenta criar a conexão com o banco de dados utilizando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    // Caso ocorra algum erro na conexão, exibe uma mensagem e interrompe o script
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
