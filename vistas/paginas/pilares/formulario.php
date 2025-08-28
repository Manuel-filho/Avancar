<div class="cartao-formulario">
    <form action="<?= $acao ?>" method="POST">

        <!-- Campo Nome -->
        <div class="grupo-campo">
            <label for="nome" class="rotulo-campo">Nome do Pilar</label>
            <input type="text" id="nome" name="nome" class="entrada-campo"
                   value="<?= htmlspecialchars($pilar->nome ?? '') ?>" required>
        </div>

        <!-- Campo Descrição -->
        <div class="grupo-campo">
            <label for="descricao" class="rotulo-campo">Descrição (Opcional)</label>
            <textarea id="descricao" name="descricao" class="entrada-campo" rows="4"><?= htmlspecialchars($pilar->descricao ?? '') ?></textarea>
        </div>

        <!-- Campo Cor -->
        <div class="grupo-campo">
            <label for="cor" class="rotulo-campo">Cor de Destaque</label>
            <input type="color" id="cor" name="cor" class="entrada-cor"
                   value="<?= htmlspecialchars($pilar->cor ?? '#6b46c1') ?>">
        </div>

        <div class="acoes-formulario">
            <a href="/pilares" class="botao botao-secundario">Cancelar</a>
            <button type="submit" class="botao botao-primario">
                <?= ($pilar) ? 'Salvar Alterações' : 'Criar Pilar' ?>
            </button>
        </div>

    </form>
</div>
