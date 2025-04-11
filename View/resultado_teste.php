<?php
session_start();
$resultado = $_SESSION['resultado'] ?? null;

if (!$resultado) {
    echo "Nenhum resultado encontrado.";
    exit;
}

$tipo = $resultado['tipo'];
$mensagem = $resultado['mensagem'];
$pontuacoes = $resultado['pontuacoes'];
$pontosFortes = $resultado['pontos_fortes'] ?? "Você demonstrou diversas qualidades positivas ao longo do teste.";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Teste</title>
    <link rel="stylesheet" href="style.css"> <!-- Verifique se não há opacidade no body -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="resultado">

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
        <a href="usuario/sobre.php" class="avatar" title="Meu Perfil">
            <img src="<?= isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/perfil.png'; ?>" alt="Avatar do Usuário">
        </a>
        <a href="logout.php" class="logout-button" title="Sair">
            <i class="fa-solid fa-right-from-bracket"></i> <span>Sair</span>
        </a>
    </div>
</header>

<?php 
$headerPath = __DIR__ . '/header.php';
if (file_exists($headerPath)) {
    include $headerPath;
}
?>

<div class="main-resultado">
    <div class="resultado-container">
        <h1>Seu resultado: <?= htmlspecialchars($tipo) ?></h1>

        <h2>Distribuição das respostas</h2>
        <ul>
            <?php foreach ($pontuacoes as $letra => $quantidade): ?>
                <li><?= htmlspecialchars($letra) ?>: <?= htmlspecialchars($quantidade) ?> respostas</li>
            <?php endforeach; ?>
        </ul>

        <div id="graficoWrapper">
            <canvas id="graficoResultado"></canvas>
        </div>

        <div class="caixas-resultado">
            <div class="caixa">
                <img src="../img/conclusao.png" alt="Conclusão">
                <h3>Conclusão</h3>
                <p><?= htmlspecialchars($mensagem) ?></p>
            </div>
            <div class="caixa">
                <img src="../img/fortes.png" alt="Pontos Fortes">
                <h3>Pontos Fortes</h3>
                <p><?= htmlspecialchars($pontosFortes) ?></p>
            </div>
        </div>
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
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
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

<!-- Rodapé direto aqui (sem repetição nem inclusão do footer.php de novo) -->
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
                <li><a href="#planejamento"><i class="fa-solid fa-bullseye"></i> Planejamento do Futuro</a></li>
                <li><a href="perfil.php"><i class="fa-solid fa-user"></i> Meu Perfil</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date("Y") ?> Global Pathway | Anna Clara Gonçalves. Todos os direitos reservados.</p>
    </div>
</footer>

</body>
</html>
