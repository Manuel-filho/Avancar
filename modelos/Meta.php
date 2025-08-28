<?php

namespace App\Modelos;

use App\Configuracao\BaseDados;
use PDO;

class Meta {
    // Propriedades
    public ?int $id;
    public int $usuario_id;
    public int $pilar_id;
    public int $categoria_id;
    public ?int $subcategoria_id;
    public string $nome;
    public ?string $descricao;
    public string $data_inicio;
    public string $data_fim;
    public string $status;
    public ?string $data_criacao;

    // Propriedades para dados das tabelas relacionadas
    public ?string $pilar_nome = null;
    public ?string $categoria_nome = null;
    public ?string $subcategoria_nome = null;

    // Construtor
    public function __construct() {
        // Construtor vazio para facilitar instanciação via PDO
    }

    // Cria uma nova meta na base de dados
    public function criar(): bool {
        $sql = "INSERT INTO meta (usuario_id, pilar_id, categoria_id, subcategoria_id, nome, descricao, data_inicio, data_fim, status)
                VALUES (:usuario_id, :pilar_id, :categoria_id, :subcategoria_id, :nome, :descricao, :data_inicio, :data_fim, :status)";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':usuario_id' => $this->usuario_id,
            ':pilar_id' => $this->pilar_id,
            ':categoria_id' => $this->categoria_id,
            ':subcategoria_id' => $this->subcategoria_id,
            ':nome' => $this->nome,
            ':descricao' => $this->descricao,
            ':data_inicio' => $this->data_inicio,
            ':data_fim' => $this->data_fim,
            ':status' => $this->status,
        ]);
    }

    // Busca todas as metas de um usuário com informações de hierarquia
    public static function buscarTodosPorUsuario(int $usuario_id): array {
        $sql = "SELECT
                    m.*,
                    p.nome AS pilar_nome,
                    c.nome AS categoria_nome,
                    sc.nome AS subcategoria_nome
                FROM
                    meta m
                JOIN
                    pilar p ON m.pilar_id = p.id
                JOIN
                    categoria c ON m.categoria_id = c.id
                LEFT JOIN
                    subcategoria sc ON m.subcategoria_id = sc.id
                WHERE
                    m.usuario_id = :usuario_id
                ORDER BY
                    m.data_fim ASC";

        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Busca uma meta específica pelo seu ID
    public static function buscarPorId(int $id): ?self {
        // Implementação similar a buscarTodosPorUsuario, mas para um único ID
        // e sem a necessidade de joins se o objeto já tiver as informações.
        // Por simplicidade, vamos fazer um select simples.
        $sql = "SELECT * FROM meta WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute([':id' => $id]);
        $resultado = $stmt->fetch();
        return $resultado ?: null;
    }

    // Atualiza os dados de uma meta existente
    public function atualizar(): bool {
        $sql = "UPDATE meta SET
                    pilar_id = :pilar_id,
                    categoria_id = :categoria_id,
                    subcategoria_id = :subcategoria_id,
                    nome = :nome,
                    descricao = :descricao,
                    data_inicio = :data_inicio,
                    data_fim = :data_fim,
                    status = :status
                WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':pilar_id' => $this->pilar_id,
            ':categoria_id' => $this->categoria_id,
            ':subcategoria_id' => $this->subcategoria_id,
            ':nome' => $this->nome,
            ':descricao' => $this->descricao,
            ':data_inicio' => $this->data_inicio,
            ':data_fim' => $this->data_fim,
            ':status' => $this->status,
            ':id' => $this->id,
        ]);
    }

    // Deleta uma meta pelo seu ID
    public static function deletar(int $id): bool {
        $sql = "DELETE FROM meta WHERE id = :id";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
