<?php

namespace App\Controladores;

use App\Modelos\Pilar;
use App\Modelos\Categoria;
use App\Modelos\Subcategoria;

class PilarControlador {

    private int $usuario_id;

    // Construtor que verifica a autenticação
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_BASE . '/login');
            exit();
        }
        $this->usuario_id = $_SESSION['usuario_id'];
    }

    // Envia uma resposta JSON padronizada
    private function responderJSON(array $dados, int $codigo = 200): void {
        header('Content-Type: application/json');
        http_response_code($codigo);
        echo json_encode($dados);
        exit();
    }

    // Renderiza a página principal de gestão de pilares
    public function index(): string {
        $pilares = Pilar::buscarTodosPorUsuario($this->usuario_id);

        $dados = [
            'titulo' => 'Meus Pilares',
            'titulo_pagina' => 'Gestão de Pilares',
            'pilares' => $pilares,
        ];

        ob_start();
        require_once DIRETORIO_RAIZ . "/vistas/paginas/pilares/index.php";
        $conteudo = ob_get_clean();

        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }

    // Armazena um novo pilar
    public function armazenar() {
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? null;
        $cor = $_POST['cor'] ?? '#6b46c1';

        if (empty($nome)) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'O nome do pilar é obrigatório.'], 400);
            return;
        }

        $pilar = new Pilar($this->usuario_id, $nome, $descricao, $cor);

        if ($pilar->criar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Pilar criado com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao criar o pilar.'], 500);
        }
    }

    // Atualiza um pilar existente
    public function atualizar(int $id) {
        $pilar = Pilar::buscarPorId($id);

        if (!$pilar || $pilar->usuario_id !== $this->usuario_id) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Pilar não encontrado ou sem permissão.'], 404);
            return;
        }

        $pilar->nome = $_POST['nome'] ?? $pilar->nome;
        $pilar->descricao = $_POST['descricao'] ?? $pilar->descricao;
        $pilar->cor = $_POST['cor'] ?? $pilar->cor;

        if ($pilar->atualizar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Pilar atualizado com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao atualizar o pilar.'], 500);
        }
    }

    // Deleta um pilar
    public function deletar(int $id) {
        $pilar = Pilar::buscarPorId($id);
        if ($pilar && $pilar->usuario_id === $this->usuario_id) {
            Pilar::deletar($id);
        }
        header('Location: ' . URL_BASE . '/pilares');
        exit();
    }

    // A página de detalhes continua sendo uma página completa, não um modal.
    public function mostrar(int $id) {
        $pilar = Pilar::buscarPorId($id);

        if (!$pilar || $pilar->usuario_id !== $this->usuario_id) {
            header('Location: ' . URL_BASE . '/pilares');
            exit();
        }

        $categorias = Categoria::buscarPorPilar($id);
        foreach ($categorias as $categoria) {
            $categoria->subcategorias = Subcategoria::buscarPorCategoria($categoria->id);
        }

        $dados = [
            'titulo' => 'Detalhes do Pilar',
            'titulo_pagina' => 'Pilar: ' . htmlspecialchars($pilar->nome),
            'pilar' => $pilar,
            'categorias' => $categorias,
        ];

        ob_start();
        require_once DIRETORIO_RAIZ . "/vistas/paginas/pilares/mostrar.php";
        $conteudo = ob_get_clean();

        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }
}
