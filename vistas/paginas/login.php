<div class="cartao-autenticacao">
    <form action="/login" method="POST">
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

        <button type="submit" class="botao botao-primario botao-bloco">
            Entrar
        </button>
    </form>
    <div class="link-rodape-cartao">
        <p>Não tem uma conta? <a href="/registo">Crie uma agora</a></p>
    </div>
</div>
