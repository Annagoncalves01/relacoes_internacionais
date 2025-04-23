<?php
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\Model\PlanejamentoModel.php';
require_once 'C:\Turma2\xampp\htdocs\relacoes_internacionais\config.php';

class PlanejamentoController {
    private $planejamentoModel;

    public function __construct($pdo) {
        $this->planejamentoModel = new PlanejamentoModel($pdo);
    }

    public function salvarSonhos($userId, $sonhos) {
        foreach ($sonhos as $sonho) {
            $this->planejamentoModel->salvarSonho($userId, $sonho['descricao'], $sonho['acoes_atuais'], $sonho['acoes_futuras']);
        }
    }

    public function salvarObjetivo($userId, $descricao, $prazo, $tipoPrazo) {
        $this->planejamentoModel->salvarObjetivo($userId, $descricao, $prazo, $tipoPrazo);
    }

    public function listarSonhos($userId) {
        return $this->planejamentoModel->listarSonhosPorUsuario($userId);
    }

    public function listarObjetivos($userId) {
        return $this->planejamentoModel->listarObjetivosPorUsuario($userId);
    }
}
