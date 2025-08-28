<form id="formulario-tarefa" method="POST">

    <input type="hidden" id="tarefa-id" name="id" value="">

    <!-- Campo Meta -->
    <div class="grupo-campo">
        <label for="tarefa-meta" class="rotulo-campo">Associar à Meta</label>
        <select name="meta_id" id="tarefa-meta" class="entrada-campo" required>
            <option value="">Selecione uma Meta...</option>
            <?php foreach ($metas as $meta): ?>
                <option value="<?= $meta->id ?>"><?= htmlspecialchars($meta->nome) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Campo Nome -->
    <div class="grupo-campo">
        <label for="tarefa-nome" class="rotulo-campo">Nome da Tarefa</label>
        <input type="text" id="tarefa-nome" name="nome" class="entrada-campo" required>
    </div>

    <hr class="divisor-form">

    <!-- Tipo Temporal -->
    <div class="grupo-campo">
        <label class="rotulo-campo">Tipo de Agendamento</label>
        <div class="grupo-radio">
            <input type="radio" id="tipo-arbitraria" name="tipo_temporal" value="arbitraria" checked>
            <label for="tipo-arbitraria">Arbitrária</label>

            <input type="radio" id="tipo-periodo" name="tipo_temporal" value="periodo">
            <label for="tipo-periodo">Período do Dia</label>

            <input type="radio" id="tipo-hora-marcada" name="tipo_temporal" value="hora_marcada">
            <label for="tipo-hora-marcada">Hora Marcada</label>
        </div>
    </div>

    <!-- Campos Condicionais -->
    <div id="campo-periodo" class="grupo-campo campo-condicional" style="display: none;">
        <label for="tarefa-periodo" class="rotulo-campo">Período</label>
        <select name="periodo" id="tarefa-periodo" class="entrada-campo">
            <option value="manha">Manhã</option>
            <option value="tarde">Tarde</option>
            <option value="noite">Noite</option>
        </select>
    </div>

    <div id="campo-horario" class="grupo-campo campo-condicional" style="display: none;">
        <label for="tarefa-horario" class="rotulo-campo">Horário</label>
        <input type="time" id="tarefa-horario" name="horario" class="entrada-campo">
    </div>

    <hr class="divisor-form">

    <!-- Campos de Data e Duração -->
    <div class="grid-2">
        <div class="grupo-campo">
            <label for="tarefa-data-execucao" class="rotulo-campo">Data de Execução</label>
            <input type="date" id="tarefa-data-execucao" name="data_execucao" class="entrada-campo" required>
        </div>
        <div class="grupo-campo">
            <label for="tarefa-duracao" class="rotulo-campo">Duração (minutos)</label>
            <input type="number" id="tarefa-duracao" name="duracao" class="entrada-campo" min="0" value="30">
        </div>
    </div>

</form>
