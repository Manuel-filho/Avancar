<?php

// Ponto de entrada principal da aplicação

// Carrega as constantes globais da aplicação
require_once __DIR__ . '/configuracao/constantes.php';

// Registra a função de autoload para carregar classes automaticamente
spl_autoload_register(function ($classe) {
    // Remove o prefixo 'App\' do namespace
    $classeRelativa = preg_replace('/^App\\\/', '', $classe);

    // Converte o namespace em um caminho de arquivo e torna o primeiro diretório minúsculo
    $partes = explode('\\', $classeRelativa);
    $partes[0] = strtolower($partes[0]);
    $caminho = DIRETORIO_RAIZ . '/' . implode('/', $partes) . '.php';

    if (file_exists($caminho)) {
        require_once $caminho;
    }
});

use App\Core\Aplicacao;
use App\Core\Requisicao;
use App\Core\Resposta;
use App\Core\Roteamento;

// Inicializa os componentes do núcleo da aplicação
$requisicao = new Requisicao();
$resposta = new Resposta();
$roteamento = new Roteamento();

// Carrega as definições de rotas da aplicação
require_once DIRETORIO_RAIZ . '/rotas/web.php';

// Cria a instância principal da aplicação e a executa
$app = new Aplicacao($roteamento, $requisicao, $resposta);
$app->executar();
