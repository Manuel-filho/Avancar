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

// --- Rotas para Gestão de Pilares ---

use App\Controladores\PilarControlador;

// Rota para listar todos os pilares
$roteamento->adicionar('GET', '/pilares', function() {
    return (new PilarControlador())->index();
});

// Rota para exibir o formulário de criação de pilar
$roteamento->adicionar('GET', '/pilares/criar', function() {
    return (new PilarControlador())->criar();
});

// Rota para armazenar um novo pilar (recebe dados do formulário)
$roteamento->adicionar('POST', '/pilares/armazenar', function() {
    return (new PilarControlador())->armazenar();
});

// Rota para exibir o formulário de edição de pilar
$roteamento->adicionar('GET', '/pilares/{id}/editar', function($id) {
    return (new PilarControlador())->editar($id);
});

// Rota para atualizar um pilar existente (recebe dados do formulário)
$roteamento->adicionar('POST', '/pilares/{id}/atualizar', function($id) {
    return (new PilarControlador())->atualizar($id);
});

// Rota para deletar um pilar
$roteamento->adicionar('POST', '/pilares/{id}/deletar', function($id) {
    return (new PilarControlador())->deletar($id);
});
