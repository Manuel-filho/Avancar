<?php

namespace App\Core;

class Roteamento {
    // Armazena todas as rotas registradas
    private array $rotas = [];

    // Registra uma nova rota na aplicação
    public function adicionar(string $metodo, string $uri, callable $acao): void {
        $this->rotas[] = [
            'metodo' => $metodo,
            'uri' => $uri,
            'acao' => $acao
        ];
    }

    // Busca a rota correspondente à requisição atual
    public function encontrar(string $metodo, string $uri): ?callable {
        foreach ($this->rotas as $rota) {
            if ($rota['metodo'] === $metodo && $rota['uri'] === $uri) {
                return $rota['acao'];
            }
        }
        return null;
    }
}
