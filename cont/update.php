<?php
include 'conexao.php';

$id = $_GET['id'];
$sql = "SELECT * FROM contato WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE contato SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'id' => $id]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $usuario['nome'] ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $usuario['email'] ?>" required>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= $usuario['telefone'] ?>">
        <button type="submit">Salvar</button>
    </form>
</body>
</html>