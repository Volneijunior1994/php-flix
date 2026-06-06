<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><title>Login</title></head>
<body>
    <main>
        <h2>Entrar no Sistema</h2>
        <form action="LoginController.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo isset($_COOKIE['lembrar_usuario']) ? $_COOKIE['lembrar_usuario'] : ''; ?>" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <label>
                <input type="checkbox" name="lembrar"> Lembrar-me
            </label>
            
            <button type="submit">Entrar</button>
        </form>
        <a href="cadastro.php">Criar conta</a> | <a href="recuperar_senha.php">Esqueci a senha</a>
    </main>
</body>
</html>