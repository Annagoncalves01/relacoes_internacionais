<?php

class ObjetivoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvar($userId, $descricao, $prazo, $tipoPrazo) {
        $sql = "INSERT INTO objetivos (user_id, descricao, prazo, tipo_prazo) VALUES (:user_id, :descricao, :prazo, :tipo_prazo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':prazo', $prazo);
        $stmt->bindParam(':tipo_prazo', $tipoPrazo);
        $stmt->execute();
    }
}
