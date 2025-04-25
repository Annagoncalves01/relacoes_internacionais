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
            $planejamentoController->salvarSonhos($_SESSION['user_id'], [
                'descricao' => $descricao,
                'acoes_atuais' => $acoesAtuais,
                'acoes_futuras' => $acoesFuturas
            ]);
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

// Salvando autoconhecimento
if (
    isset($_POST['forcas_pessoais']) ||
    isset($_POST['valores_pessoais']) ||
    isset($_POST['habilidades']) ||
    isset($_POST['interesses']) ||
    isset($_POST['motivacoes']) ||
    isset($_POST['ambiente_ideal']) ||
    isset($_POST['pessoas_inspiradoras'])
) {
    $stmt = $pdo->prepare("
        INSERT INTO autoconhecimento 
        (user_id, forcas_pessoais, valores_pessoais, habilidades, interesses, 
         motivacoes, ambiente_ideal, pessoas_inspiradoras, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['forcas_pessoais'] ?? '',
        $_POST['valores_pessoais'] ?? '',
        $_POST['habilidades'] ?? '',
        $_POST['interesses'] ?? '',
        $_POST['motivacoes'] ?? '',
        $_POST['ambiente_ideal'] ?? '',
        $_POST['pessoas_inspiradoras'] ?? ''
    ]);
}

// Redireciona após salvar
header("Location: planejamento.php");
exit();
