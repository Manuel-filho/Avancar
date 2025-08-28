<div class="cabecalho-pagina">
    <a href="/pilares/criar" class="botao botao-primario">
        <i class="fas fa-plus"></i> Novo Pilar
    </a>
</div>

<div class="grade-pilares">
    <?php if (empty($pilares)): ?>
        <div class="cartao-vazio">
            <h3>Nenhum pilar encontrado.</h3>
            <p>Comece a organizar sua vida criando seu primeiro pilar!</p>
        </div>
    <?php else: ?>
        <?php foreach ($pilares as $pilar): ?>
            <a href="/pilares/<?= $pilar->id ?>" class="cartao-pilar-link">
                <div class="cartao-pilar" style="border-left-color: <?= htmlspecialchars($pilar->cor) ?>;">
                    <div class="cartao-pilar-cabecalho">
                        <h3><?= htmlspecialchars($pilar->nome) ?></h3>
                        <div class="cartao-pilar-acoes" onclick="event.stopPropagation();">
                            <a href="/pilares/<?= $pilar->id ?>/editar" class="botao-icone" title="Editar"><i class="fas fa-edit"></i></a>
                            <form action="/pilares/<?= $pilar->id ?>/deletar" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja deletar este pilar?');">
                                <button type="submit" class="botao-icone" title="Deletar"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="cartao-pilar-corpo">
                        <p><?= htmlspecialchars($pilar->descricao ?? 'Sem descrição.') ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
