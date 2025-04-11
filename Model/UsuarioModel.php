<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function atualizar($id, $nome, $email, $senha, $sobre_mim, $foto) {
        $campos = [];
        $params = [];
    
        $campos[] = "nome = ?";
        $params[] = $nome;
    
        $campos[] = "email = ?";
        $params[] = $email;
    
        $campos[] = "sobre_mim = ?";
        $params[] = $sobre_mim;
    
        // Senha já vem criptografada do controller, então só inclui
        if (!empty($senha)) {
            $campos[] = "senha = ?";
            $params[] = $senha;
        }
    
        // Foto só se for enviada nova
        if (!is_null($foto)) {
            $campos[] = "foto_perfil = ?";
            $params[] = $foto;
        }
    
        $params[] = $id;
    
        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
    
        return $stmt->execute($params);
    }
    public function atualizarSobreMim($id, $texto) {
        $sql = "UPDATE usuarios SET sobre_mim = :texto, updated_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    
    public function listarUsuarioPorID($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
