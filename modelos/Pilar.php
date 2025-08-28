<?php

namespace App\Modelos;

use App\Configuracao\BaseDados;
use PDO;

class Pilar {
    // Propriedades que correspondem às colunas da tabela 'pilar'
    public ?int $id;
    public int $usuario_id;
    public string $nome;
    public ?string $descricao;
    public string $cor;
    public string $tipo;
    public ?string $data_criacao;

    // Construtor para inicializar o objeto Pilar
    public function __construct(int $usuario_id, string $nome, ?string $descricao, string $cor, string $tipo = 'opcional', ?int $id = null, ?string $data_criacao = null) {
        $this->usuario_id = $usuario_id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->cor = $cor;
        $this->tipo = $tipo;
        $this->id = $id;
        $this->data_criacao = $data_criacao;
    }

    // Cria um novo pilar na base de dados
    public function criar(): bool {
        $sql = "INSERT INTO pilar (usuario_id, nome, descricao, cor, tipo) VALUES (:usuario_id, :nome, :descricao, :cor, :tipo)";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':usuario_id' => $this->usuario_id,
            ':nome' => $this->nome,
            ':descricao' => $this->descricao,
            ':cor' => $this->cor,
            ':tipo' => $this->tipo,
        ]);
    }

    // Busca todos os pilares de um usuário específico
    public static function buscarTodosPorUsuario(int $usuario_id): array {
        $sql = "SELECT * FROM pilar WHERE usuario_id = :usuario_id ORDER BY nome ASC";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);

        $pilares = [];
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $dados) {
            $pilares[] = new self($dados['usuario_id'], $dados['nome'], $dados['descricao'], $dados['cor'], $dados['tipo'], $dados['id'], $dados['data_criacao']);
        }
        return $pilares;
    }

    // Busca um pilar específico pelo seu ID
    public static function buscarPorId(int $id): ?Pilar {
        $sql = "SELECT * FROM pilar WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':id' => $id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            return new self($dados['usuario_id'], $dados['nome'], $dados['descricao'], $dados['cor'], $dados['tipo'], $dados['id'], $dados['data_criacao']);
        }
        return null;
    }

    // Atualiza os dados de um pilar existente
    public function atualizar(): bool {
        $sql = "UPDATE pilar SET nome = :nome, descricao = :descricao, cor = :cor WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':nome' => $this->nome,
            ':descricao' => $this->descricao,
            ':cor' => $this->cor,
            ':id' => $this->id,
        ]);
    }

    // Deleta um pilar pelo seu ID
    public static function deletar(int $id): bool {
        $sql = "DELETE FROM pilar WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
