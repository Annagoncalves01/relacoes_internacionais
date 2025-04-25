<?php
class PlanoAcaoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvarMetas($userId, $postData) {
        $areas = [
            "Relacionamento Familiar",
            "Estudos",
            "Saúde",
            "Futura Profissão",
            "Religião (opcional)",
            "Amigos",
            "Namorado(a) (opcional)",
            "Comunidade",
            "Tempo Livre"
        ];

        foreach ($areas as $index => $area) {
            $passoTexto = isset($postData['passo1'][$index]) ? trim($postData['passo1'][$index]) : '';
            $descricao = isset($postData['detalhamento'][$index]) ? trim($postData['detalhamento'][$index]) : '';
            $prazo = isset($postData['prazo'][$index]) ? trim($postData['prazo'][$index]) : '';

            if (!empty($passoTexto) || !empty($descricao) || !empty($prazo)) {
                $stmt = $this->pdo->prepare("INSERT INTO plano_acao (user_id, area, passo, descricao, prazo, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
                $stmt->execute([
                    $userId,
                    $area,
                    $passoTexto, // Aqui estamos enviando o texto do passo, e não 'Passo 1' ou número
                    $descricao,
                    $prazo
                ]);
            }
        }
    }
}
?>
