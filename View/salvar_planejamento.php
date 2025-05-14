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

// Salvar respostas ao formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $forcas_pessoais = $_POST['forcas_pessoais'] ?? '';
    $valores_pessoais = $_POST['valores_pessoais'] ?? '';
    $habilidades = $_POST['habilidades'] ?? '';
    $interesses = $_POST['interesses'] ?? '';
    $motivacoes = $_POST['motivacoes'] ?? '';
    $ambiente_ideal = $_POST['ambiente_ideal'] ?? '';
    $pessoas_inspiradoras = $_POST['pessoas_inspiradoras'] ?? '';

    $stmt = $pdo->prepare("SELECT id FROM autoconhecimento WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $existe = $stmt->fetch();

    if ($existe) {
        $stmt = $pdo->prepare("UPDATE autoconhecimento SET 
            forcas_pessoais = ?, 
            valores_pessoais = ?, 
            habilidades = ?, 
            interesses = ?, 
            motivacoes = ?, 
            ambiente_ideal = ?, 
            pessoas_inspiradoras = ? 
            WHERE user_id = ?");
        $stmt->execute([
            $forcas_pessoais,
            $valores_pessoais,
            $habilidades,
            $interesses,
            $motivacoes,
            $ambiente_ideal,
            $pessoas_inspiradoras,
            $_SESSION['user_id']
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO autoconhecimento 
            (user_id, forcas_pessoais, valores_pessoais, habilidades, interesses, motivacoes, ambiente_ideal, pessoas_inspiradoras) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $forcas_pessoais,
            $valores_pessoais,
            $habilidades,
            $interesses,
            $motivacoes,
            $ambiente_ideal,
            $pessoas_inspiradoras
        ]);
    }

    header("Location: planejamento.php?salvo=1");
    exit();
}

// Recuperar os dados de autoconhecimento
$stmt = $pdo->prepare("SELECT * FROM autoconhecimento WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$autoconhecimento = $stmt->fetch(PDO::FETCH_ASSOC);

$forcas_pessoais = $autoconhecimento['forcas_pessoais'] ?? '';
$valores_pessoais = $autoconhecimento['valores_pessoais'] ?? '';
$habilidades = $autoconhecimento['habilidades'] ?? '';
$interesses = $autoconhecimento['interesses'] ?? '';
$motivacoes = $autoconhecimento['motivacoes'] ?? '';
$ambiente_ideal = $autoconhecimento['ambiente_ideal'] ?? '';
$pessoas_inspiradoras = $autoconhecimento['pessoas_inspiradoras'] ?? '';
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
      <li><a href="inicioteste.php">Teste de Personalidade</a></li>
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
  <h1 class="titulo-pagina">Planejamento do Futuro ✈︎</h1>

  <?php if (isset($_GET['salvo'])): ?>
    <p style="color: green; text-align: center;">Respostas salvas com sucesso!</p>
  <?php endif; ?>

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

  <form method="POST" action="planejamento.php" class="sessaos">
    <h3>Autoconhecimento</h3>

    <div class="campo">
      <label for="forcas_pessoais">Minhas Forças Pessoais</label>
      <textarea name="forcas_pessoais" id="forcas_pessoais" placeholder="Descreva suas forças pessoais..."><?= htmlspecialchars($forcas_pessoais) ?></textarea>
    </div>

    <div class="campo">
      <label for="valores_pessoais">Meus Valores Pessoais</label>
      <textarea name="valores_pessoais" id="valores_pessoais" placeholder="Descreva seus valores..."><?= htmlspecialchars($valores_pessoais) ?></textarea>
    </div>

    <div class="campo">
      <label for="habilidades">Minhas Habilidades</label>
      <textarea name="habilidades" id="habilidades" placeholder="Liste suas habilidades..."><?= htmlspecialchars($habilidades) ?></textarea>
    </div>

    <div class="campo">
      <label for="interesses">Meus Interesses</label>
      <textarea name="interesses" id="interesses" placeholder="Descreva seus interesses..."><?= htmlspecialchars($interesses) ?></textarea>
    </div>

    <div class="campo">
      <label for="motivacoes">O que me motiva?</label>
      <textarea name="motivacoes" id="motivacoes" placeholder="Descreva suas motivações..."><?= htmlspecialchars($motivacoes) ?></textarea>
    </div>

    <div class="campo">
      <label for="ambiente_ideal">Ambiente de trabalho ideal</label>
      <textarea name="ambiente_ideal" id="ambiente_ideal" placeholder="Como seria o ambiente ideal de trabalho para você?"><?= htmlspecialchars($ambiente_ideal) ?></textarea>
    </div>

    <div class="campo">
      <label for="pessoas_inspiradoras">Pessoas que me inspiram</label>
      <textarea name="pessoas_inspiradoras" id="pessoas_inspiradoras" placeholder="Quem são suas referências?"><?= htmlspecialchars($pessoas_inspiradoras) ?></textarea>
    </div>

    <div style="text-align: center; margin: 20px 0;">
      <button type="submit" class="btn-salvar">Salvar Respostas</button>
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
        <li><a href="#profissao"><i class="fa-solid fa-briefcase"></i> Sobre a Profissão</a></li>
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
