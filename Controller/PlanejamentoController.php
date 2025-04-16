<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/SonhoModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/ObjetivoModel.php';

class PlanejamentoController {
    private $sonhoModel;
    private $objetivoModel;

    public function __construct($pdo) {
        $this->sonhoModel = new SonhoModel($pdo);
        $this->objetivoModel = new ObjetivoModel($pdo);
    }

    public function salvarSonho($userId, $descricao, $acoesAtuais, $acoesFuturas) {
        $this->sonhoModel->salvar($userId, $descricao, $acoesAtuais, $acoesFuturas);
    }

    public function salvarObjetivo($userId, $descricao, $prazo, $tipoPrazo) {
        $this->objetivoModel->salvar($userId, $descricao, $prazo, $tipoPrazo);
    }
}
