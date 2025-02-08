document.addEventListener("DOMContentLoaded", listarEnderecos);

// Função para buscar e salvar um endereço no banco  com base no CEP fornecido
function buscarEndereco() {
    const cep = document.getElementById("cep").value;
    if (!cep) {
        document.getElementById("mensagem").innerText = "Por favor, digite um CEP válido!";
        return;
    }

    // Faz a requisição para API para buscar o endereço pelo CEP
    fetch(`http://localhost:8080/consultar-cep/backend/api/buscarCep.php?cep=${cep}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar o endereço');
            }
            return response.json();
        })
        .then(data => {
            if (data.erro) {
                document.getElementById("mensagem").innerText = data.erro;
            } else {
                document.getElementById("mensagem").innerText = "Endereço salvo com sucesso!";
                listarEnderecos();
            }
        })
        .catch(error => {
            // Captura e exibe qualquer erro ocorrido durante o processo
            document.getElementById("mensagem").innerText = error.message;
            console.error(error);
        });
}

// Função para listar todos os endereços salvos com a possibilidade de ordenação
function listarEnderecos() {
    let ordenacao = document.getElementById("ordenacao").value;
    let direcao = 'ASC';

    fetch(`http://localhost:8080/consultar-cep/backend/api/listarEnderecos.php?ordem=${ordenacao}&direcao=${direcao}`)
        .then(response => response.json())
        .then(data => {
            let tabela = document.getElementById("tabela-enderecos");
            tabela.innerHTML = "";

            // Itera sobre a lista de endereços recebida e adiciona cada um na tabela
            data.forEach(endereco => {
                let row = `<tr>
                    <td>${endereco.cep}</td>
                    <td>${endereco.logradouro}</td>
                    <td>${endereco.bairro}</td>
                    <td>${endereco.cidade}</td>
                    <td>${endereco.estado}</td>
                    <td>
                        <button onclick="excluirEndereco('${endereco.cep}')" class="btn delete-btn">
                            <div class="lixeira">
                                <div class="tampa"></div>
                                <i class="fas fa-trash-alt"></i>
                            </div>
                        </button>
                    </td>
                </tr>`;
                tabela.innerHTML += row;
            });
        })
        .catch(error => {
            console.error('Erro ao listar os endereços:', error);
            document.getElementById("mensagem").innerText = "Erro ao listar os endereços.";
        });
}

// Função para excluir um endereço com base no CEP
function excluirEndereco(cep) {
    if (confirm("Tem certeza que deseja excluir este endereço?")) {
        fetch(`http://localhost:8080/consultar-cep/backend/api/excluirEndereco.php?cep=${cep}`, {
            method: 'DELETE',
        })
            .then(response => {
                // Verifica se a exclusão foi bem sucedida
                if (!response.ok) {
                    throw new Error('Erro ao excluir o endereço');
                }
                listarEnderecos(); // Atualiza a lista de endereços apos exclusão
            })
            .catch(error => {
                console.error('Erro ao excluir o endereço:', error);
                document.getElementById("mensagem").innerText = "Erro ao excluir o endereço.";
            });
    }
}
