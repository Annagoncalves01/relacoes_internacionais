<?php
session_start();

require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/TesteController.php';

$testeController = new TesteController($pdo);

if (isset($_POST['resposta'])) {
    $testeController->responder($_POST['resposta']);
} else {
    header("Location: /relacoes_internacionais/View/teste.php");
    exit;
}
