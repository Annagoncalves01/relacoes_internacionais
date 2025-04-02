<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/LoginController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

$userController = new UserController($pdo);
$route = $_GET["route"] ?? "login";

switch ($route) {
    case "login":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->login();
        } else {
            require 'View/login.php';
        }
        break;

    case "register":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->register();
        } else {
            require 'View/register.php';
        }
        break;

    case "logout":
        $userController->logout();
        break;

    default:
        echo "Página não encontrada.";
        break;
}
