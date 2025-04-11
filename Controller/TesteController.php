<?php
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/TesteModel.php';
require_once 'C:/Turma2/xampp/htdocs/relacoes_internacionais/config.php';

class TesteController {
    private $testeModel;
    private $perguntas;

    public function __construct($pdo) {
        $this->testeModel = new TesteModel($pdo);
        $this->perguntas = include('C:/Turma2/xampp/htdocs/relacoes_internacionais/Model/perguntas.php');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function iniciarTeste() {
        $_SESSION['respostas'] = [];
        $_SESSION['perguntas_respondidas'] = [];
        $_SESSION['indice'] = 0;
        header("Location: /view/teste.php");
        exit;
    }

    public function responder($resposta) {
        if (!isset($_SESSION['respostas'])) $_SESSION['respostas'] = [];
        if (!isset($_SESSION['perguntas_respondidas'])) $_SESSION['perguntas_respondidas'] = [];
    
        // Limite de 10 perguntas
        if (count($_SESSION['respostas']) >= 10) {
            header("Location: /relacoes_internacionais/view/resultado_teste.php");
            exit;
        }
    
        // Encontrar próxima pergunta ainda não respondida
        foreach ($this->perguntas as $indice => $texto) {
            if (!in_array($indice, $_SESSION['perguntas_respondidas'])) {
                $_SESSION['respostas'][] = $resposta;
                $_SESSION['perguntas_respondidas'][] = $indice;
    
                $user_id = $_SESSION['user_id'] ?? null;
                if ($user_id) {
                    $this->testeModel->salvarRespostaNoBanco($user_id, $indice + 1, $resposta);
                }
                break;
            }
        }
    
        if (count($_SESSION['respostas']) >= 10 || count($_SESSION['perguntas_respondidas']) >= count($this->perguntas)) {
            header("Location: /relacoes_internacionais/view/resultado_teste.php");
        } else {
            header("Location: /relacoes_internacionais/view/teste.php");
        }
        exit;
    }
    

    public function getPerguntaAtual() {
        $respondidas = $_SESSION['perguntas_respondidas'] ?? [];
    
        foreach ($this->perguntas as $indice => $pergunta) {
            if (!in_array($indice, $respondidas)) {
                return [
                    'indice' => $indice,
                    'texto' => $pergunta
                ];
            }
        }
    
        // Todas respondidas
        header("Location: /relacoes_internacionais/view/resultado_teste.php");
        exit;
    }
    
    private function definirTipoPersonalidade($pontuacoes) {
        arsort($pontuacoes);
        return array_key_first($pontuacoes);
    }

    private function mensagemPorTipo($tipo) {
        $mensagens = [
            'A' => 'Você tem um perfil forte para Relações Internacionais! Seu interesse por culturas, habilidades de comunicação e pensamento estratégico fazem de você um ótimo candidato para essa área.',
            'B' => 'Você tem algumas características para Relações Internacionais, mas pode precisar desenvolver mais interesse por temas globais e habilidades de comunicação.',
            'C' => 'Talvez Relações Internacionais não seja o melhor caminho para você, mas você pode explorar mais sobre a área para ter certeza!',
            'D' => 'Você tem um perfil equilibrado, com interesse em algumas áreas de Relações Internacionais, mas pode precisar fortalecer sua capacidade de adaptação e interesse por temas globais.'
        ];
        return $mensagens[$tipo] ?? 'Resultado não identificado.';
    }

    public function calcularResultadoFinal($user_id) {
        if (!isset($_SESSION['respostas']) || empty($_SESSION['respostas'])) {
            header("Location: /view/teste.php?erro=sem_respostas");
            exit;
        }

        $respostas = $_SESSION['respostas'];
        $pontuacoes = array_count_values($respostas);

        if (empty($pontuacoes)) {
            throw new Exception("Erro ao calcular pontuações.");
        }

        $tipo = $this->definirTipoPersonalidade($pontuacoes);

        if (!$tipo) {
            throw new Exception("Não foi possível determinar o tipo dominante.");
        }

        $this->testeModel->salvarResultado($user_id, $tipo, $respostas, $pontuacoes);

        return [
            'tipo' => $tipo,
            'mensagem' => $this->mensagemPorTipo($tipo),
            'pontuacoes' => $pontuacoes
        ];
    }

    public function mostrarResultados($user_id) {
        return $this->testeModel->getResultadosUsuario($user_id);
    }
}
