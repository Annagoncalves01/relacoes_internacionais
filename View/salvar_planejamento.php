<?php
session_start();

require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/PlanejamentoController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$planejamentoController = new PlanejamentoController($pdo);

// Salvando sonhos
if (isset($_POST['sonho_atual'])) {
    foreach ($_POST['sonho_atual'] as $index => $descricao) {
        $descricao = trim($descricao);
        $acoesAtuais = trim($_POST['acoes_atuais'][$index]);
        $acoesFuturas = trim($_POST['acoes_futuras'][$index]);
        
        if (!empty($descricao)) {
            $planejamentoController->salvarSonhos($_SESSION['user_id'], [[
                'descricao' => $descricao,
                'acoes_atuais' => $acoesAtuais,
                'acoes_futuras' => $acoesFuturas
            ]]);
        }
    }
}

// Salvando objetivos
if (isset($_POST['objetivos'])) {
    foreach ($_POST['objetivos'] as $descricaoObjetivo) {
        $descricaoObjetivo = trim($descricaoObjetivo);
        
        if (!empty($descricaoObjetivo)) {
            $planejamentoController->salvarObjetivo($_SESSION['user_id'], $descricaoObjetivo, null, null);
        }
    }
}

// Depois de salvar, volta para planejamento
header("Location: planejamento.php");
exit();
