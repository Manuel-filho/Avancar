<div class="cabecalho-pagina">
    <button class="botao botao-primario" data-modal-alvo="modal-pilar" id="botao-novo-pilar">
        <i class="fas fa-plus"></i> Novo Pilar
    </button>
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
                            <button class="botao-icone botao-editar-pilar" title="Editar"
                                    data-modal-alvo="modal-pilar"
                                    data-pilar-id="<?= $pilar->id ?>"
                                    data-pilar-nome="<?= htmlspecialchars($pilar->nome) ?>"
                                    data-pilar-descricao="<?= htmlspecialchars($pilar->descricao ?? '') ?>"
                                    data-pilar-cor="<?= htmlspecialchars($pilar->cor) ?>">
                                <i class="fas fa-edit"></i>
                            </button>
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

<!-- Modal para Adicionar/Editar Pilar -->
<div id="modal-pilar" class="modal">
    <div class="modal-conteudo">
        <div class="modal-cabecalho">
            <h3 id="modal-pilar-titulo">Novo Pilar</h3>
            <span class="modal-fechar" data-modal-fechar="true">&times;</span>
        </div>
        <div class="modal-corpo">
            <?php require_once DIRETORIO_RAIZ . '/vistas/paginas/pilares/formulario_modal.php'; ?>
        </div>
        <div class="modal-rodape">
            <button type="button" class="botao botao-secundario" data-modal-fechar="true">Cancelar</button>
            <button type="submit" form="formulario-pilar" class="botao botao-primario">Salvar</button>
        </div>
    </div>
</div>
