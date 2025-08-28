<?php

namespace App\Controladores;

use App\Modelos\Categoria;

class CategoriaControlador {

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
        $usuario_id = 1; // Simulação do ID do usuário logado

        if (empty($nome) || empty($pilar_id)) {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Nome e ID do pilar são obrigatórios.'], 400);
            return;
        }

        $categoria = new Categoria($pilar_id, $usuario_id, $nome);

        if ($categoria->criar()) {
            // Para obter o ID, precisaríamos de um método que retorna o lastInsertId.
            // Por simplicidade, vamos buscar a categoria recém-criada.
            // Numa aplicação real, o método criar() poderia retornar o objeto criado.
            $this->responderJSON(['sucesso' => true, 'mensagem' => 'Categoria criada com sucesso.']);
        } else {
            $this->responderJSON(['sucesso' => false, 'mensagem' => 'Erro ao criar a categoria.'], 500);
        }
    }
}
