<?php
class UsuarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Cadastro de novo usuário
    public function register($nome, $email, $senha, $data_nascimento)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $_SESSION['erro'] = "Email já cadastrado.";
            return false;
        }

        $hashedPassword = password_hash($senha, PASSWORD_BCRYPT);

        $stmt = $this->pdo->prepare("INSERT INTO users (nome, email, senha, data_nascimento, created_at, updated_at)
            VALUES (:nome, :email, :senha, :data_nascimento, NOW(), NOW())");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $hashedPassword);
        $stmt->bindParam(':data_nascimento', $data_nascimento);

        return $stmt->execute();
    }

    // Login de usuário
    public function login($email, $senha)
    {
        $stmt = $this->pdo->prepare("SELECT id, senha FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            return true;
        }

        return false;
    }

    // Atualiza email e senha
    public function atualizarSenhaEmail($email_antigo, $novo_email, $nova_senha)
    {
        $senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);

        $stmt = $this->pdo->prepare("UPDATE users 
            SET email = :novo_email, senha = :nova_senha, updated_at = NOW()
            WHERE email = :email_antigo");

        $stmt->bindParam(':novo_email', $novo_email);
        $stmt->bindParam(':nova_senha', $senha_hash);
        $stmt->bindParam(':email_antigo', $email_antigo);

        return $stmt->execute();
    }

    // Busca por ID
    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, data_nascimento, sobre_mim, foto_perfil FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualização completa do perfil
    public function atualizar($id, $nome, $email, $senha, $sobre_mim, $foto)
    {
        $campos = ["nome = ?", "email = ?", "sobre_mim = ?"];
        $params = [$nome, $email, $sobre_mim];

        if (!empty($senha)) {
            $campos[] = "senha = ?";
            $params[] = password_hash($senha, PASSWORD_BCRYPT);
        }

        if (!is_null($foto)) {
            $campos[] = "foto_perfil = ?";
            $params[] = $foto;
        }

        $campos[] = "updated_at = NOW()";
        $params[] = $id;

        $sql = "UPDATE users SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($params);
    }

    // Atualiza apenas o campo Sobre Mim
    public function atualizarSobreMim($id, $texto)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET sobre_mim = :texto, updated_at = NOW() WHERE id = :id");
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
