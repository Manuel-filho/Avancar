<?php

namespace App\Controladores;

use App\Modelos\Categoria;
use App\Modelos\Subcategoria;

class CategoriaControlador {

    private int $usuario_id;

    // Construtor que verifica a autenticação
    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Acesso não autorizado.'], 401);
            return;
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

    // Armazena uma nova categoria e retorna em JSON
    public function armazenar() {
        // Validação básica dos dados de entrada
        if (!isset($_POST['nome']) || !isset($_POST['pilar_id'])) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Dados inválidos.'], 400);
            return;
        }

        $nome = trim($_POST['nome']);
        $pilar_id = (int)$_POST['pilar_id'];

        if (empty($nome) || empty($pilar_id)) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Nome e ID do pilar são obrigatórios.'], 400);
            return;
        }

        $categoria = new Categoria($pilar_id, $this->usuario_id, $nome);

        if ($categoria->criar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Categoria criada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao criar a categoria.'], 500);
        }
    }

    // Busca os dados de uma categoria para edição
    public function buscar(int $id) {
        $categoria = Categoria::buscarPorId($id);
        if ($categoria) {
            $this->responderJSON(['sucesso' => true, 'dados' => $categoria]);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Categoria não encontrada.'], 404);
        }
    }

    // Atualiza uma categoria existente
    public function atualizar(int $id) {
        $categoria = Categoria::buscarPorId($id);
        if (!$categoria) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Categoria não encontrada.'], 404);
            return;
        }

        // Validação de permissão virá aqui

        $categoria->nome = $_POST['nome'] ?? $categoria->nome;
        if ($categoria->atualizar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Categoria atualizada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao atualizar a categoria.'], 500);
        }
    }

    // Deleta uma categoria
    public function deletar(int $id) {
        if (Categoria::deletar($id)) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Categoria deletada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao deletar a categoria.'], 500);
        }
    }

    // Retorna as subcategorias de uma categoria em formato JSON
    public function listarSubcategorias(int $categoria_id) {
        // Validação de permissão (a categoria deve pertencer ao usuário logado)
        $categoria = Categoria::buscarPorId($categoria_id);
        if (!$categoria || $categoria->usuario_id !== $this->usuario_id) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Categoria não encontrada ou sem permissão.'], 404);
            return;
        }

        $subcategorias = Subcategoria::buscarPorCategoria($categoria_id);
        $this->responderJSON(['sucesso' => true, 'dados' => $subcategorias]);
    }
}
