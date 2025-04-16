<?php

class SonhoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvar($userId, $descricao, $acoesAtuais, $acoesFuturas) {
        $sql = "INSERT INTO sonhos (user_id, descricao, acoes_atuais, acoes_futuras, created_at) 
                VALUES (:user_id, :descricao, :acoes_atuais, :acoes_futuras, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':descricao' => $descricao,
            ':acoes_atuais' => $acoesAtuais,
            ':acoes_futuras' => $acoesFuturas
        ]);
    }
}
