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
$foto_perfil = !empty($usuario['foto_perfil'])
    ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil'])
    : '../img/perfil.png';

// Buscar dados salvos de autoconhecimento
$stmt = $pdo->prepare("SELECT * FROM autoconhecimento WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$planejamento = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planejamento do Futuro</title>
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
    </ul>
  </nav>
  <div class="header-buttons">
    <a href="usuario/editar.php" class="avatar" title="Meu Perfil">
      <img src="<?= htmlspecialchars($foto_perfil) ?>" alt="Avatar do Usuário">
    </a>
    <a href="../index.php" class="logout-button" title="Sair">
      <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
    </a>
  </div>
</header>

<main>
  <form action="salvar_planejamento.php" method="POST">
    <h1 class="titulo-pagina">Planejamento do Futuro ✈︎ </h1>

    <div class="aspiracoes-layout">
      <img src="../img/aviao.jpg" alt="Imagem avião" class="img-aspiracao">
      <img src="../img/bussola2.png" alt="Imagem bússola" class="img-aspiracao">
    </div>

    <div class="blocos-sonhos">
      <div class="bloco-autoconhecer">
        <div class="icone-topo">
          <img src="../img/sonhos.webp" alt="Ícone Sonhos Hoje">
        </div>
        <br>
        <h3>SE AUTOCONHECER</h3>
        <div id="sonhos-container">
          <div class="sonho-item">
            <p><strong>O autoconhecimento é fundamental para o nosso crescimento pessoal e profissional. Ele nos permite compreender nossas emoções, habilidades, desafios e metas, ajudando a tomar decisões mais conscientes e alinhadas com nossos objetivos. Investir em autoconhecimento é dar um passo importante rumo a uma vida mais plena e realizada.</strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="sessaos">
      <h3>Autoconhecimento</h3>

      <?php
      function campo($label, $name, $value = '', $placeholder = '') {
          echo "<div class='campo'>
              <label for='{$name}'>{$label}</label>
              <textarea name='{$name}' id='{$name}' placeholder='{$placeholder}'>" . htmlspecialchars($value) . "</textarea>
            </div>";
      }

      campo("Minhas Forças Pessoais", "forcas_pessoais", $planejamento['forcas_pessoais'] ?? '', "Descreva suas forças pessoais...");
      campo("Meus Valores Pessoais", "valores_pessoais", $planejamento['valores_pessoais'] ?? '', "Descreva seus valores...");
      campo("Minhas Habilidades", "habilidades", $planejamento['habilidades'] ?? '', "Liste suas habilidades...");
      campo("Meus Interesses", "interesses", $planejamento['interesses'] ?? '', "Descreva seus interesses...");
      campo("O que me motiva?", "motivacoes", $planejamento['motivacoes'] ?? '', "Descreva suas motivações...");
      campo("Ambiente de trabalho ideal", "ambiente_ideal", $planejamento['ambiente_ideal'] ?? '', "Como seria o ambiente ideal de trabalho para você?");
      campo("Pessoas que me inspiram", "pessoas_inspiradoras", $planejamento['pessoas_inspiradoras'] ?? '', "Quem são suas referências?");
      ?>
    </div>

    <div style="text-align: center; margin: 20px 0;">
      <button type="submit" class="btn-salvar" style="padding: 10px 20px; background: #a00; color: white; border: none; border-radius: 5px;">Salvar Resposta</button>
    </div>
  </form>
</main>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-col contatos">
      <h4>CONTATOS</h4>
      <p><i class="fa-solid fa-phone"></i> (11) 98765-4321</p>
      <p><i class="fa-solid fa-envelope"></i> contato@globalpathway.com</p>
    </div>
    <div class="footer-col logo">
      <img src="../img/download.png" alt="Logo Global Pathway">
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
  <div class="footer-bottom">
    <p>&copy; <?= date("Y") ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
  </div>
</footer>

</body>
</html>
