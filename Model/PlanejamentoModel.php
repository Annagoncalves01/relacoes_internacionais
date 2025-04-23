<?php
class PlanejamentoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvarSonho($usuarioId, $descricao, $acoesAtuais, $acoesFuturas) {
        $sql = "INSERT INTO sonhos (user_id, descricao, acoes_atuais, acoes_futuras) VALUES (:user_id, :descricao, :acoes_atuais, :acoes_futuras)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $usuarioId);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':acoes_atuais', $acoesAtuais);
        $stmt->bindParam(':acoes_futuras', $acoesFuturas);
        $stmt->execute();
    }

    public function salvarObjetivo($usuarioId, $descricao, $prazo, $tipoPrazo) {
        $sql = "INSERT INTO objetivos (user_id, descricao, prazo, tipo_prazo) VALUES (:user_id, :descricao, :prazo, :tipo_prazo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $usuarioId);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':prazo', $prazo);
        $stmt->bindParam(':tipo_prazo', $tipoPrazo);
        $stmt->execute();
    }

    public function listarSonhosPorUsuario($usuarioId) {
        $sql = "SELECT * FROM sonhos WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $usuarioId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarObjetivosPorUsuario($usuarioId) {
        $sql = "SELECT * FROM objetivos WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $usuarioId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
