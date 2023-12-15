<?php
include 'conexao.php';

// Verificar se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nascimento = $_POST["data_nascimento"];
    $celular = $_POST["celular"];
    $cidade = $_POST["cidade"];
    $sexo = $_POST["sexo"];

    // Prevenir injeção de SQL (usando instruções preparadas)
    $stmt = $conn->prepare("INSERT INTO cadastro_clientes (nome, cpf, data_nascimento, celular, cidade, sexo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $cpf, $data_nascimento, $celular, $cidade, $sexo);

    // Executar a inserção
    if ($stmt->execute()) {
        // Redirecionar para cadastro.html após o cadastro bem-sucedido
        header("Location: cadastro.html");
        exit(); // Certifique-se de que o script seja encerrado após o redirecionamento
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    // Fechar a instrução preparada
    $stmt->close();
} else {
    echo "Método de requisição inválido";
}

// Fechar a conexão
$conn->close();
?>
