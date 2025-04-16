<?php
class ObjetivoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvar($userId, $descricao, $prazo, $tipoPrazo) {
        $sql = "INSERT INTO objetivos (user_id, descricao, prazo, tipo_prazo, created_at) 
                VALUES (:user_id, :descricao, :prazo, :tipo_prazo, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':descricao' => $descricao,
            ':prazo' => $prazo,
            ':tipo_prazo' => $tipoPrazo
        ]);
    }
}
