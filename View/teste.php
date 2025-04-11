<?php
session_start();
require_once '../Model/perguntas.php';
require_once '../Model/TesteModel.php';
require_once '../Controller/TesteController.php';
require_once '../config.php';

// Cria a instância do controller
$controller = new TesteController($pdo);

// Recupera o índice da pergunta atual
$indice = isset($_GET['pergunta']) ? (int)$_GET['pergunta'] : 0;

// Se não existir sessão para respostas, cria
if (!isset($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

// Se chegou via POST (resposta da pergunta anterior)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resposta = $_POST['resposta'];
    $_SESSION['respostas'][] = $resposta;
    $indice++; // Vai para a próxima pergunta
}

// Verifica se ainda há perguntas
if ($indice < count($perguntas)) {
    $pergunta = $perguntas[$indice];
    ?>
    <form method="POST" action="?pergunta=<?= $indice ?>">
        <h3><?= $pergunta ?></h3>
        <label><input type="radio" name="resposta" value="A" required> A</label><br>
        <label><input type="radio" name="resposta" value="B"> B</label><br>
        <label><input type="radio" name="resposta" value="C"> C</label><br>
        <label><input type="radio" name="resposta" value="D"> D</label><br>
        <button type="submit">Próxima</button>
    </form>
    <?php
} else {
    // Fim do teste — salva no banco e redireciona
    $user_id = $_SESSION['user_id']; // Certifique-se de que esse valor está setado ao logar
    $controller->processarTeste($user_id, $_SESSION['respostas']);
    unset($_SESSION['respostas']); // limpa para novo teste
}
?>
