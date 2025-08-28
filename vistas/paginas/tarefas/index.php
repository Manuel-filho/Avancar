<div class="cabecalho-pagina">
    <h1 class="titulo-pagina">Minhas Tarefas</h1>
    <button class="botao botao-primario" disabled>
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
                            <td>
                                <button class="botao-icone" title="Editar"><i class="fas fa-edit"></i></button>
                                <button class="botao-icone" title="Deletar"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
