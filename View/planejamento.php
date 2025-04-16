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

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Planejamento do Futuro</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

<header class="header">
  <div class="header-logo">
    <a href="index.php">
      <img src="../img/download.png" alt="Logotipo Global Pathway" />
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
      <img src="<?= htmlspecialchars($foto_perfil) ?>" alt="Avatar do Usuário" />
    </a>
    <a href="logout.php" class="logout-button" title="Sair">
      <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
    </a>
  </div>
</header>

<main>
  <form action="salvar_planejamento.php" method="POST">
    <h1 class="titulo-pagina">Planejamento do Futuro</h1>

    <!-- Minhas Aspirações -->
    <div class="aspiracoes-layout">
      <img src="../img/aviao.jpg" alt="Imagem avião" class="img-aspiracao" />
      <img src="../img/bussola2.png" alt="Imagem bússola" class="img-aspiracao" />
      <div class="aspiracao-bloco">
        <h3>Minhas Aspirações</h3>
        <textarea name="aspiracoes" id="aspiracoes" rows="8" placeholder="Descreva suas aspirações..."></textarea>
      </div>
    </div>

    <!-- Sonhos -->
    <div class="blocos-sonhos" style="background-image: url('../img/fundo-mapa.png');">
      <!-- Infância -->
      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/icone-crianca.png" alt="Ícone Infância" />
        </div>
        <h3>SONHOS (INFÂNCIA)</h3>
        <textarea name="sonho_infancia" id="sonhoInfancia" rows="6" placeholder="Sonho de infância..."></textarea>
      </div>

      <!-- Meus Sonhos Hoje -->
      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/icone-arvore.png" alt="Ícone Sonhos Hoje" />
        </div>
        <h3>MEUS SONHOS HOJE</h3>
        <div id="sonhos-container">
          <div class="sonho-item">
            <input type="text" name="sonho_atual[]" placeholder="Sonho atual" />
            <textarea name="acoes_atuais[]" placeholder="O que já estou fazendo?"></textarea>
            <textarea name="acoes_futuras[]" placeholder="O que ainda preciso fazer?"></textarea>
          </div>
        </div>
        <button type="button" onclick="adicionarSonho()">+ Adicionar Sonho</button>
      </div>

      <!-- Objetivos -->
      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/icone-alvo.png" alt="Ícone Objetivos" />
        </div>
        <h3>MEUS PRINCIPAIS OBJETIVOS</h3>
        <label for="objetivoCurto">Curto prazo (1 ano):</label>
        <input type="text" id="objetivoCurto" name="objetivo_curto" placeholder="Digite aqui" />
        <label for="objetivoMedio">Médio prazo (3 anos):</label>
        <input type="text" id="objetivoMedio" name="objetivo_medio" placeholder="Digite aqui" />
        <label for="objetivoLongo">Longo prazo (7 anos):</label>
        <input type="text" id="objetivoLongo" name="objetivo_longo" placeholder="Digite aqui" />
      </div>
    </div>
    <div class="section" id="profissao" style="margin-top: 20px;">
  <h3>Escolha Profissional</h3>

  <div class="campo-busca-container">
    <input type="text" id="buscaProfissao" placeholder="Digite uma profissão" oninput="buscarProfissao()" class="campo-busca" autocomplete="off" />
    <i class="fas fa-search icone-busca"></i>
  </div>

  <select id="listaProfissoes" name="escolha_profissional" onchange="exibirDetalhes()" class="lista-profissoes"></select>
  <div id="detalhesProfissao" class="detalhes-profissao" style="margin-top: 10px; display: none;"></div>
</div>

    <!-- Visão de Futuro -->
    <div class="section" style="margin-top: 20px;">
      <h3>Como me vejo daqui 10 anos?</h3>
      <textarea name="visao_10_anos" rows="4" placeholder="Descreva sua visão de futuro..."></textarea>
    </div>

    <!-- Botão Salvar -->
    <div style="text-align: center; margin: 20px 0;">
      <button type="submit" class="btn-salvar">Salvar Planejamento</button>
    </div>
  </form>
</main>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-col contatos">
      <h4>CONTATOS</h4>
      <p><i class="fa-solid fa-phone"></i> <span>(11) 98765-4321</span></p>
      <p><i class="fa-solid fa-envelope"></i> <span>contato@globalpathway.com</span></p>
    </div>
    <div class="footer-col logo">
      <img src="../img/download.png" alt="Logo Global Pathway" />
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
  // Adiciona bloco de sonho dinamicamente
  function adicionarSonho() {
    const container = document.getElementById('sonhos-container');
    const bloco = document.createElement('div');
    bloco.classList.add('sonho-item');
    bloco.innerHTML = `
      <input type="text" name="sonho_atual[]" placeholder="Sonho atual" />
      <textarea name="acoes_atuais[]" placeholder="O que já estou fazendo?"></textarea>
      <textarea name="acoes_futuras[]" placeholder="O que ainda preciso fazer?"></textarea>
    `;
    container.appendChild(bloco);
  }

  // Array estático de profissões (substituir por AJAX quando integrar BD)
  const profissoes = [
  {
    nome: 'Diplomata',
    descricao: 'Representa o Brasil no exterior',
    salario: 'R$ 20.926,97'
  },
  {
    nome: 'Comércio Exterior',
    descricao: 'Planeja e gerencia operações de importação e exportação',
    salario: 'R$ 4.525,07'
  },
  {
    nome: 'Embaixadas',
    descricao: 'Oficial de Chancelaria em embaixadas e consulados brasileiros',
    salario: 'R$ 10.169,77'
  },
  {
    nome: 'Gestão de Turismo',
    descricao: 'Coordena serviços turísticos e desenvolve roteiros',
    salario: 'R$ 3.379,05'
  },
  {
    nome: 'Contraterrorismo',
    descricao: 'Analisa e previne ameaças terroristas',
    salario: 'R$ 16.620,46'
  }
];


  // Carrega lista ao iniciar
  window.onload = buscarProfissao;

  function buscarProfissao() {
    const termo = document.getElementById('buscaProfissao').value.toLowerCase();
    const lista = document.getElementById('listaProfissoes');
    lista.innerHTML = '';

    const filtradas = profissoes.filter(p => p.nome.toLowerCase().includes(termo));
    if (filtradas.length === 0) {
      const opt = document.createElement('option');
      opt.textContent = 'Nenhuma profissão encontrada';
      opt.disabled = true;
      lista.appendChild(opt);
    } else {
      filtradas.forEach(p => {
        const opt = document.createElement('option');
        opt.value = p.nome;
        opt.textContent = p.nome;
        lista.appendChild(opt);
      });
    }

    document.getElementById('detalhesProfissao').style.display = 'none';
  }

  function exibirDetalhes() {
    const nome = document.getElementById('listaProfissoes').value;
    const profissao = profissoes.find(p => p.nome === nome);
    const detalhes = document.getElementById('detalhesProfissao');
    if (profissao) {
      detalhes.innerHTML = `
        <h4>${profissao.nome}</h4>
        <p><strong>Descrição:</strong> ${profissao.descricao}</p>
        <p><strong>Salário inicial:</strong> ${profissao.salario}</p>
      `;
      detalhes.style.display = 'block';
    }
  }
</script>

</body>
</html>
