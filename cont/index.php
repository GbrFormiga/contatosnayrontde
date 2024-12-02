<?php
include 'conexao.php';

// Verificar se foi realizada uma busca e filtrar os contatos
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM contato WHERE nome LIKE :searchTerm";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['searchTerm' => "%$searchTerm%"]);
} else {
    // Caso não haja filtro, pega todos os contatos
    $sql = "SELECT * FROM contato";
    $stmt = $pdo->query($sql);
}

$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contatos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Contatos</h1>

    <!-- Barra de pesquisa-->
    <form method="GET" action="index.php">
        <input type="text" name="search" id="search" placeholder="Pesquisar por nome..." value="<?= htmlspecialchars($searchTerm) ?>">
    </form>

    <!-- Botão de Adicionar Novo -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="create.php">
            <button class="adicionar">Adicionar Novo</button>
        </a>
    </div>

    <!--Tabela de contatos -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nome'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= $usuario['telefone'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $usuario['id'] ?>">Editar</a>
                        <a href="delete.php?id=<?= $usuario['id'] ?>" class="delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
