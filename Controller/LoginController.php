<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/LoginModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        session_start(); // Garante que a sessão está iniciada
        $this->userModel = new UserModel($pdo);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $birthdate = trim($_POST['birthdate'] ?? '');

            if (empty($name) || empty($email) || empty($password) || empty($birthdate)) {
                $_SESSION["erro"] = "Todos os campos são obrigatórios.";
                header("Location: ../views/register.php");
                exit;
            }

            if ($this->userModel->register($name, $email, $password, $birthdate)) {
                $_SESSION["success"] = "Usuário cadastrado com sucesso!";
                header("Location: ../views/login.php");
            } else {
                $_SESSION["erro"] = "Erro ao cadastrar usuário.";
                header("Location: ../views/register.php");
            }
            exit;
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $_SESSION["erro"] = "Preencha todos os campos!";
                header("Location: ../views/login.php");
                exit;
            }

            if ($this->userModel->login($email, $password)) {
                $_SESSION["success"] = "Login realizado com sucesso!";
                header("Location: ../index.php"); // Redirecionado para index.php
                exit;
            } else {
                $_SESSION["erro"] = "E-mail ou senha inválidos!";
                header("Location: ../views/login.php");
                exit;
            }
        }
    }

    public function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            if (empty($email)) {
                $_SESSION["erro"] = "Informe seu e-mail.";
                header("Location: ../views/forgot_password.php");
                exit;
            }

            if ($this->userModel->sendResetLink($email)) {
                $_SESSION["success"] = "E-mail de recuperação enviado.";
            } else {
                $_SESSION["erro"] = "Erro ao enviar e-mail.";
            }
            header("Location: ../views/forgot_password.php");
            exit;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../views/login.php");
        exit;
    }
}
