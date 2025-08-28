<?php

namespace App\Controladores;

use App\Modelos\Subcategoria;

class SubcategoriaControlador {

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

    // Armazena uma nova subcategoria e retorna em JSON
    public function armazenar() {
        // Validação básica dos dados de entrada
        if (!isset($_POST['nome']) || !isset($_POST['categoria_id'])) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Dados inválidos.'], 400);
            return;
        }

        $nome = trim($_POST['nome']);
        $categoria_id = (int)$_POST['categoria_id'];

        if (empty($nome) || empty($categoria_id)) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Nome e ID da categoria são obrigatórios.'], 400);
            return;
        }

        $subcategoria = new Subcategoria($categoria_id, $this->usuario_id, $nome);

        if ($subcategoria->criar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Subcategoria criada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao criar a subcategoria.'], 500);
        }
    }

    // Busca os dados de uma subcategoria para edição
    public function buscar(int $id) {
        $subcategoria = Subcategoria::buscarPorId($id); // Preciso criar este método no modelo
        if ($subcategoria) {
            $this->responderJSON(['sucesso' => true, 'dados' => $subcategoria]);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Subcategoria não encontrada.'], 404);
        }
    }

    // Atualiza uma subcategoria existente
    public function atualizar(int $id) {
        $subcategoria = Subcategoria::buscarPorId($id);
        if (!$subcategoria) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Subcategoria não encontrada.'], 404);
            return;
        }

        // Validação de permissão virá aqui

        $subcategoria->nome = $_POST['nome'] ?? $subcategoria->nome;
        if ($subcategoria->atualizar()) { // Preciso criar este método no modelo
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Subcategoria atualizada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao atualizar a subcategoria.'], 500);
        }
    }

    // Deleta uma subcategoria
    public function deletar(int $id) {
        if (Subcategoria::deletar($id)) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Subcategoria deletada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao deletar a subcategoria.'], 500);
        }
    }
}
