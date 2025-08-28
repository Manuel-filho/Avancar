<?php

namespace App\Configuracao;

use PDO;
use PDOException;

class BaseDados {
    // Armazena a instância única da conexão PDO
    private static ?PDO $instancia = null;

    // Previne a criação de instâncias via construtor
    private function __construct() {}

    // Previne a clonagem da instância
    private function __clone() {}

    // Previne a desserialização da instância
    public function __wakeup() {}

    // Obtém a instância Singleton da conexão PDO
    public static function obterInstancia(): PDO {
        if (self::$instancia === null) {
            $host = 'localhost';
            $dbname = 'avancar';
            $user = 'root';
            $pass = ''; // A senha deve ser gerenciada de forma segura
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $opcoes = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$instancia = new PDO($dsn, $user, $pass, $opcoes);
            } catch (PDOException $e) {
                // Em um ambiente de produção, logar o erro em vez de exibi-lo
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$instancia;
    }
}
