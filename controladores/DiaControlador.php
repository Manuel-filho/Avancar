<?php

namespace App\Controladores;

use App\Modelos\Tarefa;

class DiaControlador {

    private int $usuario_id;

    // Construtor que verifica a autenticação
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_BASE . '/login');
            exit();
        }
        $this->usuario_id = $_SESSION['usuario_id'];
    }

    // Renderiza a vista da página do dia
    private function renderizar(array $dados = []): string {
        extract($dados);
        ob_start();
        require_once DIRETORIO_RAIZ . "/vistas/paginas/dia/index.php";
        $conteudo = ob_get_clean();

        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }

    // Exibe a página do dia com as tarefas agrupadas
    public function index(): string {
        $hoje = date('Y-m-d');
        $tarefasDoDia = Tarefa::buscarPorData($this->usuario_id, $hoje);

        // Agrupa as tarefas
        $tarefasAgrupadas = [
            'hora_marcada' => [],
            'manha' => [],
            'tarde' => [],
            'noite' => [],
            'arbitraria' => [],
        ];

        foreach ($tarefasDoDia as $tarefa) {
            if ($tarefa->tipo_temporal === 'hora_marcada') {
                $tarefasAgrupadas['hora_marcada'][] = $tarefa;
            } elseif ($tarefa->tipo_temporal === 'periodo' && $tarefa->periodo) {
                $tarefasAgrupadas[$tarefa->periodo][] = $tarefa;
            } else {
                $tarefasAgrupadas['arbitraria'][] = $tarefa;
            }
        }

        $dados = [
            'titulo' => 'Meu Dia',
            'titulo_pagina' => 'Tarefas de Hoje (' . date('d/m/Y') . ')',
            'tarefas' => $tarefasAgrupadas,
        ];

        return $this->renderizar($dados);
    }
}
