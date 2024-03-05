<?php require_once __DIR__.'/../template/html_topo.php';?>

<main>
    <h2>Login</h2>
    <form action="/login/logar" method="post">
        <p>
            <label for="user">Usuário:</label><br>
            <input type="email" name="user" id="user" required>
        </p>
        <p>
            <label for="password">Senha:</label><br>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <input type="submit" value="Logar">
        </p>                
    </form>
    <p>
        <strong><?=$_SESSION['mensagem'] ?? ''?></strong>
    </p>
</main>

<?php require_once __DIR__.'/../template/html_rodape.php'; ?>