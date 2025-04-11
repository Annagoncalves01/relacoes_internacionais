<?php
session_start();
require_once '../Model/perguntas.php'; // Certifique-se de que este arquivo define $perguntas
require_once '../Model/TesteModel.php';
require_once '../Controller/TesteController.php';
require_once '../config.php';

$controller = new TesteController($pdo);
$indice = isset($_GET['pergunta']) ? (int)$_GET['pergunta'] : 0;

// Iniciar o array de respostas na sessão
if (!isset($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

// Registrar resposta atual e passar para a próxima
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
    $resposta = $_POST['resposta'];
    $_SESSION['respostas'][] = $resposta;
    $indice++;
}

if ($indice < count($perguntas)) {
    $pergunta = $perguntas[$indice];

    $sql = "SELECT texto FROM respostas WHERE pergunta_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$indice + 1]);
    $alternativas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $letras = ['A', 'B', 'C', 'D'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste de Personalidade</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="header">
    <div class="header-logo">
        <a href="index.php">
            <img src="../img/download.png" alt="Logotipo Global Pathway">
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="#profissao">Sobre a Profissão</a></li>
            <li><a href="usuario/editar.php">Sobre Mim</a></li>
            <li><a href="teste.php">Teste de Personalidade</a></li>
        </ul>
    </nav>
    <div class="header-buttons">
        <a href="usuario/sobre.php" class="avatar" title="Meu Perfil">
            <img src="<?= isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/perfil.png'; ?>" alt="Avatar do Usuário">
        </a>
        <a href="logout.php" class="logout-button" title="Sair">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
        </a>
    </div>
</header>

<div class="main-content">
    <div class="pergunta"><?= htmlspecialchars($pergunta) ?></div>

    <form method="POST" action="?pergunta=<?= $indice ?>">
        <div class="respostas">
            <?php foreach ($alternativas as $i => $alt): ?>
                <input type="radio" id="resposta<?= $i ?>" name="resposta" value="<?= $letras[$i] ?>" required hidden>
                <label class="resposta" for="resposta<?= $i ?>" data-letra="<?= $letras[$i] ?>">
                    <?= htmlspecialchars($alt['texto']) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="botao-container">
            <button class="botao" type="submit">PRÓXIMA ➤</button>
        </div>
    </form>
</div>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-col contatos">
            <h4>CONTATOS</h4>
            <p><i class="fa-solid fa-phone"></i> <span>(11) 98765-4321</span></p>
            <p><i class="fa-solid fa-envelope"></i> <span>contato@globalpathway.com</span></p>
        </div>
        <div class="footer-col logo">
            <img src="../img/download.png" alt="Logo Global Pathway" />
        </div>
        <div class="footer-col links">
            <h4>LINKS RÁPIDOS</h4>
            <ul>
                <li><a href="#profissao"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
                <li><a href="teste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
                <li><a href="#planejamento"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
                <li><a href="perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date("Y") ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
<?php
} else {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $resultado = $controller->calcularResultadoFinal($user_id);
        $_SESSION['resultado'] = $resultado;
        unset($_SESSION['respostas'], $_SESSION['indice']);
        header('Location: resultado_teste.php');
        exit;
             
    } else {
        echo "Usuário não autenticado.";
    }
}
?>
