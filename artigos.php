<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/UsuarioController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

$usuarioController = new UsuarioController($pdo);
$usuario = $usuarioController->listarUsuarioPorID($_SESSION['user_id']);
$foto_perfil = !empty($usuario['foto_perfil']) ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']) : 'img/perfil.png';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Relações Internacionais</title>
  <link rel="stylesheet" href="estilo.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
</head>
<body >
  <header class="header">
    <div class="header-logo">
      <a href="site.php">
        <img src="img/download.png" alt="Logotipo Global Pathway" style="height: 100px; object-fit: contain;" />
      </a>
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="#profissao">Sobre a Profissão</a></li>
        <li><a href="View/usuario/editar.php">Sobre Mim</a></li>
        <li><a href="View/testeinicio.php">Teste de Personalidade</a></li>
      </ul>
    </nav>
    <div class="header-buttons">
      <a href="View/usuario/editar.php" class="avatar" title="Meu Perfil">
        <img src="<?php echo $foto_perfil; ?>" alt="Avatar do Usuário" />
      </a>
      <a href="index.php" class="logout-button" title="Sair">
        <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
      </a>
    </div>
  </header>

  <section class="articles-section">
    <h1 class="section-title"><i class="fas fa-globe-americas"></i> Artigos</h1>

    <div class="article-card-horizontal">
      <img src="img/armenia.jpeg" alt="Imagem Armênia" class="article-side-image" />
      <div class="article-content-box">
        <h3 class="article-title"><i class="fas fa-dove"></i> Armênia discute esforços para uma paz duradoura</h3>
        <p class="article-source"><i class="fas fa-link"></i> Fonte: brasildefato.com.br</p>
        <p class="article-excerpt">
          O porta-voz da Armênia abordou as negociações internacionais e os desafios da paz na região, destacando o papel da ONU e OSCE no diálogo entre fronteiras.
        </p>
      </div>
    </div>

    <div class="article-card-horizontal">
      <div class="article-content-box">
        <h3 class="article-title"><i class="fas fa-user-graduate"></i> Relações Internacionais: carreira multidisciplinar e global</h3>
        <p class="article-source"><i class="fas fa-link"></i> Fonte: guiadoestudante.abril.com.br</p>
        <p class="article-excerpt">
          A área envolve diplomacia, economia e direitos humanos. Profissionais atuam em ONGs, organismos internacionais e empresas multinacionais.
        </p>
      </div>
      <img src="img/bandeiras.png" alt="Imagem Bandeiras" class="article-side-image" />
    </div>

    <div class="article-card-horizontal">
      <img src="img/emmanuelmacron.jpg" alt="Imagem Macron" class="article-side-image" />
      <div class="article-content-box">
        <h3 class="article-title"><i class="fas fa-handshake"></i> Presidente Lula reúne-se com Emmanuel Macron em Nova York</h3>
        <p class="article-source"><i class="fas fa-link"></i> Fonte: agenciabrasil.ebc.com.br</p>
        <p class="article-excerpt">
          Lula e Macron discutiram cooperação em clima, educação e segurança internacional, fortalecendo laços entre Brasil e França.
        </p>
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
          <li><a href="#teste"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
          <li><a href="#planejamento"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
          <li><a href="perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
          <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?php echo date("Y"); ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
  </footer>
</body>
</html>
