<?php
session_start();
require_once 'config.php';
require_once 'Controller/PlanejamentoController.php';

$planejamentoController = new PlanejamentoController($pdo);
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    $descricao_sonho = $_POST['descricao_sonho'] ?? [];
    $acoes_atuais = $_POST['acoes_atuais'] ?? [];
    $acoes_futuras = $_POST['acoes_futuras'] ?? [];

    $objetivo_curto = $_POST['objetivo_curto'] ?? '';
    $objetivo_medio = $_POST['objetivo_medio'] ?? '';
    $objetivo_longo = $_POST['objetivo_longo'] ?? '';

    $planejamentoController->salvarPlanejamento($user_id, $descricao_sonho, $acoes_atuais, $acoes_futuras, $objetivo_curto, $objetivo_medio, $objetivo_longo);

    header("Location: planejamento.php?sucesso=1");
    exit();
}
?>
