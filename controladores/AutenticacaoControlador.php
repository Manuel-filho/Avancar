<?php

namespace App\Controladores;

class AutenticacaoControlador {

    // Renderiza uma página de conteúdo dentro do layout principal
    private function renderizar(string $vista, array $dados = []): string {
        // Extrai os dados para uso direto na vista
        extract($dados);

        // Inicia o buffer de saída para capturar o HTML da vista
        ob_start();
        require_once DIRETORIO_RAIZ . "/vistas/paginas/{$vista}.php";
        $conteudo = ob_get_clean();

        // Inicia outro buffer para capturar o layout principal com o conteúdo
        ob_start();
        require_once DIRETORIO_RAIZ . '/vistas/layouts/principal.php';
        return ob_get_clean();
    }

    // Prepara e exibe a página de login
    public function login(): string {
        $dados = [
            'titulo' => 'Login',
            'titulo_pagina' => 'Acessar sua Conta'
        ];
        return $this->renderizar('login', $dados);
    }

    // Prepara e exibe a página de registo
    public function registo(): string {
        $dados = [
            'titulo' => 'Registo',
            'titulo_pagina' => 'Criar Nova Conta'
        ];
        return $this->renderizar('registo', $dados);
    }
}
