<?php

namespace App\Modelos;

use App\Configuracao\BaseDados;
use PDO;

class Tarefa {
    // Propriedades
    public ?int $id;
    public int $usuario_id;
    public int $meta_id;
    public string $nome;
    public string $tipo_temporal;
    public ?string $periodo;
    public ?string $horario;
    public int $duracao;
    public string $data_execucao;
    public string $status;
    public ?string $data_criacao;

    // Propriedades para dados das tabelas relacionadas
    public ?string $meta_nome = null;

    // Construtor
    public function __construct() {
        // Construtor vazio para facilitar instanciação via PDO
    }

    // Busca todas as tarefas de um usuário com informações da meta associada
    public static function buscarTodosPorUsuario(int $usuario_id): array {
        $sql = "SELECT
                    t.*,
                    m.nome AS meta_nome
                FROM
                    tarefa t
                JOIN
                    meta m ON t.meta_id = m.id
                WHERE
                    t.usuario_id = :usuario_id
                ORDER BY
                    t.data_execucao ASC, t.horario ASC";

        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Cria uma nova tarefa na base de dados
    public function criar(): bool {
        $sql = "INSERT INTO tarefa (usuario_id, meta_id, nome, tipo_temporal, periodo, horario, duracao, data_execucao, status)
                VALUES (:usuario_id, :meta_id, :nome, :tipo_temporal, :periodo, :horario, :duracao, :data_execucao, :status)";

        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        return $stmt->execute([
            ':usuario_id' => $this->usuario_id,
            ':meta_id' => $this->meta_id,
            ':nome' => $this->nome,
            ':tipo_temporal' => $this->tipo_temporal,
            ':periodo' => $this->periodo,
            ':horario' => $this->horario,
            ':duracao' => $this->duracao,
            ':data_execucao' => $this->data_execucao,
            ':status' => $this->status,
        ]);
    }
}
