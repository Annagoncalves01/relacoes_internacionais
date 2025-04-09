<?php 
session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php?route=login");
// }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relações Internacionais</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://kit.fontawesome.com/0e1db7a7c0.js" crossorigin="anonymous"></script>
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
                <li><a href="#sobre">Sobre Mim</a></li>
                <li><a href="#teste">Teste de Personalidade</a></li>
            </ul>
        </nav>
        <div class="header-buttons">
    <a href="perfil.php" class="perfil-button" title="Meu Perfil">
        <i class="fa-solid fa-user"></i> <span>Perfil</span>
    </a>
    <a href="logout.php" class="logout-button" title="Sair">
        <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
    </a>
</div>

</header>

    <main>
        <section class="imagem-destaque">
            <img src="img/relacoes.png" alt="Imagem ilustrativa entre o banner e a profissão">
        </section>

        <section id="profissao" class="section-profissao">
            <div class="text">
                <h2>Profissão</h2>
                <p>Sou Anna Clara, estudante do SESI SENAI, e me identifico com Relações Internacionais...</p>
                <p>Meu objetivo é unir tecnologia e conhecimento para ajudar as pessoas...</p>
            </div>
            <div class="image">
                <img src="img/mundo.png" alt="Globo com bandeiras representando a globalização">
            </div>
        </section>

        <section id="sobre" class="depoimento">
            <div class="depoimento-box">
                <img src="img/senai.png" alt="Logo SENAI" class="logo-senai">
                <p>O curso de Desenvolvimento de Sistemas do SENAI me proporcionou uma base sólida...</p>
                <img src="img/onu.png" alt="Logo ONU" class="logo-onu">
            </div>
        </section>

        <section class="artigos">
            <h2>Artigos</h2>
            <div class="artigos-container">
                <a href="artigo1.html" class="artigo">
                    <img src="img/anna.png" alt="Imagem Anna Clara">
                    <p><strong>Entrevista: Anna Clara</strong><br>Como surgiu o interesse por Relações Internacionais.</p>
                </a>
                <a href="artigo2.html" class="artigo">
                    <img src="img/bandeiras.png" alt="Bandeiras de países">
                    <p><strong>Relações Internacionais, Conflitos e Comércio Exterior</strong><br>Entenda os impactos das decisões globais.</p>
                </a>
                <a href="artigo3.html" class="artigo">
                    <img src="img/macron.png" alt="Presidente Macron">
                    <p><strong>Presidente da França: Macron</strong><br>A importância da diplomacia contemporânea.</p>
                </a>
            </div>
        </section>

        <section class="g20">
            <img src="img/g20.png" alt="Logo do G20 com bandeiras">
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col contatos">
                <h4>CONTATOS</h4>
                <p><i class="fa-solid fa-phone" style="color: red;"></i> <span>Telefone</span></p>
                <p><i class="fa-solid fa-envelope" style="color: red;"></i> <span>Email</span></p>
            </div>
            <div class="footer-col logo">
                <img src="img/logo-global-pathway.png" alt="Logo Global Pathway" />
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
            <p>Global Pathway | Anna Clara Gonçalves</p>
        </div>
    </footer>

</body>
</html>
