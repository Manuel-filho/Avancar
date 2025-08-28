<form id="formulario-meta" method="POST">

    <input type="hidden" id="meta-id" name="id" value="">

    <!-- Campo Nome -->
    <div class="grupo-campo">
        <label for="meta-nome" class="rotulo-campo">Nome da Meta</label>
        <input type="text" id="meta-nome" name="nome" class="entrada-campo" required>
    </div>

    <!-- Campo Descrição -->
    <div class="grupo-campo">
        <label for="meta-descricao" class="rotulo-campo">Descrição (Opcional)</label>
        <textarea id="meta-descricao" name="descricao" class="entrada-campo" rows="3"></textarea>
    </div>

    <hr class="divisor-form">

    <!-- Seleção de Hierarquia -->
    <div class="grupo-campo">
        <label for="meta-pilar" class="rotulo-campo">Pilar</label>
        <select name="pilar_id" id="meta-pilar" class="entrada-campo" required>
            <option value="">Selecione um Pilar...</option>
            <?php foreach ($pilares as $pilar): ?>
                <option value="<?= $pilar->id ?>"><?= htmlspecialchars($pilar->nome) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="grupo-campo">
        <label for="meta-categoria" class="rotulo-campo">Categoria</label>
        <select name="categoria_id" id="meta-categoria" class="entrada-campo" required disabled>
            <option value="">Selecione uma Categoria...</option>
        </select>
    </div>
    <div class="grupo-campo">
        <label for="meta-subcategoria" class="rotulo-campo">Subcategoria (Opcional)</label>
        <select name="subcategoria_id" id="meta-subcategoria" class="entrada-campo" disabled>
            <option value="">Selecione uma Subcategoria...</option>
        </select>
    </div>

    <hr class="divisor-form">

    <!-- Campos de Data -->
    <div class="grid-2">
        <div class="grupo-campo">
            <label for="meta-data-inicio" class="rotulo-campo">Data de Início</label>
            <input type="date" id="meta-data-inicio" name="data_inicio" class="entrada-campo" required>
        </div>
        <div class="grupo-campo">
            <label for="meta-data-fim" class="rotulo-campo">Data de Fim</label>
            <input type="date" id="meta-data-fim" name="data_fim" class="entrada-campo" required>
        </div>
    </div>

</form>
