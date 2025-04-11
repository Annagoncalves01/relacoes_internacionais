<?php
class TesteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvarResultado($user_id, $tipo, $respostas, $pontuacoes) {
        $sql = "INSERT INTO resultados_personalidade (user_id, tipo_personalidade, respostas, pontuacoes) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user_id, 
            $tipo, 
            json_encode($respostas), 
            json_encode($pontuacoes)
        ]);
    }

    public function getResultadosUsuario($user_id) {
        $sql = "SELECT * FROM resultados_personalidade WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
