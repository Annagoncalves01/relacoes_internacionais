<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function atualizar($id, $nome, $email, $senha, $sobre_mim, $foto)
    {
        $sql = "UPDATE users SET nome = :nome, email = :email, senha = :senha, sobre_mim = :sobre_mim, updated_at = NOW()";
    
        if ($foto !== null) {
            $sql .= ", foto_perfil = :foto";
        }
    
        $sql .= " WHERE id = :id";
    
        // Preparar a consulta
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':sobre_mim', $sobre_mim);
        if ($foto !== null) {
            $stmt->bindParam(':foto', $foto);
        }
        $stmt->bindParam(':id', $id);
    
        // Executar a consulta
        return $stmt->execute();
    }
    
    public function atualizarSobreMim($id, $texto) {
        $sql = "UPDATE users SET sobre_mim = :texto, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function emailExisteParaOutroUsuario($email, $idAtual)
{
    $sql = "SELECT id FROM users WHERE email = ? AND id != ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$email, $idAtual]);
    return $stmt->fetch() !== false;
}

    public function listarUsuarioPorID($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
