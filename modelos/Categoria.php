<?php

namespace App\Modelos;

use App\Configuracao\BaseDados;
use PDO;

class Categoria {
    // Propriedades
    public ?int $id;
    public int $pilar_id;
    public int $usuario_id;
    public string $nome;
    public ?string $data_criacao;

    // Construtor para inicializar o objeto
    public function __construct(int $pilar_id, int $usuario_id, string $nome, ?int $id = null, ?string $data_criacao = null) {
        $this->pilar_id = $pilar_id;
        $this->usuario_id = $usuario_id;
        $this->nome = $nome;
        $this->id = $id;
        $this->data_criacao = $data_criacao;
    }

    // Cria uma nova categoria
    public function criar(): bool {
        $sql = "INSERT INTO categoria (pilar_id, usuario_id, nome) VALUES (:pilar_id, :usuario_id, :nome)";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':pilar_id' => $this->pilar_id,
            ':usuario_id' => $this->usuario_id,
            ':nome' => $this->nome,
        ]);
    }

    // Busca todas as categorias de um pilar específico
    public static function buscarPorPilar(int $pilar_id): array {
        $sql = "SELECT * FROM categoria WHERE pilar_id = :pilar_id ORDER BY nome ASC";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':pilar_id' => $pilar_id]);

        $categorias = [];
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $dados) {
            $categorias[] = new self($dados['pilar_id'], $dados['usuario_id'], $dados['nome'], $dados['id'], $dados['data_criacao']);
        }
        return $categorias;
    }

    // Busca uma categoria pelo seu ID
    public static function buscarPorId(int $id): ?self {
        $sql = "SELECT * FROM categoria WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':id' => $id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            return new self($dados['pilar_id'], $dados['usuario_id'], $dados['nome'], $dados['id'], $dados['data_criacao']);
        }
        return null;
    }

    // Atualiza uma categoria
    public function atualizar(): bool {
        $sql = "UPDATE categoria SET nome = :nome WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':nome' => $this->nome,
            ':id' => $this->id,
        ]);
    }

    // Deleta uma categoria
    public static function deletar(int $id): bool {
        $sql = "DELETE FROM categoria WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
