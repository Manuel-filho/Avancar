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

    // Busca a rota correspondente à requisição, extraindo parâmetros da URI
    public function encontrar(string $metodo, string $uri): ?array {
        foreach ($this->rotas as $rota) {
            if ($rota['metodo'] !== $metodo) {
                continue;
            }

            // Converte a URI da rota em um padrão de expressão regular
            $padrao = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^\/]+)', $rota['uri']);
            $padraoRegex = '#^' . $padrao . '$#';

            // Verifica se a URI da requisição corresponde ao padrão
            if (preg_match($padraoRegex, $uri, $matches)) {
                $parametros = [];
                // Extrai os parâmetros nomeados da correspondência
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $parametros[$key] = $value;
                    }
                }
                return [
                    'acao' => $rota['acao'],
                    'parametros' => $parametros,
                ];
            }
        }
        return null;
    }
}
