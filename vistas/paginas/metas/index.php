<div class="cabecalho-pagina">
    <h1 class="titulo-pagina">Minhas Metas</h1>
    <button class="botao botao-primario" disabled>
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
                        <button class="botao-icone" title="Editar"><i class="fas fa-edit"></i></button>
                        <button class="botao-icone" title="Deletar"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
