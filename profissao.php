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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profissão</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0e1db7a7c0.js" crossorigin="anonymous"></script>
</head>
<body class="profissao">
    <header class="header">
        <div class="header-logo">
            <a href="site.php">
                <img src="img/download.png" alt="Logotipo Global Pathway" style="height: 100px; max-height: 100%; object-fit: contain;">
            </a>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="site.php">Início</a></li>
                <li><a href="View/usuario/editar.php">Sobre Mim</a></li>
                <li><a href="View/inicioteste.php">Teste de Personalidade</a></li>
                <li><a href="View/planejamento.php">Planejamento</a></li>

            </ul>
        </nav>
        <div class="header-buttons">
            <a href="View/usuario/editar.php" class="avatar" title="Meu Perfil">
                <img src="<?php echo $foto_perfil; ?>" alt="Avatar do Usuário">
            </a>
            <a href="index.php" class="logout-button" title="Sair">
                <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
            </a>
        </div>
    </header>
    <br><br><br>
    <h1 class="titulo-com-brilho"><i class="fas fa-globe-americas"></i> Relações Internacionais</h1>



    <div class="slidecontainer">
  <div class="slider">
    <div class="slides">
      <input type="radio" name="radio-btn" id="radio1" checked>
      <input type="radio" name="radio-btn" id="radio2">
      <input type="radio" name="radio-btn" id="radio3">
      <input type="radio" name="radio-btn" id="radio4">

      <div class="slide first">
        <img src="img/glob.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/globs.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/globoo.jpg" alt="">
      </div>
      <div class="slide">
        <img src="img/re.jpg" alt="">
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
<section class="areas-atuacao">
    <h2 class="titulo-brilhante">ÁREAS DE ATUAÇÃO</h2>
    <div class="cards-atuacao">
        <div class="card">
            <div class="bola-decorativa"></div>
            <br>
            <h3>Diplomacia</h3>
            <img src="img/diplomaciaa.png" alt="Diplomacia">
        </div>
        <div class="card">
            <div class="bola-decorativa"></div>            <br>

            <h3>Comércio Exterior</h3>
            <img src="img/comercio.png" alt="Comércio Exterior">
        </div>
        <div class="card">
            <div class="bola-decorativa"></div>            <br>

            <h3>Embaixadas</h3>
            <img src="img/embaixadas.png" alt="Embaixadas">
        </div>
    </div>
    <div class="cards-atuacao linha2">
        <div class="card">
            <div class="bola-decorativa"></div>            <br>

            <h3>Gestão de Turismo</h3>
            <img src="img/turismo.jpg" alt="Gestão de Turismo">
        </div>
        <div class="card">
            <div class="bola-decorativa"></div>            <br>

            <h3>Contraterrorismo</h3>
            <img src="img/contraterrorismo.png" alt="Contraterrorismo">
        </div>
    </div>
</section>      <hr> <h2 class="titulo-brilhante">
  <i class="fas fa-user-tie"></i> PROFISSIONAL DE RELAÇÕES INTERNACIONAIS
</h2>
<div class="profissao-container">
  <img src="img/download (2).png" alt="Imagem esquerda" class="imagem-lateral">

  <section class="descricao-profissao">
    <p class="texto-descritivo">
      O profissional de Relações Internacionais atua promovendo o diálogo entre nações, organizações e culturas. Com um olhar estratégico e diplomático, ele analisa cenários políticos e econômicos, participa de negociações e constrói pontes para cooperação internacional.
    </p>
    <p class="texto-descritivo">
      Sua atuação vai desde embaixadas e organismos multilaterais até empresas globais, ONGs e institutos de pesquisa. Conhecimento em direito internacional, política externa, idiomas e cultura global é essencial para essa carreira dinâmica e impactante.
    </p> 
  </section> 
</div>



    <div class="carreiras-interativas">
        <h3>ÁREAS DE ATUAÇÃO:</h3>
        <div class="botoes-carreira">
            <button onclick="mostrarDescricao('graduando')">Graduando</button>
            <button onclick="mostrarDescricao('analista')">Analista Júnior</button>
            <button onclick="mostrarDescricao('assessor')">Assessor Internacional</button>
            <button onclick="mostrarDescricao('diplomata')">Diplomata / Consultor Global</button>
        </div>
        <div id="descricao-carreira" class="descricao-texto"></div>
    </div>
</section>

<br><br>

<section class="video-section"><h2 class="titulos-brilhante">CONFIRA UM VÍDEO</h2>
    <div class="video-overlay">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/T7P3cERH9S0?si=9bK7VJCvQ4uh5MZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
            <li><a href="profissao.php"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
        <li><a href="View/inicioteste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
        <li><a href="View/planejamento.php"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
        <li><a href="View/metas.php"><i class="fa-solid fa-bullseye"></i> Estabelecendo Metas</a></li>
        <li><a href="usuario/editar.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
</footer>

<script>
  // Script do slider automático
  let count = 1;
  document.getElementById("radio1").checked = true;

  setInterval(function () {
    count++;
    if (count > 4) {
      count = 1;
    }
    document.getElementById("radio" + count).checked = true;
  }, 2500);

  // Script das descrições de carreira
  function mostrarDescricao(cargo) {
    const descricoes = {
      graduando: "Como graduando, você pode iniciar sua jornada com estágios em ONGs, consulados ou centros de pesquisa. Essa é a fase de explorar áreas e ganhar experiência prática.",
      analista: "O Analista Júnior atua em empresas ou instituições internacionais, auxiliando em negociações, relatórios e estudos de mercado global.",
      assessor: "O Assessor Internacional representa organizações ou governos em fóruns multilaterais, analisando cenários e propondo estratégias internacionais.",
      diplomata: "O Diplomata ou Consultor Global atua diretamente em embaixadas, organismos como a ONU ou OMC, liderando negociações e promovendo os interesses nacionais."
    };

    document.getElementById("descricao-carreira").textContent = descricoes[cargo] || "";
  }
</script>




               

         
</div>
</body>


</html>