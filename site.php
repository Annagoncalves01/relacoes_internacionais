<?php 

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?route=login");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relações Internacionais</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script> <!-- Ícones FontAwesome -->
</head>
<body>

    <!-- Cabeçalho -->
    <header class="header">
        <!-- Logo -->
        <div class="header-logo">
            <a href="index.html">
                <img src="img/download.png" alt="Logotipo Global Pathway">
            </a>
        </div>

        <!-- Navbar centralizada -->
        <nav class="navbar">
            <ul>
                <li><a href="#profissao">Sobre a Profissão</a></li>
                <li><a href="#sobre">Sobre Mim</a></li>
                <li><a href="#teste">Teste de Personalidade</a></li>
            </ul>
        </nav>

        <!-- Botões no canto direito -->
        <div class="header-buttons">
            <i class="fa-solid fa-user user-icon"></i> <!-- Ícone de usuário -->
            <a href="index.php?route=logout" class="logout-button">Sair</a>
        </div>
    </header>

    <!-- Seção Principal -->
    <main>
        <section class="hero">
            <div class="overlay">
                <h1>Relações Internacionais</h1>
            </div>
        </section>

        <!-- Sobre a Profissão -->
        <section id="profissao" class="section-profissao">
            <div class="text">
                <h2>Profissão</h2>
                <p>
                    Sou Anna Clara, estudante do SESI SENAI, e me identifico com Relações Internacionais, 
                    área que envolve diplomacia, comércio exterior e cooperação global. Com uma formação 
                    multidisciplinar em política, economia e direito, os profissionais da área negociam 
                    acordos, analisam cenários e mediam conflitos.
                </p>
                <p>
                    Meu objetivo é unir tecnologia e conhecimento para ajudar as pessoas a tomarem 
                    decisões conscientes sobre suas vidas e carreiras em um mundo globalizado.
                </p>
            </div>
            <div class="image">
                <img src="img/mundo.png" alt="Globo com bandeiras representando a globalização">
            </div>
        </section>
    </main>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2025 Global Pathway - Todos os direitos reservados.</p>
    </footer>

</body>
</html>
