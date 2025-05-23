<?php

require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/LoginController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Controller/UsuarioController.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

// Instância dos controladores
$loginController = new LoginController($pdo);
$usuarioController = new UsuarioController($pdo);

// Rota da URL
$route = $_GET["route"] ?? "login";

// Controle de rotas
switch ($route) {

    // Login
    case "login":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginController->login($_POST['email'], $_POST['password']);
        } else {
            require 'View/login.php';
        }
        break;

    case "registerUser":

        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $loginController->register();
        } else {
            require 'View/cadastro.php';
        }
        break;

    case "resetPassword":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginController->forgotPassword($_POST['email'], $_POST['newPassword']);
        } else {
            require 'View/login.php';
        }
        break;

    case "logout":
        $loginController->logout();
        break;

    // Editar perfil
    case "editarPerfil":
        $usuarioController->editar();
        break;

    // Página "Sobre Mim"
    case "sobreMim":
        $usuarioController->mostrarSobreMim();
        break;

    // Página "Sobre" (visual)
    case "sobre":
        $usuarioController->sobre();
        break;

    // Atualizar perfil
    case "atualizarPerfil":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuarioController->atualizar();
        }
        break;

        case 'salvarSobreMim':
            $usuarioController->salvarSobreMim();
            break;
        
    // Rota não encontrada
    default:
        echo "Página não encontrada.";
        break;
}
