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

// Rota para processar o formulário de registo
$roteamento->adicionar('POST', '/registo', function() {
    return (new AutenticacaoControlador())->registar();
});

// Rota para processar o formulário de login
$roteamento->adicionar('POST', '/login', function() {
    return (new AutenticacaoControlador())->entrar();
});

// Rota para fazer logout
$roteamento->adicionar('GET', '/logout', function() {
    return (new AutenticacaoControlador())->sair();
});

// --- Rotas para Gestão de Pilares ---

use App\Controladores\PilarControlador;
use App\Controladores\CategoriaControlador;

// --- Rotas para Gestão de Categorias (AJAX) ---
$roteamento->adicionar('POST', '/categorias', function() {
    return (new CategoriaControlador())->armazenar();
});
$roteamento->adicionar('GET', '/categorias/{id}', function($id) {
    return (new CategoriaControlador())->buscar($id);
});
$roteamento->adicionar('POST', '/categorias/{id}/atualizar', function($id) {
    return (new CategoriaControlador())->atualizar($id);
});
$roteamento->adicionar('POST', '/categorias/{id}/deletar', function($id) {
    return (new CategoriaControlador())->deletar($id);
});

use App\Controladores\SubcategoriaControlador;

// --- Rotas para Gestão de Subcategorias (AJAX) ---
$roteamento->adicionar('POST', '/subcategorias', function() {
    return (new SubcategoriaControlador())->armazenar();
});
$roteamento->adicionar('GET', '/subcategorias/{id}', function($id) {
    return (new SubcategoriaControlador())->buscar($id);
});
$roteamento->adicionar('POST', '/subcategorias/{id}/atualizar', function($id) {
    return (new SubcategoriaControlador())->atualizar($id);
});
$roteamento->adicionar('POST', '/subcategorias/{id}/deletar', function($id) {
    return (new SubcategoriaControlador())->deletar($id);
});

use App\Controladores\MetaControlador;

// --- Rotas para Gestão de Metas ---
$roteamento->adicionar('GET', '/metas', function() {
    return (new MetaControlador())->index();
});

// Rota para listar todos os pilares
$roteamento->adicionar('GET', '/pilares', function() {
    return (new PilarControlador())->index();
});

// Rota para exibir os detalhes de um pilar
$roteamento->adicionar('GET', '/pilares/{id}', function($id) {
    return (new PilarControlador())->mostrar($id);
});

// Rota para armazenar um novo pilar (AJAX)
$roteamento->adicionar('POST', '/pilares/armazenar', function() {
    return (new PilarControlador())->armazenar();
});

// Rota para atualizar um pilar existente (AJAX)
$roteamento->adicionar('POST', '/pilares/{id}/atualizar', function($id) {
    return (new PilarControlador())->atualizar($id);
});

// Rota para deletar um pilar
$roteamento->adicionar('POST', '/pilares/{id}/deletar', function($id) {
    return (new PilarControlador())->deletar($id);
});
