<div class="cabecalho-pagina">
    <h1 class="titulo-pagina">Minhas Metas</h1>
    <button class="botao botao-primario" data-modal-alvo="modal-meta" id="botao-nova-meta">
        <i class="fas fa-plus"></i> Nova Meta
    </button>
</div>

<div class="lista-metas">
    <?php if (empty($metas)): ?>
        <div class="cartao-vazio">
            <h3>Nenhuma meta encontrada.</h3>
            <p>Defina sua primeira meta para começar a avançar!</p>
        </div>
    <?php else: ?>
        <?php foreach ($metas as $meta): ?>
            <div class="cartao-meta status-<?= htmlspecialchars($meta->status) ?>">
                <div class="cartao-meta-cabecalho">
                    <span class="meta-hierarquia">
                        <?= htmlspecialchars($meta->pilar_nome) ?> /
                        <?= htmlspecialchars($meta->categoria_nome) ?>
                        <?php if ($meta->subcategoria_nome): ?>
                             / <?= htmlspecialchars($meta->subcategoria_nome) ?>
                        <?php endif; ?>
                    </span>
                    <span class="meta-status"><?= str_replace('_', ' ', htmlspecialchars($meta->status)) ?></span>
                </div>
                <div class="cartao-meta-corpo">
                    <h3><?= htmlspecialchars($meta->nome) ?></h3>
                    <p><?= htmlspecialchars($meta->descricao ?? 'Sem descrição.') ?></p>
                </div>
                <div class="cartao-meta-rodape">
                    <span>Prazo: <?= date('d/m/Y', strtotime($meta->data_fim)) ?></span>
                    <div class="meta-acoes">
                        <button class="botao-icone botao-editar-meta" title="Editar Meta"
                                data-meta-id="<?= $meta->id ?>"
                                data-modal-alvo="modal-meta">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="botao-icone botao-deletar-meta" title="Deletar Meta" data-meta-id="<?= $meta->id ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal para Adicionar/Editar Meta -->
<div id="modal-meta" class="modal">
    <div class="modal-conteudo">
        <div class="modal-cabecalho">
            <h3 id="modal-meta-titulo">Nova Meta</h3>
            <span class="modal-fechar" data-modal-fechar="true">&times;</span>
        </div>
        <div class="modal-corpo">
            <?php require_once DIRETORIO_RAIZ . '/vistas/paginas/metas/formulario_modal.php'; ?>
        </div>
        <div class="modal-rodape">
            <button type="button" class="botao botao-secundario" data-modal-fechar="true">Cancelar</button>
            <button type="submit" form="formulario-meta" class="botao botao-primario">Salvar Meta</button>
        </div>
    </div>
</div>
