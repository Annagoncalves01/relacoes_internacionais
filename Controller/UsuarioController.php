<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/UsuarioModel.php';
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
            header("Location: index.php");
            exit;
        }
    }

    public function editar()
    {
        $this->verificarSessao();
        $usuarioModel = new Usuario($this->pdo);
        $usuario_id = $_SESSION['user_id'];

        $usuario = $usuarioModel->buscarPorId($usuario_id);

        if (!$usuario) {
            echo "Usuário não encontrado.";
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
        $this->mostrarSobreMim(); // reutiliza a função
    }
    public function atualizar()
    {
        $this->verificarSessao();
        $usuarioModel = new Usuario($this->pdo);
        $usuario_id = $_SESSION['user_id'];
    
        $usuarioAtual = $usuarioModel->buscarPorId($usuario_id);
    
        $nome = $_POST['nome'] ?? $usuarioAtual['nome'];
        $email = $_POST['email'] ?? $usuarioAtual['email'];
        $senha = $_POST['senha'] ?? '';
        $data_nascimento = $_POST['data_nascimento'] ?? $usuarioAtual['data_nascimento'];
        $sobre_mim = $_POST['sobre_mim'] ?? $usuarioAtual['sobre_mim'];
    
        if ($usuarioModel->emailExisteParaOutroUsuario($email, $usuario_id)) {
            header("Location: View/usuario/editar.php?erro=email_duplicado");
            exit;
        }
    
        if (trim($senha) !== '') {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
        } else {
            $senha = $usuarioAtual['senha'];
        }
    
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }
    
        // Agora inclui o data_nascimento corretamente
        $usuarioModel->atualizar($usuario_id, $nome, $email, $senha, $data_nascimento, $sobre_mim, $foto);
    
        header("Location: View/usuario/editar.php?success=1");
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
        return $usuarioModel->listarUsuarioPorID($usuario_id);
    }
}
?>
