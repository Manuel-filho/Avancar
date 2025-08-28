<?php

namespace App\Controladores;

use App\Modelos\Pilar;

class PilarControlador {

    // Renderiza uma página de conteúdo dentro do layout principal
    private function renderizar(string $vista, array $dados = []): string {
        extract($dados);
        ob_start();
        require_once DIRETORIO_RAIZ . "/vistas/paginas/pilares/{$vista}.php";
        $conteudo = ob_get_clean();

        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }

    // Exibe a lista de pilares do usuário
    public function index(): string {
        // Simulação do ID do usuário logado
        $usuario_id = 1;

        $pilares = Pilar::buscarTodosPorUsuario($usuario_id);

        $dados = [
            'titulo' => 'Meus Pilares',
            'titulo_pagina' => 'Gestão de Pilares',
            'pilares' => $pilares,
        ];
        return $this->renderizar('index', $dados);
    }

    // Exibe o formulário para criar um novo pilar
    public function criar(): string {
        $dados = [
            'titulo' => 'Novo Pilar',
            'titulo_pagina' => 'Criar Novo Pilar',
            'acao' => '/pilares/armazenar',
            'pilar' => null, // Nenhum pilar existente ao criar
        ];
        return $this->renderizar('formulario', $dados);
    }

    // Armazena um novo pilar na base de dados
    public function armazenar() {
        $usuario_id = 1; // Simulação do ID do usuário logado
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? null;
        $cor = $_POST['cor'] ?? '#6b46c1';

        $pilar = new Pilar($usuario_id, $nome, $descricao, $cor);
        $pilar->criar();

        $this->redirecionar('/pilares');
    }

    // Exibe o formulário para editar um pilar existente
    public function editar(int $id) {
        $pilar = Pilar::buscarPorId($id);

        // Validação para garantir que o pilar pertence ao usuário será necessária no futuro
        if (!$pilar) {
            $this->redirecionar('/pilares');
            return;
        }

        $dados = [
            'titulo' => 'Editar Pilar',
            'titulo_pagina' => 'Editar Pilar: ' . htmlspecialchars($pilar->nome),
            'acao' => '/pilares/' . $id . '/atualizar',
            'pilar' => $pilar,
        ];
        return $this->renderizar('formulario', $dados);
    }

    // Exibe a página de detalhes de um pilar
    public function mostrar(int $id) {
        $pilar = Pilar::buscarPorId($id);

        if (!$pilar) {
            $this->redirecionar('/pilares');
            return;
        }

        // Buscar categorias associadas a este pilar
        $categorias = Categoria::buscarPorPilar($id);

        $dados = [
            'titulo' => 'Detalhes do Pilar',
            'titulo_pagina' => 'Pilar: ' . htmlspecialchars($pilar->nome),
            'pilar' => $pilar,
            'categorias' => $categorias,
        ];
        return $this->renderizar('mostrar', $dados);
    }

    // Atualiza um pilar existente na base de dados
    public function atualizar(int $id) {
        $pilar = Pilar::buscarPorId($id);

        if ($pilar) {
            $pilar->nome = $_POST['nome'] ?? $pilar->nome;
            $pilar->descricao = $_POST['descricao'] ?? $pilar->descricao;
            $pilar->cor = $_POST['cor'] ?? $pilar->cor;
            $pilar->atualizar();
        }

        $this->redirecionar('/pilares');
    }

    // Deleta um pilar da base de dados
    public function deletar(int $id) {
        Pilar::deletar($id);
        $this->redirecionar('/pilares');
    }

    // Redireciona o usuário para uma URL
    private function redirecionar(string $url): void {
        header('Location: ' . URL_BASE . $url);
        exit();
    }
}
