# Sistema Web para Consulta e Armazenamento de Endereços

Este é um sistema web que permite aos usuários consultar um endereço pelo **CEP**, armazenar os registros consultados e exibir a lista de endereços salvos com opções de ordenação.

## Funcionalidades

✔ Consultar endereço pelo **CEP** utilizando a API pública [ViaCEP](https://viacep.com.br/)  
✔ Armazenar os endereços consultados no banco de dados  
✔ Listar os endereços salvos  
✔ Ordenação por **Cidade, Bairro ou Estado** (crescente/decrescente)  
✔ Exclusão de endereços salvos  
✔ Mensagens de erro para CEPs inválidos ou falhas na requisição  

---

## Tecnologias Utilizadas

- **Backend**: PHP, MySQL, API ViaCEP  
- **Frontend**: HTML, CSS, JavaScript  
- **Bibliotecas**: Bootstrap 5, FontAwesome  

---

## Estrutura do Projeto

```
/consultar-cep 
│── /backend 
│   ├── /api 
│   │   ├── buscarCep.php  # Consulta um CEP e armazena no banco
│   │   ├── listarEnderecos.php  # Lista os endereços salvos no banco
│   │   ├── excluirEndereco.php  # Exclui um endereço salvo
│   ├── /config 
│   │   ├── database.php  # Configuração do banco de dados
│   ├── /models 
│   │   ├── endereco.php  # Classe Endereco (CRUD de endereços)
│── /frontend 
│   ├── index.html  # Interface do usuário
│   ├── script.js  # Lógica do frontend
│   ├── styles.css  # Estilos da interface
│── README.md  # Documentação do projeto
```

---

## Como Configurar o Banco de Dados

1. **Criação do banco de dados**  
   No **MySQL**, crie um banco de dados chamado `consultar_cep`:

   ```sql
   CREATE DATABASE consultar_cep;
   ```

2. **Criação da tabela `enderecos`**

   ```sql
   CREATE TABLE enderecos (
       id INT AUTO_INCREMENT PRIMARY KEY,
       cep VARCHAR(8) NOT NULL UNIQUE,
       logradouro VARCHAR(255),
       bairro VARCHAR(255),
       cidade VARCHAR(255),
       estado VARCHAR(2)
   );
   ```

3. **Configuração da conexão com o banco**  
   No arquivo `/backend/config/database.php`, edite as credenciais conforme necessário:

   ```php
   <?php
   $host = 'localhost';
   $dbname = 'consultar_cep';
   $username = 'root'; 
   $password = ''; 

   try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
       die("Erro na conexão com o banco de dados: " . $e->getMessage());
   }
   ?>
   ```

---

## Como Rodar o Projeto

1. **Clone o repositório**

   ```sh
   git clone https://github.com/seu-usuario/consultar-cep.git
   cd consultar-cep
   ```

2. **Inicie o servidor local**

   - **Se estiver usando XAMPP ou WAMP**: mova a pasta do projeto para o diretório `htdocs` (XAMPP) ou `www` (WAMP). Em seguida, inicie o Apache e o MySQL.
   
   - **Se estiver usando o servidor embutido no PHP**: execute o comando abaixo na raiz do projeto:

     ```sh
     php -S localhost:8080
     ```

3. **Acesse o frontend**

   Abra o navegador e digite:

   ```
   http://localhost/consultar-cep/frontend/index.html
   ```

---

## Autor

Desenvolvido por Ana Carolina Rocha 🚀
