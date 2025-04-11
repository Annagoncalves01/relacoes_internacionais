<?php
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\Model\UsuarioModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

class UsuarioController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    private function verificarSessao()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=login");
            exit;
        }
    }

    public function editar()
    {
        $this->verificarSessao();
        $pdo = $this->pdo;
        $usuarioModel = new Usuario($pdo);

        $usuario_id = $_SESSION['user_id'] ?? null;

        if (!$usuario_id) {
            echo "ID do usuário não está na sessão.";
            exit;
        }


        $usuario = $usuarioModel->buscarPorId($usuario_id);

        if (!$usuario) {
            echo "Usuário não carregado. ID buscado: " . $usuario_id;
            exit;
        }
        include 'C:/Turma2/xampp/htdocs/relacoes_internacionais/View/usuario/editar.php';
    }

    public function mostrarSobreMim()
    {
        $this->verificarSessao();
        $usuarioModel = new Usuario($this->pdo);
        $usuario = $usuarioModel->buscarPorId($_SESSION['user_id']);

        include 'View/usuario/sobre.php';
    }

    public function sobre()
    {
        $this->verificarSessao();
        $usuarioModel = new Usuario($this->pdo);
        $usuario = $usuarioModel->buscarPorId($_SESSION['user_id']);

        include 'View/usuario/sobre.php';
    }

    public function atualizar()
    {
        $this->verificarSessao();
        $usuarioModel = new Usuario($this->pdo);

        $usuarioAtual = $usuarioModel->buscarPorId($_SESSION['user_id']);

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

        $usuarioModel->atualizar($_SESSION['user_id'], $nome, $email, $senha, $sobre_mim, $foto);

        header("Location: View/usuario/editar.php?route=editarPerfil&success=1");
        exit;
    }

    public function salvarSobreMim()
    {
        $this->verificarSessao();
        $usuarioModel = new Usuario($this->pdo);

        $sobre_mim = $_POST['sobre_mim'] ?? '';

        $usuarioModel->atualizarSobreMim($_SESSION['user_id'], $sobre_mim);

        header("Location: index.php?route=sobre&sucesso=1");
        exit;
    }

    public function atualizarSobreMim($id, $texto)
    {
        $sql = "UPDATE users SET sobre_mim = :texto, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function listarUsuarioPorID($usuario_id)
    {
        $usuarioModel = new Usuario($this->pdo);
        return $usuario = $usuarioModel->listarUsuarioPorID($usuario_id);

    }

}
?>