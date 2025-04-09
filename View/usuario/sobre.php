
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sobre mim</title>
</head>
<body>
<header class="header">
    <div class="header-logo">
        <a href="index.html">
            <img src="img/download.png" alt="Logotipo Global Pathway" style="height: 100px; max-height: 100%; object-fit: contain;">
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="#profissao">Sobre a Profissão</a></li>
            <li><a href="View/usuario/sobre.php">Sobre Mim</a></li>
            <li><a href="#teste">Teste de Personalidade</a></li>
        </ul>
    </nav>
    <div class="header-buttons">
        <a href="View/usuario/sobre.php" class="avatar" title="Meu Perfil">
            <img src="img/perfil.png" alt="Avatar do Usuário">
        </a>
        <a href="index.php" class="logout-button" title="Sair">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
        </a>
    </div>
</header>

<div class="container">
    <div class="avatar-circulo">
        <img src="<?= isset($usuario['foto_perfil']) && $usuario['foto_perfil'] ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']) : 'img/perfil.png' ?>" alt="Foto de Perfil">
    </div>

    <div class="linha-vertical"></div>

    <div class="sobre-bloco">
        <h2>SOBRE MIM</h2>

        <!-- MENSAGEM DE SUCESSO -->
        <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
            <div class="mensagem-sucesso">
                <p>Seu texto foi salvo com sucesso!</p>
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO SOBRE MIM -->
        <form action="salvar_sobre.php" method="post">
            <textarea name="sobre_mim" rows="12" placeholder="Escreva algo sobre você..." 
                style="width:100%; padding: 15px; border-radius: 10px; resize: none; height: 220px;"><?= isset($usuario['sobre_mim']) ? htmlspecialchars($usuario['sobre_mim']) : '' ?></textarea>
            <button type="submit" class="botao">SALVAR</button>
        </form>

        <!-- EDITAR DADOS -->
        <form action="editar.php" method="get">
            <button type="submit" class="botao">EDITAR DADOS</button>
        </form>

        <!-- VOLTAR AO INÍCIO -->
        <form action="dashboard.php" method="get">
            <button type="submit" class="botao botao-voltar">Voltar ao Início</button>
        </form>
    </div>
</div>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-col contatos">
            <h4>CONTATOS</h4>
            <p><i class="fa-solid fa-phone"></i> <span>(11) 98765-4321</span></p>
            <p><i class="fa-solid fa-envelope"></i> <span>contato@globalpathway.com</span></p>
        </div>
        <div class="footer-col logo">
            <img src="img/download.png" alt="Logo Global Pathway" />
        </div>
        <div class="footer-col links">
            <h4>LINKS RÁPIDOS</h4>
            <ul>
                <li><a href="#profissao"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
                <li><a href="#teste"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
                <li><a href="#planejamento"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
                <li><a href="perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date("Y"); ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
</footer>
</body>
</html>
