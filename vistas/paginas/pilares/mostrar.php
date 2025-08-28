<div class="pilar-detalhes-cabecalho" style="border-bottom: 3px solid <?= htmlspecialchars($pilar->cor) ?>;">
    <p><a href="/pilares" class="link-voltar"><i class="fas fa-arrow-left"></i> Voltar para todos os pilares</a></p>
    <h2><?= htmlspecialchars($pilar->nome) ?></h2>
    <p class="pilar-descricao"><?= htmlspecialchars($pilar->descricao ?? 'Nenhuma descrição fornecida.') ?></p>
</div>

<div class="secao-gerenciamento">
    <div class="secao-cabecalho">
        <h3>Categorias</h3>
        <button class="botao botao-primario" data-modal-alvo="modal-categoria">
            <i class="fas fa-plus"></i> Adicionar Categoria
        </button>
    </div>

    <div class="lista-itens">
        <?php if (empty($categorias)): ?>
            <p>Nenhuma categoria foi criada para este pilar ainda.</p>
        <?php else: ?>
            <?php foreach ($categorias as $categoria): ?>
                <div class="item-gerenciavel">
                    <span><?= htmlspecialchars($categoria->nome) ?></span>
                    <div class="item-acoes">
                        <button class="botao-icone" title="Editar"><i class="fas fa-edit"></i></button>
                        <button class="botao-icone" title="Deletar"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para Adicionar/Editar Categoria -->
<div id="modal-categoria" class="modal">
    <div class="modal-conteudo">
        <div class="modal-cabecalho">
            <h3 id="modal-categoria-titulo">Adicionar Nova Categoria</h3>
            <span class="modal-fechar" data-modal-fechar="true">&times;</span>
        </div>
        <div class="modal-corpo">
            <?php require_once DIRETORIO_RAIZ . '/vistas/paginas/categorias/formulario_modal.php'; ?>
        </div>
        <div class="modal-rodape">
            <button type="button" class="botao botao-secundario" data-modal-fechar="true">Cancelar</button>
            <button type="submit" form="formulario-categoria" class="botao botao-primario">Salvar Categoria</button>
        </div>
    </div>
</div>
