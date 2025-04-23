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
    <h1 class="titulo-pagina">Planejamento do Futuro</h1>

    <div class="aspiracoes-layout">
      <img src="../img/aviao.jpg" alt="Imagem avião" class="img-aspiracao">
      <img src="../img/bussola2.png" alt="Imagem bússola" class="img-aspiracao">
      <div class="aspiracao-bloco">
        <h3>Minhas Aspirações</h3>
        <textarea name="aspiracoes" id="aspiracoes" rows="8" placeholder="Descreva suas aspirações..."></textarea>
      </div>
    </div>

    <div class="blocos-sonhos">
      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/icone-crianca.webp" alt="Ícone Infância">
        </div>
        <h3>SONHOS (INFÂNCIA)</h3>
        <textarea name="sonho_infancia" id="sonhoInfancia" rows="6" placeholder="Sonho de infância..."></textarea>
      </div>

      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/sonhos.webp" alt="Ícone Sonhos Hoje">
        </div>
        <h3>MEUS SONHOS HOJE</h3>
        <div id="sonhos-container">
          <div class="sonho-item">
            <input type="text" name="sonho_atual[]" placeholder="Sonho atual">
            <textarea name="acoes_atuais[]" placeholder="O que já estou fazendo?"></textarea>
            <textarea name="acoes_futuras[]" placeholder="O que ainda preciso fazer?"></textarea>
          </div>
        </div>
        <button type="button" onclick="adicionarSonho()">+ Adicionar Sonho</button>
      </div>

      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/alvo.webp" alt="Ícone Objetivos">
        </div>
        <h3>MEUS PRINCIPAIS OBJETIVOS</h3>
        <label for="objetivoCurto">Curto prazo (1 ano):</label>
        <input type="text" id="objetivoCurto" name="objetivo_curto" placeholder="Digite aqui">
        <label for="objetivoMedio">Médio prazo (3 anos):</label>
        <input type="text" id="objetivoMedio" name="objetivo_medio" placeholder="Digite aqui">
        <label for="objetivoLongo">Longo prazo (7 anos):</label>
        <input type="text" id="objetivoLongo" name="objetivo_longo" placeholder="Digite aqui">
      </div>
    </div>

    <div class="section" id="profissao">
      <h3>BUSQUE SUA ÁREA DE ATUAÇÃO</h3>
      <div class="campo-busca-container">
        <i class="fas fa-search"></i>
        <select id="listaProfissoes" name="escolha_profissional" onchange="exibirDetalhes()" class="lista-profissoes">
          <option value="" selected disabled>Selecione uma profissão</option>
        </select>
      </div>
      <div id="detalhesProfissao" class="detalhes-profissao">
        <ul id="textoDetalhes"></ul>
      </div>
    </div>

    <div class="imagem-abaixo">
      <img src="../img/acordo.jpg" alt="Diplomacia">
    </div>

    <div class="imagem-container">
      <img src="../img/relacoess.jpg" alt="Relações Internacionais">
      <div style="text-align: center; margin-top: 5px;">
        <button class="botaos" type="button">PROFISSÃO</button>
      </div>
    </div>

    <div class="sessao" style="margin-top: 20px;">
      <h3>Como me vejo daqui 10 anos?</h3>
      <textarea name="visao_10_anos" rows="4" placeholder="Descreva sua visão de futuro..." style="width: 100%; max-width: 600px;"></textarea>
    </div>

    <div style="text-align: center; margin: 20px 0;">
      <button type="submit" class="btn-salvar" style="padding: 10px 20px; background: #a00; color: white; border: none; border-radius: 5px;">Salvar Planejamento</button>
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
const profissoes = [
  { nome: 'Diplomata', descricao: 'Representa o Brasil no exterior', salario: 'R$ 20.926,97' },
  { nome: 'Comércio Exterior', descricao: 'Planeja e gerencia operações de importação e exportação', salario: 'R$ 4.525,07' },
  { nome: 'Embaixadas', descricao: 'Oficial de Chancelaria em embaixadas e consulados brasileiros', salario: 'R$ 10.169,77' },
  { nome: 'Gestão de Turismo', descricao: 'Coordena serviços turísticos e desenvolve roteiros', salario: 'R$ 3.379,05' },
  { nome: 'Contraterrorismo', descricao: 'Analisa e previne ameaças terroristas', salario: 'R$ 16.620,46' }
];

window.onload = function() {
  preencherListaProfissoes();
};

function preencherListaProfissoes() {
  const lista = document.getElementById('listaProfissoes');
  lista.innerHTML = '<option value="" selected disabled>Selecione uma profissão</option>';
  profissoes.forEach((p, index) => {
    const opt = document.createElement('option');
    opt.value = index;
    opt.textContent = p.nome;
    lista.appendChild(opt);
  });
}

function exibirDetalhes() {
  const select = document.getElementById('listaProfissoes');
  const index = select.value;
  const detalhes = document.getElementById('detalhesProfissao');
  const textoDetalhes = document.getElementById('textoDetalhes');

  if (index !== "") {
    const profissao = profissoes[index];
    textoDetalhes.innerHTML = `
      <li><strong>Profissão:</strong> ${profissao.nome}</li>
      <li><strong>Descrição:</strong> ${profissao.descricao}</li>
      <li><strong>Salário:</strong> ${profissao.salario}</li>
    `;
    detalhes.style.display = 'block';
  } else {
    detalhes.style.display = 'none';
  }
}

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
