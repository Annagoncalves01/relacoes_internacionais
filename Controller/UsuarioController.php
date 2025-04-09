<?php
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\Model\UsuarioModel.php';
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\config.php';

class UsuarioController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    private function verificarSessao() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?route=login");
            exit;
        }
    }

    public function editar() {
        $this->verificarSessao();
        $model = new Usuario($this->pdo);
        $usuario = $model->buscarPorId($_SESSION['usuario_id']);

        require 'View/usuario/editar.php';
    }

    public function mostrarSobreMim() {
        $this->verificarSessao();
        $model = new Usuario($this->pdo);
        $usuario = $model->buscarPorId($_SESSION['usuario_id']);

        require 'View/usuario/sobre_mim.php';
    }

    public function sobre() {
        $this->verificarSessao();
        $model = new Usuario($this->pdo);
        $usuario = $model->buscarPorId($_SESSION['usuario_id']);

        require 'View/usuario/sobre.php'; // aqui $usuario já está definido!
    }

    public function atualizar() {
        $this->verificarSessao();
        $model = new Usuario($this->pdo);

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'] ?? '';
        $sobre_mim = $_POST['sobre_mim'] ?? '';

        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $model->atualizar($_SESSION['usuario_id'], $nome, $email, $senha, $sobre_mim, $foto);

        header("Location: index.php?route=editarPerfil&success=1");
        exit;
    }
}
