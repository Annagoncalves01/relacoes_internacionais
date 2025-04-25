<?php
class PlanoAcaoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvarPlanoAcao($user_id, $area, $passos, $detalhamento, $prazo) {
        $sql = "INSERT INTO plano_acao (user_id, area, passo, descricao, prazo, created_at, updated_at)
                VALUES (:user_id, :area, :passo, :descricao, :prazo, NOW(), NOW())";
        $stmt = $this->pdo->prepare($sql);

        foreach ($passos as $indice => $passo) {
            if (!empty(trim($passo))) {
                $descricaoCompleta = $passo . ' - ' . $detalhamento;

                $stmt->execute([
                    ':user_id' => $user_id,
                    ':area' => $area,
                    ':passo' => 'Passo ' . ($indice + 1),
                    ':descricao' => $descricaoCompleta,
                    ':prazo' => $prazo
                ]);
            }
        }
    }

    public function buscarMetasPorUsuario($user_id) {
        $sql = "SELECT area, passo, descricao, prazo FROM plano_acao WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
