<?php

namespace App\Controladores;

use App\Modelos\Tarefa;
use App\Modelos\Meta;

class TarefaControlador {

    private int $usuario_id;

    // Construtor que verifica a autenticação
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_BASE . '/login');
            exit();
        }
        $this->usuario_id = $_SESSION['usuario_id'];
    }

    // Renderiza uma vista dentro do layout principal
    private function renderizar(string $vista, array $dados = []): string {
        extract($dados);
        ob_start();
        require_once DIRETORIO_RAIZ . "/vistas/paginas/tarefas/{$vista}.php";
        $conteudo = ob_get_clean();

        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }

    // Exibe a lista de tarefas do usuário
    public function index(): string {
        $tarefas = Tarefa::buscarTodosPorUsuario($this->usuario_id);
        $metas = Meta::buscarTodosPorUsuario($this->usuario_id);

        $dados = [
            'titulo' => 'Minhas Tarefas',
            'titulo_pagina' => 'Gestão de Tarefas',
            'tarefas' => $tarefas,
            'metas' => $metas,
        ];
        return $this->renderizar('index', $dados);
    }

    // Armazena uma nova tarefa
    public function armazenar() {
        $dados = $_POST;

        // Validação básica
        if (empty($dados['meta_id']) || empty($dados['nome']) || empty($dados['tipo_temporal']) || empty($dados['data_execucao'])) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Campos obrigatórios em falta.'], 400);
            return;
        }

        $tarefa = new Tarefa();
        $tarefa->usuario_id = $this->usuario_id;
        $tarefa->meta_id = (int)$dados['meta_id'];
        $tarefa->nome = trim($dados['nome']);
        $tarefa->tipo_temporal = $dados['tipo_temporal'];
        $tarefa->data_execucao = $dados['data_execucao'];
        $tarefa->duracao = (int)($dados['duracao'] ?? 0);
        $tarefa->status = 'pendente';

        // Lógica para campos condicionais
        $tarefa->periodo = ($dados['tipo_temporal'] === 'periodo' && !empty($dados['periodo'])) ? $dados['periodo'] : null;
        $tarefa->horario = ($dados['tipo_temporal'] === 'hora_marcada' && !empty($dados['horario'])) ? $dados['horario'] : null;

        if ($tarefa->criar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Tarefa criada com sucesso!']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao criar a tarefa.'], 500);
        }
    }

    // Envia uma resposta JSON padronizada
    private function responderJSON(array $dados, int $codigo = 200): void {
        header('Content-Type: application/json');
        http_response_code($codigo);
        echo json_encode($dados);
        exit();
    }

    // Busca os dados de uma tarefa para edição
    public function buscar(int $id) {
        $tarefa = Tarefa::buscarPorId($id);
        if ($tarefa && $tarefa->usuario_id === $this->usuario_id) {
            $this->responderJSON(['sucesso' => true, 'dados' => $tarefa]);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Tarefa não encontrada.'], 404);
        }
    }

    // Atualiza uma tarefa existente
    public function atualizar(int $id) {
        $tarefa = Tarefa::buscarPorId($id);
        if (!$tarefa || $tarefa->usuario_id !== $this->usuario_id) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Tarefa não encontrada ou sem permissão.'], 404);
            return;
        }

        $dados = $_POST;
        $tarefa->meta_id = (int)($dados['meta_id'] ?? $tarefa->meta_id);
        $tarefa->nome = trim($dados['nome']) ?? $tarefa->nome;
        $tarefa->tipo_temporal = $dados['tipo_temporal'] ?? $tarefa->tipo_temporal;
        $tarefa->data_execucao = $dados['data_execucao'] ?? $tarefa->data_execucao;
        $tarefa->duracao = (int)($dados['duracao'] ?? $tarefa->duracao);
        $tarefa->periodo = ($dados['tipo_temporal'] === 'periodo' && !empty($dados['periodo'])) ? $dados['periodo'] : null;
        $tarefa->horario = ($dados['tipo_temporal'] === 'hora_marcada' && !empty($dados['horario'])) ? $dados['horario'] : null;
        // O status não é editável aqui, será mudado na "Página do Dia"

        if ($tarefa->atualizar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Tarefa atualizada com sucesso!']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Ocorreu um erro ao atualizar a tarefa.'], 500);
        }
    }

    // Deleta uma tarefa
    public function deletar(int $id) {
        $tarefa = Tarefa::buscarPorId($id);
        if (!$tarefa || $tarefa->usuario_id !== $this->usuario_id) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Tarefa não encontrada ou sem permissão.'], 404);
            return;
        }

        if (Tarefa::deletar($id)) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Tarefa deletada com sucesso!']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Ocorreu um erro ao deletar a tarefa.'], 500);
        }
    }
}
