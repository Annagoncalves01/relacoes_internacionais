<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/LoginModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

class LoginController
{
    private $userModel;

    public function __construct($pdo)
    {
        session_start();
        error_reporting(E_ALL & ~E_NOTICE);
        $this->userModel = new UserModel($pdo);
    }

    public function register()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $birthdate = trim($_POST['birthdate'] ?? '');
           

            if (empty($name) || empty($email) || empty($password) || empty($birthdate)) {
                $_SESSION["erro"] = "Todos os campos são obrigatórios.";
                header("Location: View/cadastro.php");
                exit;
            }

            if ($this->userModel->register($name, $email, $password, $birthdate)) { 
            
                $_SESSION["success"] = "Usuário cadastrado com sucesso!";
                header("Location: index.php");
            } else {
                $_SESSION["erro"] = "Erro ao cadastrar usuário.";
                header("Location: View/cadastro.php");
            }
            exit;
        }
    }

    public function login($email, $password)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($email ?? '');
            $password = trim($password ?? '');

            if (empty($email) || empty($password)) {
                $_SESSION["erro"] = "Preencha todos os campos!";
                header("Location: index.php?");
                exit;
            }

            if ($this->userModel->login($email, $password)) {
                header("Location: site.php"); // Redirecionado para index.php
                exit;
            } else {
                $_SESSION["erro"] = "E-mail ou senha inválidos!";
                header("Location: index.php");
                exit;
            }
        }
    }

    public function forgotPassword($email, $newPassword)
    {
        if (empty($email)) {
            $_SESSION["erro"] = "Informe seu e-mail.";
            header("Location: esquecisenha.php");
            exit;
        }
        if ($this->userModel->changePasswordWithEmail($email, $newPassword)) {
            $_SESSION["success"] = "Senha trocada com sucesso";
        } else {
            $_SESSION["erro"] = "Erro ao enviar e-mail.";
        }
        header("Location: index.php");
        exit;

    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
