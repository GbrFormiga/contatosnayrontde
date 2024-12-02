<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO contato (nome, email, telefone) VALUES (:nome, :email, :telefone)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Contato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adicionar Novo Contato</h1>
    
    <form method="POST" action="create.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required>

        <button type="submit">Adicionar</button>
    </form>
</body>
</html>
