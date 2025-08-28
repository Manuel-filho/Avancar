<?php

namespace App\Modelos;

use App\Configuracao\BaseDados;
use PDO;

class Subcategoria {
    // Propriedades
    public ?int $id;
    public int $categoria_id;
    public int $usuario_id;
    public string $nome;
    public ?string $data_criacao;

    // Construtor para inicializar o objeto
    public function __construct(int $categoria_id, int $usuario_id, string $nome, ?int $id = null, ?string $data_criacao = null) {
        $this->categoria_id = $categoria_id;
        $this->usuario_id = $usuario_id;
        $this->nome = $nome;
        $this->id = $id;
        $this->data_criacao = $data_criacao;
    }

    // Cria uma nova subcategoria
    public function criar(): bool {
        $sql = "INSERT INTO subcategoria (categoria_id, usuario_id, nome) VALUES (:categoria_id, :usuario_id, :nome)";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':categoria_id' => $this->categoria_id,
            ':usuario_id' => $this->usuario_id,
            ':nome' => $this->nome,
        ]);
    }

    // Busca todas as subcategorias de uma categoria específica
    public static function buscarPorCategoria(int $categoria_id): array {
        $sql = "SELECT * FROM subcategoria WHERE categoria_id = :categoria_id ORDER BY nome ASC";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':categoria_id' => $categoria_id]);

        $subcategorias = [];
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $dados) {
            $subcategorias[] = new self($dados['categoria_id'], $dados['usuario_id'], $dados['nome'], $dados['id'], $dados['data_criacao']);
        }
        return $subcategorias;
    }

    // Deleta uma subcategoria
    public static function deletar(int $id): bool {
        $sql = "DELETE FROM subcategoria WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
