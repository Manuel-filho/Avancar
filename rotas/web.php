<?php

use App\Controladores\AutenticacaoControlador;

// Define as rotas da aplicação web.
// A variável $roteamento é injetada a partir do index.php.

// Rota para exibir a página de login
$roteamento->adicionar('GET', '/login', function() {
    return (new AutenticacaoControlador())->login();
});

// Rota para exibir a página de registo
$roteamento->adicionar('GET', '/registo', function() {
    return (new AutenticacaoControlador())->registo();
});
