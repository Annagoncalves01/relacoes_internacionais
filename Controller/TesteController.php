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
        $_SESSION['indice'] = 0;
        header("Location: /view/teste.php");
        exit;
    }

    public function responder($resposta) {
        $_SESSION['respostas'][] = $resposta;
        $_SESSION['indice']++;

        if ($_SESSION['indice'] >= count($this->perguntas)) {
            header("Location: /view/resultado_teste.php");
        } else {
            header("Location: /view/teste.php");
        }
        exit;
    }

    public function getPerguntaAtual() {
        $indice = $_SESSION['indice'] ?? 0;
        return [
            'indice' => $indice,
            'texto' => $this->perguntas[$indice] ?? null
        ];
    }
    public function processarTeste($user_id, $respostas) {
        $pontuacoes = array_count_values($respostas);
        $tipo = $this->definirTipoPersonalidade($pontuacoes);
    
        $this->testeModel->salvarResultado($user_id, $tipo, $respostas, $pontuacoes);
        header("Location: /relacoes_internacionais/View/resultado_teste.php");
    }
    
    public function calcularResultadoFinal($user_id) {
        $respostas = $_SESSION['respostas'] ?? [];
        $pontuacoes = array_count_values($respostas);
        arsort($pontuacoes);
        $tipo = array_key_first($pontuacoes); // A, B, C ou D

        // Mensagem personalizada:
        $mensagens = [
            'A' => 'Você tem um perfil forte para Relações Internacionais!',
            'B' => 'Você tem algumas características para a área, mas pode desenvolver mais.',
            'C' => 'Talvez não seja o melhor caminho, mas vale explorar.',
            'D' => 'Você tem um perfil equilibrado, mas precisa fortalecer sua adaptação.'
        ];

        // Salvar no banco
        $this->testeModel->salvarResultado($user_id, $tipo, $respostas, $pontuacoes);

        return [
            'tipo' => $tipo,
            'mensagem' => $mensagens[$tipo],
            'pontuacoes' => $pontuacoes
        ];
    }

    public function mostrarResultados($user_id) {
        return $this->testeModel->getResultadosUsuario($user_id);
    }
}
