<?php

namespace App\Controladores;

use App\Modelos\Meta;
use App\Modelos\Pilar;

class MetaControlador {

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
        require_once DIRETORIO_RAIZ . "/vistas/paginas/metas/{$vista}.php";
        $conteudo = ob_get_clean();

        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }

    // Exibe a lista de metas do usuário
    public function index(): string {
        $metas = Meta::buscarTodosPorUsuario($this->usuario_id);

        // Também busca os pilares para popular o dropdown no formulário do modal
        $pilares = Pilar::buscarTodosPorUsuario($this->usuario_id);

        $dados = [
            'titulo' => 'Minhas Metas',
            'titulo_pagina' => 'Gestão de Metas',
            'metas' => $metas,
            'pilares' => $pilares,
        ];
        return $this->renderizar('index', $dados);
    }

    // Armazena uma nova meta na base de dados
    public function armazenar() {
        // Validação dos dados
        $pilar_id = $_POST['pilar_id'] ?? null;
        $categoria_id = $_POST['categoria_id'] ?? null;
        $nome = $_POST['nome'] ?? null;
        $data_inicio = $_POST['data_inicio'] ?? null;
        $data_fim = $_POST['data_fim'] ?? null;

        if (empty($pilar_id) || empty($categoria_id) || empty($nome) || empty($data_inicio) || empty($data_fim)) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Todos os campos obrigatórios devem ser preenchidos.'], 400);
            return;
        }

        $meta = new Meta();
        $meta->usuario_id = $this->usuario_id;
        $meta->pilar_id = (int)$pilar_id;
        $meta->categoria_id = (int)$categoria_id;
        $meta->subcategoria_id = !empty($_POST['subcategoria_id']) ? (int)$_POST['subcategoria_id'] : null;
        $meta->nome = trim($nome);
        $meta->descricao = !empty($_POST['descricao']) ? trim($_POST['descricao']) : null;
        $meta->data_inicio = $data_inicio;
        $meta->data_fim = $data_fim;
        $meta->status = 'pendente'; // Status inicial padrão

        if ($meta->criar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Meta criada com sucesso!']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Ocorreu um erro ao salvar a meta.'], 500);
        }
    }

    private function responderJSON(array $dados, int $codigo = 200): void {
        header('Content-Type: application/json');
        http_response_code($codigo);
        echo json_encode($dados);
        exit();
    }
}
