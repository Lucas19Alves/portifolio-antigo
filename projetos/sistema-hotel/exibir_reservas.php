<?php
// Conectar ao banco de dados (ajuste as credenciais conforme necessário)
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "hotel_reservas";

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}

// Função para evitar injeção de SQL
function validar_dados($dados) {
    global $conexao;
    return mysqli_real_escape_string($conexao, $dados);
}

// Excluir reserva se a ação for 'delete' e um ID válido for fornecido
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_reserva = validar_dados($_GET['id']);
    $query_delete = "DELETE FROM reservas WHERE id = $id_reserva";

    if ($conexao->query($query_delete) === TRUE) {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Erro ao excluir reserva: " . $conexao->error;
    }
}

// Consultar reservas ordenadas por data
$query = "SELECT * FROM reservas ORDER BY data_entrada ASC";
$resultado = $conexao->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    <div class="container mt-5">
        <h2><a class="fa fa-arrow-alt-circle-left" href="index.php"></a> Reservas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Quantidade de Pessoas</th>
                    <th>Data de Entrada</th>
                    <th>Data de Saída</th>
                    <th>Valor por Pessoa</th>
                    <th>Número do Quarto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exibir resultados da consulta
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['quantidade_pessoas']}</td>
                            <td>{$row['data_entrada']}</td>
                            <td>{$row['data_saida']}</td>
                            <td>{$row['valor_por_pessoa']}</td>
                            <td>{$row['numero_quarto']}</td>
                            <td><a href='{$_SERVER['PHP_SELF']}?action=delete&id={$row['id']}' class='btn btn-danger btn-sm'>Excluir</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Adicione o link para o JavaScript e o jQuery do Bootstrap no final do corpo -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fechar a conexão
$conexao->close();
?>
