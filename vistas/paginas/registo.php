<div class="cartao-autenticacao">
    <form action="/registo" method="POST">
        <div class="grupo-campo">
            <label for="nome" class="rotulo-campo">
                <i class="fas fa-user"></i>
                Nome
            </label>
            <input type="text" id="nome" name="nome" class="entrada-campo" required>
        </div>

        <div class="grupo-campo">
            <label for="email" class="rotulo-campo">
                <i class="fas fa-envelope"></i>
                Email
            </label>
            <input type="email" id="email" name="email" class="entrada-campo" required>
        </div>

        <div class="grupo-campo">
            <label for="senha" class="rotulo-campo">
                <i class="fas fa-lock"></i>
                Senha
            </label>
            <input type="password" id="senha" name="senha" class="entrada-campo" required>
        </div>

        <div class="grupo-campo">
            <label for="confirmar_senha" class="rotulo-campo">
                <i class="fas fa-lock"></i>
                Confirmar Senha
            </label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" class="entrada-campo" required>
        </div>

        <button type="submit" class="botao botao-primario botao-bloco">
            Criar Conta
        </button>
    </form>
    <div class="link-rodape-cartao">
        <p>Já tem uma conta? <a href="/login">Faça login</a></p>
    </div>
</div>
