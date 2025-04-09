<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, data_nascimento, sobre_mim, foto_perfil FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $email, $senha, $sobre_mim, $foto) {
        $campos = [];
        $params = [];

        // Campos obrigatórios
        $campos[] = "nome = ?";
        $params[] = $nome;

        $campos[] = "email = ?";
        $params[] = $email;

        $campos[] = "sobre_mim = ?";
        $params[] = $sobre_mim;

        // Atualiza senha apenas se for fornecida
        if (!empty($senha)) {
            $campos[] = "senha = ?";
            $params[] = password_hash($senha, PASSWORD_DEFAULT);
        }

        // Atualiza a foto apenas se uma nova for enviada
        if (!is_null($foto)) {
            $campos[] = "foto_perfil = ?";
            $params[] = $foto;
        }

        $params[] = $id;

        $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute($params);
    }
}
