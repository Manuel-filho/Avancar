<?php

namespace App\Modelos;

class Usuario {
    // Identificador único do usuário
    public ?int $id = null;
    // Nome do usuário
    public ?string $nome = null;
    // Email do usuário
    public ?string $email = null;
    // Senha do usuário (armazenada como hash)
    public ?string $senha = null;
}
