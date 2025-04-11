<?php
$resultado = $testeController->resultado($_SESSION['user_id']);
?>

<h2>Resultado do Teste</h2>
<p><strong><?= $resultado['mensagem'] ?></strong></p>

<canvas id="grafico"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('grafico'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($resultado['contagem'])) ?>,
        datasets: [{
            label: 'Pontuação',
            data: <?= json_encode(array_values($resultado['contagem'])) ?>,
            backgroundColor: ['#4caf50', '#2196f3', '#ff9800', '#9c27b0']
        }]
    }
});
</script>
