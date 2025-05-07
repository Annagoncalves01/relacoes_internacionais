<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mensagem = trim($_POST['mensagem']);
    $user_id = $_SESSION['user_id'];

    if (!empty($mensagem)) {
        $sql = "INSERT INTO feedbacks (user_id, mensagem) VALUES (:user_id, :mensagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'mensagem' => $mensagem]);
    }
}

header("Location: ../profissao.php");
exit();
