<?php
session_start();

require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\Controller\UsuarioController.php';
require_once '../Model/perguntas.php';
require_once '../Model/TesteModel.php';
require_once '../Controller/TesteController.php';
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$usuarioController = new UsuarioController($pdo);
$usuario = $usuarioController->listarUsuarioPorID($user_id);
$foto_perfil = !empty($usuario['foto_perfil']) ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']) : '../img/perfil.png';

$testeController = new TesteController($pdo);
$resultados = $testeController->mostrarResultados($user_id);
$resultadoExistente = !empty($resultados);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste de Personalidade</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
</head>
<body class="teste">

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
            <li><a href="inicioteste.php">Teste de Personalidade</a></li>
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
<body class="teste">
    <div class="tela-inicial">
        <div class="bloco-branco">
            <h1 class="titulo-principal">TESTE DE PERSONALIDADE</h1>
            <p>Descubra seu caminho no mundo global</p>
            <a href="teste.php?pergunta=0" class="botao-iniciar">INICIAR TESTE➜</a>
        </div>
    </div>
</body>



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
                <li><a href="inicioteste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
                <li><a href="planejamento.php"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
                <li><a href="metas.php"><i class="fa-solid fa-bullseye"></i> Estabelecendo Metas</a></li>
                <li><a href="usuario/editar.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                <li><a href="/relacoes_internacionais/index.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>

    <?php if ($resultadoExistente): ?>
        <div style="text-align:center; margin-top: 40px;">
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
