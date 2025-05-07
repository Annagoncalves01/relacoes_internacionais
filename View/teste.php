<?php
session_start();

// Incluindo os arquivos necessários
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\Controller\UsuarioController.php';
require_once '../Model/perguntas.php';
require_once '../Model/TesteModel.php';
require_once '../Controller/TesteController.php';
require_once '../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Obtendo dados do usuário
$usuarioController = new UsuarioController($pdo);
$usuario = $usuarioController->listarUsuarioPorID($_SESSION['user_id']);
$foto_perfil = !empty($usuario['foto_perfil']) ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']) : '../img/perfil.png';

// Inicializa controlador do teste
$testeController = new TesteController($pdo);

// Verifica se o usuário já fez o teste
$resultadoExistente = false;
$user_id = $_SESSION['user_id'];
$resultados = $testeController->mostrarResultados($user_id);
if (!empty($resultados)) {
    $resultadoExistente = true;
}

// Inicializa respostas se ainda não existirem
if (!isset($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

// Índice da pergunta
$indice = isset($_GET['pergunta']) ? (int)$_GET['pergunta'] : 0;

// Lógica de navegação e salvamento de resposta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salva a resposta da pergunta atual, se houver
    if (isset($_POST['resposta'])) {
        $_SESSION['respostas'][$indice] = $_POST['resposta'];
    }

    if (isset($_POST['acao']) && $_POST['acao'] === 'anterior') {
        $indice = max(0, $indice - 1);
    } elseif (isset($_POST['acao']) && $_POST['acao'] === 'proxima') {
        $indice++;
    }
}


// Verifica se ainda há perguntas para exibir
if ($indice < count($perguntas)) {
    $pergunta = $perguntas[$indice];

    $sql = "SELECT texto FROM respostas WHERE pergunta_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$indice + 1]); // Ajuste aqui para pegar as respostas certas
    $alternativas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $letras = ['A', 'B', 'C', 'D'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Personalidade</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="header">
    <div class="header-logo">
        <a href="../site.php">
            <img src="../img/download.png" alt="Logotipo Global Pathway">
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="../profissao.php">Sobre a Profissão</a></li>
            <li><a href="usuario/editar.php">Sobre Mim</a></li>
            <li><a href="teste.php">Teste de Personalidade</a></li>
            <li><a href="planejamento.php">Planejamento</a></li>
        </ul>
    </nav>
    <div class="header-buttons">
        <a href="usuario/editar.php" class="avatar" title="Meu Perfil">
            <img src="<?= $foto_perfil ?>" alt="Avatar do Usuário">
        </a>
        <a href="../index.php" class="logout-button" title="Sair">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
        </a>
    </div>
</header>

<div class="main-content">
    <div class="pergunta"><?= htmlspecialchars($pergunta) ?></div>

    <form method="POST" action="?pergunta=<?= $indice ?>">
    <div class="respostas">
        <?php foreach ($alternativas as $i => $alt): 
            $letra = $letras[$i];
            $respostaSelecionada = isset($_SESSION['respostas'][$indice]) && $_SESSION['respostas'][$indice] === $letra;
        ?>
            <input type="radio" id="resposta<?= $i ?>" name="resposta" value="<?= $letra ?>" <?= $respostaSelecionada ? 'checked' : '' ?> hidden>
            <label class="resposta" for="resposta<?= $i ?>" data-letra="<?= $letra ?>">
                <?= htmlspecialchars($alt['texto']) ?>
            </label>
        <?php endforeach; ?>
    </div>

    <div class="botao-container" style="display: flex; justify-content: center; gap: 20px; margin-top: 30px;">
        <?php if ($indice > 0): ?>
            <button class="botao" type="submit" name="acao" value="anterior">⬅ ANTERIOR</button>
        <?php endif; ?>
        <button class="botao" type="submit" name="acao" value="proxima">PRÓXIMA ➤</button>
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
                <li><a href="../profissao.php"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
                <li><a href="teste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
                <li><a href="planejamento.php"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
                <li><a href="metas.php"><i class="fa-solid fa-bullseye"></i> Estabelecendo Metas</a></li>
                <li><a href="usuario/editar.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                <li><a href="/relacoes_internacionais/index.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <?php if ($resultadoExistente): ?>
        <div style="text-align:center; margin-bottom: 30px;">
            <p>Você já realizou o teste anteriormente?</p>
            <br>
            <a href="testeinicio.php" class="botao" style="background-color:#800000; padding:10px 20px; color:white; text-decoration:none; border-radius:5px;">
                Ver Resultado do Teste
            </a>
        </div>
    <?php endif; ?>

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
        $resultado = $testeController->calcularResultadoFinal($user_id);
        $_SESSION['resultado'] = $resultado;
        unset($_SESSION['respostas'], $_SESSION['indice']);
        header('Location: testeinicio.php');
        exit;
    } else {
        echo "Usuário não autenticado.";
    }
}
?>
