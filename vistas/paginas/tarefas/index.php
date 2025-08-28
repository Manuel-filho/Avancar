<div class="cabecalho-pagina">
    <h1 class="titulo-pagina">Minhas Tarefas</h1>
    <button class="botao botao-primario" data-modal-alvo="modal-tarefa">
        <i class="fas fa-plus"></i> Nova Tarefa
    </button>
</div>

<div class="lista-tarefas">
    <?php if (empty($tarefas)): ?>
        <div class="cartao-vazio">
            <h3>Nenhuma tarefa encontrada.</h3>
            <p>Crie sua primeira tarefa para começar a organizar seu dia!</p>
        </div>
    <?php else: ?>
        <div class="cartao-lista">
            <table>
                <thead>
                    <tr>
                        <th>Tarefa</th>
                        <th>Meta Associada</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <tr>
                            <td><?= htmlspecialchars($tarefa->nome) ?></td>
                            <td><?= htmlspecialchars($tarefa->meta_nome) ?></td>
                            <td><?= date('d/m/Y', strtotime($tarefa->data_execucao)) ?></td>
                            <td><?= ucfirst(str_replace('_', ' ', $tarefa->tipo_temporal)) ?></td>
                            <td><span class="status-badge status-<?= $tarefa->status ?>"><?= ucfirst($tarefa->status) ?></span></td>
                            <td class="acoes-tabela">
                                <button class="botao-icone botao-editar-tarefa" title="Editar Tarefa"
                                        data-tarefa-id="<?= $tarefa->id ?>"
                                        data-modal-alvo="modal-tarefa">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="botao-icone botao-deletar-tarefa" title="Deletar Tarefa" data-tarefa-id="<?= $tarefa->id ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Modal para Adicionar/Editar Tarefa -->
<div id="modal-tarefa" class="modal">
    <div class="modal-conteudo">
        <div class="modal-cabecalho">
            <h3 id="modal-tarefa-titulo">Nova Tarefa</h3>
            <span class="modal-fechar" data-modal-fechar="true">&times;</span>
        </div>
        <div class="modal-corpo">
            <?php require_once DIRETORIO_RAIZ . '/vistas/paginas/tarefas/formulario_modal.php'; ?>
        </div>
        <div class="modal-rodape">
            <button type="button" class="botao botao-secundario" data-modal-fechar="true">Cancelar</button>
            <button type="submit" form="formulario-tarefa" class="botao botao-primario">Salvar Tarefa</button>
        </div>
    </div>
</div>
