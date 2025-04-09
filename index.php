<?php


require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/LoginController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

$userController = new UserController($pdo);
$route = $_GET["route"] ?? "login";

switch ($route) {
    case "login":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->login($_POST['email'], $_POST['password']);
        } else {
            require 'View/login.php';
        }
        break;

    case "register":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->register();
        } else {
            require 'View/cadastro.php';
        }
        break;
    case "registerUser":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->register();
        } else {
            return '';
        }
        break;
        case "resetPassword":
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userController->forgotPassword($_POST['email'], $_POST['newPassword']);
            } else {
                require 'view/login.php';
            }
            break;


    case "logout":
        $userController->logout();
        break;

    default:
        echo "Página não encontrada.";
        break;
}
