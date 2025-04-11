<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/UsuarioModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

class UsuarioController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    private function verificarSessao() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /relacoes_internacionais/index.php");
            exit;
        }
    }

    public function editar() {
        $this->verificarSessao();
        $usuarioModel = new UsuarioModel($this->pdo);
        $usuario_id = $_SESSION['usuario_id'];

        $usuario = $usuarioModel->buscarPorId($usuario_id);

        if (!$usuario) {
            echo "Usuário não encontrado.";
            exit;
        }

        include 'C:/Turma2/xampp/htdocs/relacoes_internacionais/View/usuario/editar.php';
    }

    public function mostrarSobreMim() {
        $this->verificarSessao();
        $usuarioModel = new UsuarioModel($this->pdo);
        $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

        include 'View/usuario/sobre.php';
    }

    public function sobre() {
        $this->verificarSessao();
        $usuarioModel = new UsuarioModel($this->pdo);
        $usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

        include 'View/usuario/sobre.php'; 
    }

    public function atualizar() {
        $this->verificarSessao();
        $usuarioModel = new UsuarioModel($this->pdo);
        $usuarioAtual = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

        $nome = $_POST['nome'] ?? $usuarioAtual['nome'];
        $email = $_POST['email'] ?? $usuarioAtual['email'];
        $senha = $_POST['senha'] ?? '';
        $sobre_mim = $_POST['sobre_mim'] ?? $usuarioAtual['sobre_mim'];

        if (trim($senha) === '') {
            $senha = $usuarioAtual['senha'];
        } else {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
        }

        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $usuarioModel->atualizar($_SESSION['usuario_id'], $nome, $email, $senha, $sobre_mim, $foto);

        header("Location: /relacoes_internacionais/View/usuario/editar.php?sucesso=1");
        exit;
    }
    public function atualizarEmailSenha()
    {
        $this->verificarSessao(); // Garante que o usuário esteja logado
    
        $email_antigo = $_POST['email_atual'] ?? null;
        $novo_email = $_POST['novo_email'] ?? null;
        $nova_senha = $_POST['nova_senha'] ?? null;
    
        if (!$email_antigo || !$novo_email || !$nova_senha) {
            echo "Todos os campos são obrigatórios.";
            exit;
        }
    
        $usuarioModel = new UsuarioModel($this->pdo);
        $sucesso = $usuarioModel->atualizarSenhaEmail($email_antigo, $novo_email, $nova_senha);
    
        if ($sucesso) {
            header("Location: index.php?route=editarPerfil&success=1");
            exit;
        } else {
            echo "Erro ao atualizar e-mail e senha.";
        }
    }
    public function listarUsuarioPorID($usuario_id){
        $usuarioModel = new UsuarioModel($this->pdo);
        return $usuarioModel->buscarPorId($usuario_id); // <-- Usa o método do Model
    }
    
    public function salvarSobreMim() {
        $this->verificarSessao();
        $usuarioModel = new UsuarioModel($this->pdo);
    
        $sobre_mim = $_POST['sobre_mim'] ?? '';
        $usuarioModel->atualizarSobreMim($_SESSION['usuario_id'], $sobre_mim);

        header("Location: /relacoes_internacionais/View/usuario/sobre.php?sucesso=1");
        exit;
    }


    
    

}
?>
