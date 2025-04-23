<?php

class SonhoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function salvar($userId, $descricao, $acoesAtuais, $acoesFuturas) {
        if (empty($descricao) || empty($acoesAtuais) || empty($acoesFuturas)) {
            return false; 
        }

        $sql = "INSERT INTO sonhos (user_id, descricao, acoes_atuais, acoes_futuras, created_at) 
                VALUES (:user_id, :descricao, :acoes_atuais, :acoes_futuras, NOW())";
        
        $stmt = $this->pdo->prepare($sql);
        
        // Associar os parâmetros
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':acoes_atuais', $acoesAtuais);
        $stmt->bindParam(':acoes_futuras', $acoesFuturas);
        
        // Tentar executar e verificar se foi bem sucedido
        return $stmt->execute();
    }
}
