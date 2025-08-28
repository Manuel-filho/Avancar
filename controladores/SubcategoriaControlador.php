<?php

namespace App\Controladores;

use App\Modelos\Subcategoria;

class SubcategoriaControlador {

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
        $usuario_id = 1; // Simulação do ID do usuário logado

        if (empty($nome) || empty($categoria_id)) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Nome e ID da categoria são obrigatórios.'], 400);
            return;
        }

        $subcategoria = new Subcategoria($categoria_id, $usuario_id, $nome);

        if ($subcategoria->criar()) {
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Subcategoria criada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao criar a subcategoria.'], 500);
        }
    }
}
