<?php
class TesteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvarResultado($user_id, $tipo, $respostas, $pontuacoes) {
        $mensagens = [
            'A' => 'Você tem um perfil forte para Relações Internacionais!',
            'B' => 'Você tem algumas características para a área, mas pode desenvolver mais.',
            'C' => 'Talvez não seja o melhor caminho, mas vale explorar.',
            'D' => 'Você tem um perfil equilibrado, mas precisa fortalecer sua adaptação.'
        ];

        // Verifica se o tipo é válido
        if (!isset($mensagens[$tipo])) {
            throw new Exception("Tipo de resultado inválido: $tipo");
        }

        $interpretacao = $mensagens[$tipo];

        $sql = "INSERT INTO resultados (teste_id, resultado, interpretacao, imagem_resultado) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $user_id, 
            $tipo, 
            $interpretacao, 
            'img/default.png'
        ]);
    }
    public function salvarRespostaNoBanco($user_id, $pergunta_id, $letra) {
        // Buscar o ID da resposta pela letra
        $sql = "SELECT id FROM respostas WHERE pergunta_id = ? AND letra = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pergunta_id, $letra]);
        $resposta = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($resposta) {
            $resposta_id = $resposta['id'];
    
            // Inserir no banco de testes_realizados
            $sql = "INSERT INTO testes_realizados (teste_id, pergunta_id, resposta_id) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$user_id, $pergunta_id, $resposta_id]);
        }
    }
    
    public function getResultadosUsuario($user_id) {
        $sql = "SELECT * FROM resultados WHERE teste_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
