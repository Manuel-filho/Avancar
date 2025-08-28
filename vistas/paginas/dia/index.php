<div class="pagina-dia">

    <!-- Seção de Hora Marcada -->
    <div class="secao-dia">
        <h3 class="secao-dia-titulo">🕐 Hora Marcada</h3>
        <div class="lista-tarefas-dia">
            <?php if (empty($tarefas['hora_marcada'])): ?>
                <p class="sem-tarefas">Nenhuma tarefa com hora marcada para hoje.</p>
            <?php else: ?>
                <?php foreach ($tarefas['hora_marcada'] as $tarefa): ?>
                    <div class="item-tarefa-dia status-<?= $tarefa->status ?>">
                        <input type="checkbox" id="tarefa-<?= $tarefa->id ?>" class="checkbox-tarefa" <?= $tarefa->status === 'concluida' ? 'checked' : '' ?>>
                        <label for="tarefa-<?= $tarefa->id ?>">
                            <span class="horario-tarefa"><?= date('H:i', strtotime($tarefa->horario)) ?></span>
                            <?= htmlspecialchars($tarefa->nome) ?>
                            <span class="meta-tarefa-dia">(<?= htmlspecialchars($tarefa->meta_nome) ?>)</span>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Seção de Períodos -->
    <div class="grid-periodos">
        <div class="secao-dia">
            <h3 class="secao-dia-titulo">🌅 Manhã</h3>
            <div class="lista-tarefas-dia">
                <?php if (empty($tarefas['manha'])): ?>
                    <p class="sem-tarefas">Nenhuma tarefa para a manhã.</p>
                <?php else: ?>
                    <?php foreach ($tarefas['manha'] as $tarefa): ?>
                        <div class="item-tarefa-dia status-<?= $tarefa->status ?>">
                            <input type="checkbox" id="tarefa-<?= $tarefa->id ?>" class="checkbox-tarefa" <?= $tarefa->status === 'concluida' ? 'checked' : '' ?>>
                            <label for="tarefa-<?= $tarefa->id ?>"><?= htmlspecialchars($tarefa->nome) ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="secao-dia">
            <h3 class="secao-dia-titulo">☀️ Tarde</h3>
            <div class="lista-tarefas-dia">
                <?php if (empty($tarefas['tarde'])): ?>
                    <p class="sem-tarefas">Nenhuma tarefa para a tarde.</p>
                <?php else: ?>
                    <?php foreach ($tarefas['tarde'] as $tarefa): ?>
                        <div class="item-tarefa-dia status-<?= $tarefa->status ?>">
                            <input type="checkbox" id="tarefa-<?= $tarefa->id ?>" class="checkbox-tarefa" <?= $tarefa->status === 'concluida' ? 'checked' : '' ?>>
                            <label for="tarefa-<?= $tarefa->id ?>"><?= htmlspecialchars($tarefa->nome) ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="secao-dia">
            <h3 class="secao-dia-titulo">🌙 Noite</h3>
            <div class="lista-tarefas-dia">
                <?php if (empty($tarefas['noite'])): ?>
                    <p class="sem-tarefas">Nenhuma tarefa para a noite.</p>
                <?php else: ?>
                    <?php foreach ($tarefas['noite'] as $tarefa): ?>
                        <div class="item-tarefa-dia status-<?= $tarefa->status ?>">
                            <input type="checkbox" id="tarefa-<?= $tarefa->id ?>" class="checkbox-tarefa" <?= $tarefa->status === 'concluida' ? 'checked' : '' ?>>
                            <label for="tarefa-<?= $tarefa->id ?>"><?= htmlspecialchars($tarefa->nome) ?></label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Seção de Tarefas Arbitrárias -->
    <div class="secao-dia">
        <h3 class="secao-dia-titulo">⏰ Arbitrárias</h3>
        <div class="lista-tarefas-dia">
            <?php if (empty($tarefas['arbitraria'])): ?>
                <p class="sem-tarefas">Nenhuma tarefa arbitrária para hoje.</p>
            <?php else: ?>
                <?php foreach ($tarefas['arbitraria'] as $tarefa): ?>
                    <div class="item-tarefa-dia status-<?= $tarefa->status ?>">
                        <input type="checkbox" id="tarefa-<?= $tarefa->id ?>" class="checkbox-tarefa" <?= $tarefa->status === 'concluida' ? 'checked' : '' ?>>
                        <label for="tarefa-<?= $tarefa->id ?>"><?= htmlspecialchars($tarefa->nome) ?></label>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
