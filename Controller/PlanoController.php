<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/PlanoModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

class PlanoAcaoController {
    private $planoacaoModel;

    public function __construct($pdo) {
        $this->planoacaoModel = new PlanoAcaoModel($pdo);
    }

    public function salvarMetas($user_id, $dados) {
        $areas = [
            "Relacionamento Familiar",
            "Estudos",
            "Saúde",
            "Futura Profissão",
            "Religião",
            "Amigos",
            "Namorado(a)",
            "Comunidade",
            "Tempo Livre"
        ];

        foreach ($areas as $index => $area) {
            $passos = [
                $dados['passo1'][$index] ?? '',
                $dados['passo2'][$index] ?? '',
                $dados['passo3'][$index] ?? '',
            ];
            $detalhamento = $dados['detalhamento'][$index] ?? '';
            $prazo = $dados['prazo'][$index] ?? null;

            $this->planoacaoModel->salvarPlanoAcao($user_id, $area, $passos, $detalhamento, $prazo);
        }
    }
    public function buscarMetas($user_id) {
        return $this->planoacaoModel->buscarMetasPorUsuario($user_id);
    }
    
}
?>
