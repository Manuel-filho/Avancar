<form id="formulario-categoria" action="/categorias" method="POST">

    <input type="hidden" name="pilar_id" value="<?= $pilar->id ?>">

    <!-- Campo Nome -->
    <div class="grupo-campo">
        <label for="categoria-nome" class="rotulo-campo">Nome da Categoria</label>
        <input type="text" id="categoria-nome" name="nome" class="entrada-campo" required>
    </div>

    <!-- O rodapé do modal com os botões será adicionado na vista principal -->

</form>
