<?php
class TesteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criarTeste($user_id) {
        $sql = "INSERT INTO testes (user_id) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $this->pdo->lastInsertId();
    }

    // Salva o resultado final do teste
    public function salvarResultado($teste_id, $tipo, $respostas, $pontuacoes) {
        $mensagens = [
            'A' => 'Você tem um perfil forte para Relações Internacionais!',
            'B' => 'Você tem algumas características para a área, mas pode desenvolver mais.',
            'C' => 'Talvez não seja o melhor caminho, mas vale explorar.',
            'D' => 'Você tem um perfil equilibrado, mas precisa fortalecer sua adaptação.'
        ];

        if (!isset($mensagens[$tipo])) {
            throw new Exception("Tipo de resultado inválido: $tipo");
        }

        $interpretacao = $mensagens[$tipo];

        $sql = "INSERT INTO resultados (teste_id, resultado, interpretacao, imagem_resultado) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $teste_id,
            $tipo,
            $interpretacao,
            'img/default.png'
        ]);
    }

    public function usuarioJaFezTeste($user_id) {
        $sql = "SELECT COUNT(*) FROM testes WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function buscarResultadoAnterior($user_id) {
        $sql = "SELECT r.resultado 
                FROM resultados r 
                INNER JOIN testes t ON r.teste_id = t.id 
                WHERE t.user_id = ? 
                ORDER BY r.id DESC LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchColumn();
    }

    public function salvarRespostaNoBanco($teste_id, $pergunta_id, $letra) {
        $sql = "SELECT id FROM respostas WHERE pergunta_id = ? AND letra = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pergunta_id, $letra]);
        $resposta = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resposta) {
            $resposta_id = $resposta['id'];
            $sql = "INSERT INTO testes_realizados (teste_id, pergunta_id, resposta_id) 
                    VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$teste_id, $pergunta_id, $resposta_id]);
        }
    }

    public function getResultadosUsuario($user_id) {
        $sql = "SELECT r.* 
                FROM resultados r 
                INNER JOIN testes t ON r.teste_id = t.id 
                WHERE t.user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
