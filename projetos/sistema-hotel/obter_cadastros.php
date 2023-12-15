<?php
include 'conexao.php';

$query = "SELECT * FROM cadastro_clientes";
$result = mysqli_query($conn, $query);

header('Content-Type: application/json'); // Indica que o conteúdo é JSON

if ($result) {
    $cadastros = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cadastros[] = $row;
    }

    mysqli_free_result($result);

    echo json_encode($cadastros);
    die(); // Interrompe a execução após enviar o JSON
} else {
    echo json_encode(['error' => 'Erro ao obter cadastros']);
}

mysqli_close($conn);
?>
