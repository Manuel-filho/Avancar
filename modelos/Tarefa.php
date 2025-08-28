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

    // TO-DO: Implementar outros métodos CRUD (criar, buscarPorId, atualizar, deletar)
}
