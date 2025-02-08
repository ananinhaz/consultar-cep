<?php
// Definição da classe Endereco para as operações de CRUD no banco de dados
class Endereco {
    private $pdo; // variável que armazenará a conexão com o banco de dados
    
    // Construtor, responsável por receber a conexão PDO e inicializar o objeto
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Função para salvar um endereço
    public function salvar($cep, $logradouro, $bairro, $cidade, $estado) {
        $stmt = $this->pdo->prepare("INSERT INTO enderecos (cep, logradouro, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$cep, $logradouro, $bairro, $cidade, $estado]);
    }

    // Função para listar os endereços
    public function listar($ordem = 'cidade', $direcao = 'ASC') {
        $stmt = $this->pdo->prepare("SELECT * FROM enderecos ORDER BY $ordem $direcao");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Função para excluir um endereço
    public function excluir($cep) {
        $stmt = $this->pdo->prepare("DELETE FROM enderecos WHERE cep = ?");
        return $stmt->execute([$cep]);
    }
}

?>
