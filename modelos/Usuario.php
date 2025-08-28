<?php

namespace App\Modelos;

use App\Configuracao\BaseDados;
use PDO;

class Usuario {
    // Propriedades
    public ?int $id = null;
    public ?string $nome = null;
    public ?string $email = null;
    public ?string $senha = null;
    public ?string $data_criacao = null;

    // Cria um novo usuário na base de dados
    public function criar(): bool {
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);

        // Hash da senha para segurança
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':senha' => $this->senha,
        ]);
    }

    // Busca um usuário pelo seu email
    public static function buscarPorEmail(string $email): ?self {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $bd = BaseDados::obterInstancia();
        $stmt = $bd->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute([':email' => $email]);
        $resultado = $stmt->fetch();
        return $resultado ?: null;
    }
}
