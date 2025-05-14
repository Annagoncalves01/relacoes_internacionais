<?php
session_start();
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/PlanoController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$planoController = new PlanoAcaoController($pdo);

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    echo "Meta não encontrada.";
    exit();
}

$id = $_GET['id'];
$meta = $planoController->buscarMetaPorId($id);

if (!$meta || $meta['user_id'] != $_SESSION['user_id']) {
    echo "Meta não encontrada ou não pertence ao usuário.";
    exit();
}

// Salvar alterações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaDescricao = $_POST['descricao'];
    $novoPasso = $_POST['passo'];
    $novoPrazo = $_POST['prazo'];

    $planoController->atualizarMeta($id, $novaDescricao, $novoPasso, $novoPrazo);
    header("Location: metas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Meta</title>
</head>
<body>
  <h2>Editar Meta</h2>
  <form method="post">
    <label>Área:</label>
    <input type="text" value="<?= htmlspecialchars($meta['area']) ?>" disabled><br>

    <label>Passo:</label>
    <input type="text" name="passo" value="<?= htmlspecialchars($meta['passo']) ?>" required><br>

    <label>Descrição:</label>
    <textarea name="descricao" required><?= htmlspecialchars($meta['descricao']) ?></textarea><br>

    <label>Prazo:</label>
    <input type="date" name="prazo" value="<?= htmlspecialchars($meta['prazo']) ?>" required><br>

    <button type="submit">Salvar Alterações</button>
    <a href="metas.php">Cancelar</a>
  </form>
</body>
</html>
