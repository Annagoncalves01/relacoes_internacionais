<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planejamento do Futuro</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

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
?>

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
    <a href="usuario/editar.php" class="avatar" title="Meu Perfil">
      <img src="<?= htmlspecialchars($foto_perfil) ?>" alt="Avatar do Usuário">
    </a>
    <a href="logout.php" class="logout-button" title="Sair">
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

      <div class="campo">
        <label for="forcas_pessoais">Minhas Forças Pessoais</label>
        <textarea name="forcas_pessoais" id="forcas_pessoais" placeholder="Descreva suas forças pessoais..."></textarea>
      </div>

      <div class="campo">
        <label for="valores_pessoais">Meus Valores Pessoais</label>
        <textarea name="valores_pessoais" id="valores_pessoais" placeholder="Descreva seus valores..."></textarea>
      </div>

      <div class="campo">
        <label for="habilidades">Minhas Habilidades</label>
        <textarea name="habilidades" id="habilidades" placeholder="Liste suas habilidades..."></textarea>
      </div>

      <div class="campo">
        <label for="interesses">Meus Interesses</label>
        <textarea name="interesses" id="interesses" placeholder="Descreva seus interesses..."></textarea>
      </div>

      <div class="campo">
        <label for="motivacoes">O que me motiva?</label>
        <textarea name="motivacoes" id="motivacoes" placeholder="Descreva suas motivações..."></textarea>
      </div>

      <div class="campo">
        <label for="ambiente_ideal">Ambiente de trabalho ideal</label>
        <textarea name="ambiente_ideal" id="ambiente_ideal" placeholder="Como seria o ambiente ideal de trabalho para você?"></textarea>
      </div>

      <div class="campo">
        <label for="pessoas_inspiradoras">Pessoas que me inspiram</label>
        <textarea name="pessoas_inspiradoras" id="pessoas_inspiradoras" placeholder="Quem são suas referências?"></textarea>
      </div>
    </div>

    <div style="text-align: center; margin: 20px 0;">
      <button type="submit" class="btn-salvar" style="padding: 10px 20px; background: #a00; color: white; border: none; border-radius: 5px;">Salvar Resposta</button>
    </div>
  </form>
</main>
<br><br><br>
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
        <li><a href="#profissao"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
        <li><a href="teste.php"><i class="fa-solid fa-brain"></i> Teste de Personalidade</a></li>
        <li><a href="planejamento.php"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
        <li><a href="metas.php"><i class="fa-solid fa-bullseye"></i> Estabelecendo Metas</a></li>
        <li><a href="usuario/editar.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; <?= date("Y") ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
  </div>
</footer>

<script>
// Função para adicionar novos campos para os sonhos
function adicionarSonho() {
  const container = document.getElementById('sonhos-container');
  const bloco = document.createElement('div');
  bloco.classList.add('sonho-item');
  bloco.style.marginBottom = '15px';
  bloco.innerHTML = `
    <input type="text" name="sonho_atual[]" placeholder="Sonho atual" style="width: 100%; margin-bottom: 5px;">
    <textarea name="acoes_atuais[]" placeholder="O que já estou fazendo?" style="width: 100%; margin-bottom: 5px;"></textarea>
    <textarea name="acoes_futuras[]" placeholder="O que ainda preciso fazer?" style="width: 100%;"></textarea>
  `;
  container.appendChild(bloco);
}
</script>

</body>
</html>
