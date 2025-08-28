<?php

namespace App\Core;

class Resposta {
    // Define o código de status da resposta HTTP
    public function definirCodigo(int $codigo): void {
        http_response_code($codigo);
    }

    // Envia o conteúdo final para o cliente
    public function enviar($conteudo): void {
        echo $conteudo;
    }
}
