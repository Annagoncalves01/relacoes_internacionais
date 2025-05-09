<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/UsuarioController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/PlanoController.php';

$usuarioController = new UsuarioController($pdo);
$usuario = $usuarioController->listarUsuarioPorID($_SESSION['user_id']);

$foto_perfil = !empty($usuario['foto_perfil'])
    ? 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil'])
    : '../img/perfil.png';

$planoacaoController = new PlanoAcaoController($pdo);

// Deletar metas, se o botão for clicado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletar_metas'])) {
  $planoacaoController->deletarMetas($_SESSION['user_id']);
  header("Location: metas.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $planoacaoController->salvarMetas($_SESSION['user_id'], $_POST);
    $_SESSION['salvar_metas'] = true;
    header("Location: metas.php");
    exit();
}

$metasSalvas = $planoacaoController->buscarMetas($_SESSION['user_id']);
$mensagemSucesso = false;

if (isset($_SESSION['salvar_metas'])) {
    $mensagemSucesso = true;
    unset($_SESSION['salvar_metas']); 
}
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
      <li><a href="planejamento.php">Planejamento do Futuro</a></li>
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

<br>
<h1 class="titulo-pagina">Estabelecendo Metas</h1>
<div class="table-container">
  <table class="table">
<div class="container">
    <form action="" method="post">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Área</th>
                        <th>Passo (Ação)</th>
                        <th>Como irei fazer? (Detalhamento)</th>
                        <th>Prazo (Data limite)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $areas = [
                        "Relacionamento Familiar",
                        "Estudos",
                        "Saúde",
                        "Futura Profissão",
                        "Religião (opcional)",
                        "Amigos",
                        "Namorado(a) (opcional)",
                        "Comunidade",
                        "Tempo Livre"
                    ];
                    foreach ($areas as $index => $area) {
                        echo "<tr>";
                        echo "<td>".htmlspecialchars($area)."</td>";
                        echo "<td><input type='text' name='passo1[$index]' class='input-preenchidoo'></td>";
                        echo "<td><textarea name='detalhamento[$index]' class='input-preenchidoo'></textarea></td>";
                        echo "<td><input type='date' name='prazo[$index]' class='input-preenchidoo'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Salvar Metas</button>
        </div>
    </form>
</div>
<div style="text-align: center; margin-top: 40px;">
  <img src="../img/passaporte.png" alt="Imagem 1" style="width: 250px; margin: 0 10px;">
  <img src="../img/moça.png" alt="Imagem 2" style="width: 250px; margin: 0 10px;">
  <img src="../img/mundo[.png" alt="Imagem 3" style="width: 250px; margin: 0 10px;">
</div>
<?php if (!empty($metasSalvas)): ?>
    <div class="container" style="margin: 40px auto; max-width: 1200px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Minhas Metas Salvas</h2> <!-- Centralizado -->
        <div class="table-responsive" style="margin: 0 auto; max-width: 1000px;">
            <table class="table table-bordered align-middle" style="margin: 0 auto; width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th style="width: 25%;">Área</th>
                        <th style="width: 20%;">Passo</th>
                        <th style="width: 35%;">Descrição</th>
                        <th style="width: 20%;">Prazo</th>
                    </tr>
                </thead>
                <tbody>
                <form action="" method="post" style="text-align: center; margin-top: 20px;">
    <input type="hidden" name="deletar_metas" value="1">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar todas as metas salvas?');">
        <i class="fa-solid fa-trash"></i> Deletar Metas
    </button>
</form>

                    <?php foreach ($metasSalvas as $meta): ?>
                        <tr>
                            <td><?= htmlspecialchars($meta['area']) ?></td>
                            <td><?= htmlspecialchars($meta['passo']) ?></td>
                            <td><?= htmlspecialchars($meta['descricao']) ?></td>
                            <td><?= htmlspecialchars(date('d/m/Y', strtotime($meta['prazo']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>



<br><br>
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
