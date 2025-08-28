<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Avançar' ?></title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- CSS Principal -->
    <link rel="stylesheet" href="/recursos/css/principal.css">
</head>
<body>
    <div class="app-recipiente">
        <!-- Menu Lateral Fixo -->
        <aside class="menu-lateral">
            <div class="menu-lateral-cabecalho">
                <h2>Avançar</h2>
            </div>
            <nav class="menu-lateral-navegacao">
                <!-- Links de navegação serão adicionados aqui -->
                <a href="#"><i class="fas fa-home"></i> Dashboard</a>
                <a href="#"><i class="fas fa-calendar-day"></i> Dia</a>
                <a href="/pilares"><i class="fas fa-columns"></i> Pilares</a>
                <a href="/metas"><i class="fas fa-bullseye"></i> Metas</a>
            </nav>

            <div class="menu-lateral-rodape">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </aside>

        <!-- Conteúdo Principal -->
        <main class="conteudo-principal">
            <header class="conteudo-cabecalho">
                <h1><?= $titulo_pagina ?? 'Bem-vindo' ?></h1>
            </header>
            <div class="conteudo">
                <!-- O conteúdo da página específica será injetado aqui -->
                <?= $conteudo ?? '' ?>
            </div>
        </main>
    </div>

    <!-- Scripts JS -->
    <script src="/recursos/js/principal.js"></script>
</body>
</html>
