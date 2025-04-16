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

if (!empty($usuario['foto_perfil'])) {
    if (filter_var($usuario['foto_perfil'], FILTER_VALIDATE_URL) || file_exists($usuario['foto_perfil'])) {
        $foto_perfil = $usuario['foto_perfil']; 
    } else {
        $foto_perfil = 'data:image/jpeg;base64,' . base64_encode($usuario['foto_perfil']);
    }
} else {
    $foto_perfil = '../img/perfil.png'; 
}

$resultado = $_SESSION['resultado'] ?? null;

if (!$resultado) {
    echo "Nenhum resultado encontrado.";
    exit;
}

$tipo = htmlspecialchars($resultado['tipo']);
$mensagem = htmlspecialchars($resultado['mensagem']);
$pontuacoes = $resultado['pontuacoes'] ?? [];
$pontosFortes = $resultado['pontos_fortes'] ?? "Você demonstrou diversas qualidades positivas ao longo do teste.";

$aptidao = '';
$areaSugerida = '';
if (isset($pontuacoes['A'], $pontuacoes['B'], $pontuacoes['C'], $pontuacoes['D'])) {
    if ($pontuacoes['A'] > $pontuacoes['B'] && $pontuacoes['A'] > $pontuacoes['C'] && $pontuacoes['A'] > $pontuacoes['D']) {
        $aptidao = 'Você é apto para atuar nesta área!';
        $areaSugerida = 'Psicologia';
    } else {
        $aptidao = 'Você não é totalmente apto para esta área.';
        $areaSugerida = 'Gestão de Pessoas';
    }
} else {
    $aptidao = 'Não foi possível determinar a aptidão para a área.';
    $areaSugerida = 'Indefinida';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Teste</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="teste">
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
                <li><a href="testeinicio.php">Teste de Personalidade</a></li>
                <li><a href="testeinicio.php">Planejamento do Futuro</a></li>

            </ul>
        </nav>
        <div class="header-buttons">
            <a href="usuario/editar.php" class="avatar" title="Meu Perfil">
                <img src="<?= isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/perfil.png'; ?>" alt="Avatar do Usuário">
            </a>
            <a href="../index.php" class="logout-button" title="Sair">
                <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
            </a>
        </div>
    </header>

    <div class="main-resultado">
    <div class="resultado-container">
    <h1 class="titulo-resultado">RESULTADOS GRÁFICOS</h1>

        <h2 class="subtitulo-resultado">Distribuição das respostas</h2>
        <ul class="lista-respostas">
            <?php foreach ($pontuacoes as $quantidade): ?>
                <li class="item-resposta"><?= htmlspecialchars($quantidade) ?> respostas</li>
            <?php endforeach; ?>
        </ul>
        <div class="caixas-resultado">
            <div class="caixa conclusao">
                <?php if (file_exists('../img/bussola1.jpg')): ?>
                    <img src="../img/bussola1.jpg" alt="Teste de Imagem" style="width: 200px;">
                <?php else: ?>
                    <p>Imagem não encontrada</p>
                <?php endif; ?>
                <h3 class="titulo-caixa">Conclusão</h3>
                <p class="texto-caixa"><?= $mensagem ?></p>
            </div>

            <div class="caixa pontos-fortes">
                <?php if (file_exists('../img/globoo1.jpg')): ?>
                    <img src="../img/globoo1.jpg" alt="Pontos Fortes" class="img-caixa">
                <?php else: ?>
                    <p>Imagem não encontrada</p>
                <?php endif; ?>
                <h3 class="titulo-caixa">Pontos Fortes</h3>
                <p class="texto-caixa"><?= $pontosFortes ?></p>
            </div>
        </div>

    </div>

    <div class="aptidao">
        <h3 class="aptidao-titulo"><?= $aptidao ?></h3>
        <p class="aptidao-texto">Área sugerida: <strong><?= $areaSugerida ?></strong></p>
    </div>
</div>
    <script>
        const ctx = document.getElementById('graficoResultado').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($pontuacoes)) ?>,
                datasets: [{
                    label: 'Quantidade de respostas',
                    data: <?= json_encode(array_values($pontuacoes)) ?>,
                    backgroundColor: 'rgb(119, 0, 0)',  // Vermelho
                    borderColor: 'rgb(0, 57, 95)', // Azul
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#333',
                            font: { size: 13 }
                        },
                        grid: { color: '#ddd' }
                    },
                    x: {
                        ticks: {
                            color: '#333',
                            font: { size: 13 }
                        },
                        grid: { color: '#ddd' }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#333',
                            font: { size: 14 }
                        }
                    }
                }
            }
        });
    </script>
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
                    <li><a href="../../View/usuario/editar.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                    <li><a href="../index.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date("Y") ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
