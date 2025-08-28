<form id="formulario-pilar" method="POST">

    <!-- Campo para armazenar o ID do pilar ao editar -->
    <input type="hidden" id="pilar-id" name="id" value="">

    <!-- Campo Nome -->
    <div class="grupo-campo">
        <label for="pilar-nome" class="rotulo-campo">Nome do Pilar</label>
        <input type="text" id="pilar-nome" name="nome" class="entrada-campo" required>
    </div>

    <!-- Campo Descrição -->
    <div class="grupo-campo">
        <label for="pilar-descricao" class="rotulo-campo">Descrição (Opcional)</label>
        <textarea id="pilar-descricao" name="descricao" class="entrada-campo" rows="4"></textarea>
    </div>

    <!-- Campo Cor -->
    <div class="grupo-campo">
        <label for="pilar-cor" class="rotulo-campo">Cor de Destaque</label>
        <input type="color" id="pilar-cor" name="cor" class="entrada-cor" value="#6b46c1">
    </div>

</form>
