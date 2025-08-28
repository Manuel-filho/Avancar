<?php

namespace App\Controladores;

use App\Modelos\Meta;

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

        $dados = [
            'titulo' => 'Minhas Metas',
            'titulo_pagina' => 'Gestão de Metas',
            'metas' => $metas,
        ];
        return $this->renderizar('index', $dados);
    }
}
