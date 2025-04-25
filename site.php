<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\Controller\UsuarioController.php';
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\config.php';

$usuarioController = new UsuarioController($pdo);
$usuario = $usuarioController->listarUsuarioPorID($_SESSION['user_id']);
$foto_perfil = !empty($usuario['foto_perfil']) ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']) : 'img/perfil.png';
?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relações Internacionais</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0e1db7a7c0.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="header">
        <div class="header-logo">
            <a href="site.php">
                <img src="img/download.png" alt="Logotipo Global Pathway" style="height: 100px; max-height: 100%; object-fit: contain;">
            </a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="#profissao">Sobre a Profissão</a></li>
                <li><a href="View/usuario/editar.php">Sobre Mim</a></li>
                <li><a href="View/teste.php">Teste de Personalidade</a></li>
            </ul>
        </nav>
        <div class="header-buttons">
            <a href="View/usuario/editar.php" class="avatar" title="Meu Perfil">
                <!-- Usando $foto_perfil para mostrar a imagem do avatar -->
                <img src="<?php echo $foto_perfil; ?>" alt="Avatar do Usuário">
            </a>
            <a href="index.php" class="logout-button" title="Sair">
                <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
            </a>
        </div>
    </header>

    <main>
        <section class="imagem-destaque">
            <img src="img/relacoes.png" alt="Imagem ilustrativa entre o banner e a profissão">
        </section>
        <section id="profissao" class="section-profissao fade-in">
    <div class="container-profissao">
        <div class="text-profissao">
            <h2>Profissão</h2>
            <p>
                Sou Anna Clara, estudante do SESI SENAI, e me identifico com Relações Internacionais, área que envolve diplomacia,
                comércio exterior e cooperação global. Com uma formação multidisciplinar em política, economia e direito, os profissionais
                da área negociam acordos, analisam cenários e mediam conflitos.
            </p>
            <p>
                Meu objetivo é unir tecnologia e conhecimento para ajudar as pessoas a tomarem decisões conscientes sobre suas vidas
                e carreiras em um mundo globalizado.
            </p>
        </div>

        <div class="polaroid-group">
            <div class="polaroid polaroid-1">
                <img src="img/globo.png" alt="Imagem 1">
            </div>
            <div class="polaroid polaroid-2">
                <img src="img/mundo-global.jpg" alt="Imagem 2">
            </div>
        </div>
    </div>
</section>

<section id="sobre" class="depoimento">
    <div class="logo-container fade-in-delay">
        <img src="img/senai.png" alt="Logo SENAI" class="logo-senai">
    </div>

    <div class="depoimento-box fade-in">
        <p>
            Estudar <strong>Desenvolvimento de Sistemas no SENAI</strong> foi uma experiência transformadora. Conquistei uma base sólida em <strong>programação, bancos de dados</strong> e estruturação de software, aprendendo a desenvolver aplicações web modernas com <strong>PHP, MySQL e arquitetura MVC</strong>.
        </p>
        <p>
            Essa jornada me preparou para projetos reais, como o <strong>sistema sobre Relações Internacionais</strong> que estou criando, com foco em <strong>autoconhecimento, planejamento de futuro</strong> e impacto social.
        </p>
    </div>

    <div class="logo-container fade-in-delay">
        <img src="img/onu.png" alt="Logo ONU" class="logo-onu">
    </div>
</section>

<section class="artigos">
    <h2>Artigos</h2>
    <div class="artigos-container">
        <div class="artigo">
            <img src="img/armenia.jpeg" alt="Imagem Anna Clara">
            <div class="artigo-texto">
                <p><strong>Porta-voz da Armênia discute relações internacionais e esforços para uma paz duradoura</strong></p>
                <span class="fonte">Fonte: brasildefato.com.br</span>
            </div>
        </div>

        <div class="artigo">
            <img src="img/bandeiras.png" alt="Bandeiras de países">
            <div class="artigo-texto">
                <p><strong>Relações Internacionais: conheça a carreira multidisciplinar ideal para quem busca desafios globais</strong></p>
                <span class="fonte">Fonte: guiadoestudante.abril.com.br</span>
            </div>
        </div>

        <div class="artigo">
            <img src="img/emmanuelmacron.jpg" alt="Presidente Macron">
            <div class="artigo-texto">
                <p><strong>Presidente Lula reúne-se com Emmanuel Macron em Nova York</strong></p>
                <span class="fonte">Fonte: agenciabrasil.ebc.com.br</span>
            </div>
        </div>
    </div>

    <div class="botao-container">
        <a href="artigos.php" class="botao-artigo">Saiba Mais</a>
    </div>
</section>



<div class="slidecontainer">
  <div class="slider">
    <div class="slides">
      <input type="radio" name="radio-btn" id="radio1" checked>
      <input type="radio" name="radio-btn" id="radio2">
      <input type="radio" name="radio-btn" id="radio3">
      <input type="radio" name="radio-btn" id="radio4">

      <div class="slide first">
        <img src="img/g20.png" alt="">
      </div>
      <div class="slide">
        <img src="img/diplomacia.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/politic.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/politica.jpg" alt="">
      </div>
    </div>
  </div>
</div>

<!-- AS BOLINHAS FICAM AQUI FORA -->
<div class="manual-navegacao">
  <label for="radio1" class="manual-btn"></label>
  <label for="radio2" class="manual-btn"></label>
  <label for="radio3" class="manual-btn"></label>
  <label for="radio4" class="manual-btn"></label>
</div>
</div>

</div>
</div>
<section class="cursos-ri">
<h2>Cursos</h2>
  <div class="cursos-container">
    <div class="curso">
      <img src="img/usp.png" alt="Imagem Anna Clara">
      <div class="curso-texto">
        <p>O curso de Relações Internacionais da USP tem enfoque multidisciplinar, formando profissionais para atuar em diplomacia, setor público e empresas globais.</p>
      </div>
    </div>
    <div class="curso">
      <img src="img/puc.png" alt="Bandeiras de países">
      <div class="curso-texto">
        <p>Pioneiro no Brasil, destaca-se pela abordagem humanista e crítica, preparando alunos para atuar em governo, empresas e ONGs.</p>
      </div>
    </div>
    <div class="curso">
      <img src="img/unb.jpg" alt="Presidente Macron">
      <div class="curso-texto">
        <p>A UnB é a única instituição federal do país a oferecer um Bacharel em Relações Internacionais e também é um centro de referência para a organização da área.</p>
      </div>
    </div>
  </div>
</section>


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
                <li><a href="View/teste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
                <li><a href="View/planejamento.php"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
                <li><a href="View/metas.php"><i class="fa-solid fa-bullseye"></i> Estabelecendo Metas</a></li>
                <li><a href="View/usuario/perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
</footer>

<script>
  let count = 1;
  document.getElementById("radio1").checked = true;

  setInterval(function () {
    count++;
    if (count > 4) {
      count = 1;
    }
    document.getElementById("radio" + count).checked = true;
  }, 2500);
</script>



               

         
</div>
</body>


</html>
