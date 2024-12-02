<?php
include 'conexao.php';

// Ve se o id ta sendo passada na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // pega o id

    // Ve se o ID é válido 
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        // Usa a query para excluir o contato com aquele ID específico
        $sql = "DELETE FROM contato WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Executa a query
        if ($stmt->execute()) {
            header("Location: index.php");  // volta pra pagina inicial
            exit;
        } else {
            echo "Erro ao excluir o contato.";
        }
    } else {
        echo "ID inválido.";
    }
} else {
    echo "Nenhum ID foi fornecido.";
}
?>
