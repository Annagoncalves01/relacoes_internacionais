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
    $sonhos = [
      'descricao' => 'Desejo viajar pelo mundo',
      'acoes_atuais' => 'Estudo inglês',
      'acoes_futuras' => 'Planejar uma viagem de 6 meses'
  ];
  $sonho_infancia = 'Quando criança, sonhava em ser astronauta e explorar o espaço, além de ser modelo.';
  $sonhos_atuais = [
    ['sonho' => 'Viajar pelo mundo', 'acoes_atuais' => 'Economizando dinheiro', 'acoes_futuras' => 'Planejar roteiros de viagem']
];
$objetivos = [
  'descricao' => 'Aprender Inglês fluentemente', // Curto prazo
  'prazo' => 'Passar numa Faculdade e graduar',   // Médio prazo
  'tipo_prazo' => 'Conquistar um emprego na área' // Longo prazo
];

$objetivo_curto = $objetivos['descricao'];  // Valor do objetivo de curto prazo
$objetivo_medio = $objetivos['prazo'];     // Valor do objetivo de médio prazo
$objetivo_longo = $objetivos['tipo_prazo']; // Valor do objetivo de longo prazo

$aspiracoes = 'Quero alcançar a realização profissional e pessoal, explorando novas culturas e me tornando uma líder no meu campo.';
?>

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
      <li><a href="metas.php">Estabelecendo Metas</a></li>

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
      <div class="aspiracao-bloco">
        <h3>Minhas Aspirações</h3>
        <p class="aspiracoes" id="aspiracoes"><?php echo $aspiracoes; ?></p>
      </div>
    </div>

    <div class="blocos-sonhos">
      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/icone-crianca.webp" alt="Ícone Infância">
        </div>
        <h3>SONHOS (INFÂNCIA)</h3>
        <p id="sonhoInfancia"><?php echo $sonho_infancia; ?></p>
      </div>

      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/sonhos.webp" alt="Ícone Sonhos Hoje">
        </div>
        <h3>MEUS SONHOS HOJE</h3>
        <div id="sonhos-container">
          <?php foreach ($sonhos_atuais as $sonho): ?>
            <div class="sonho-item">
              <p><strong>Sonho Atual:</strong> <?php echo $sonho['sonho']; ?></p>
              <p><strong>O que já estou fazendo?</strong> <?php echo $sonho['acoes_atuais']; ?></p>
              <p><strong>O que ainda preciso fazer?</strong> <?php echo $sonho['acoes_futuras']; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="bloco-sonho">
        <div class="icone-topo">
          <img src="../img/alvo.webp" alt="Ícone Objetivos">
        </div>
        <h3>MEUS PRINCIPAIS OBJETIVOS</h3>
        <div>
          <p><strong>Curto prazo (1 ano):</strong> <?php echo $objetivo_curto; ?></p>
          <p><strong>Médio prazo (3 anos):</strong> <?php echo $objetivo_medio; ?></p>
          <p><strong>Longo prazo (7 anos):</strong> <?php echo $objetivo_longo; ?></p>
        </div>
      </div>
    </div>
  <br><br>
<div class="campo-guiado-container">
  <div class="campo-guiado">
    <h3>Minhas Lembranças</h3>
    <textarea name="minhas_lembrancas" rows="4" readonly>Lembro-me das tardes passadas com minha família na praia, momentos inesquecíveis de felicidade e união.</textarea>
  </div>

  <div class="campo-guiado">
  <h3>Pontos Fortes</h3>
  <input class="input-preenchido" type="text" name="pontos_fortes" value="Organização, empatia, liderança" readonly>
</div>

<div class="campo-guiado">
  <h3>Pontos Fracos</h3>
  <input class="input-preenchido" type="text" name="pontos_fracos" value="Impaciência, dificuldade em delegar tarefas" readonly>
</div>

<div class="campo-guiado">
  <h3>Meus Valores</h3>
  <input class="input-preenchido" type="text" name="meus_valores" value="Honestidade, respeito, responsabilidade" readonly>
</div>


  <div class="campo-guiado">
    <h3>Minhas Principais Aptidões</h3>
    <select name="aptidoes[]" multiple size="5" disabled>
      <option value="lideranca" selected>Liderança</option>
      <option value="criatividade" selected>Criatividade</option>
      <option value="analise">Análise</option>
      <option value="comunicacao">Comunicação</option>
      <option value="organizacao" selected>Organização</option>
      <option value="empatia">Empatia</option>
    </select>
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
      <img src="../img/imag (1).jpg" alt="Diplomacia">
    </div>

    <div class="imagem-container">
      <img src="../img/relacoess.jpg" alt="Relações Internacionais">
      <div style="text-align: center; margin-top: 5px;">
      <a href="../profissao.php">
  <button class="botaos" type="button">PROFISSÃO</button>
</a>
      </div>
    </div>

    <div class="sessao" style="margin-top: 20px;">
    <h3>Como me vejo daqui 10 anos?</h3>
    <p style="width: 100%; max-width: 600px;">Eu me vejo como uma profissional realizada, atuando na área de Relações Internacionais, liderando projetos que promovam a paz e o desenvolvimento entre diferentes culturas, alcançando um equilíbrio entre vida pessoal e profissional.</p>
    </div>

    <div style="text-align: center; margin: 20px 0;">
  <a href="autoconhecimento.php" class="btn-salvar" style="padding: 10px 20px; background: #a00; color: white; text-decoration: none; border-radius: 5px; display: inline-block; text-align: center;">Se Autoconheça</a>
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
