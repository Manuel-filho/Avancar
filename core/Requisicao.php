<?php

namespace App\Core;

class Requisicao {
    // Obtém o método da requisição (GET, POST, etc.)
    public function metodo(): string {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    // Obtém a URI da requisição, sem a query string
    public function uri(): string {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
