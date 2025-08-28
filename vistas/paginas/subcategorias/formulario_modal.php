<form id="formulario-subcategoria" action="/subcategorias" method="POST">

    <!-- Este valor será preenchido dinamicamente via JavaScript -->
    <input type="hidden" id="subcategoria-categoria-id" name="categoria_id" value="">

    <!-- Campo Nome -->
    <div class="grupo-campo">
        <label for="subcategoria-nome" class="rotulo-campo">Nome da Subcategoria</label>
        <input type="text" id="subcategoria-nome" name="nome" class="entrada-campo" required>
    </div>

</form>
