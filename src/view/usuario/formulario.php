<?php require_once __DIR__.'/../template/html_topo.php';?>

<main>
    <h2>Novo Usuário</h2>
    <form action="<?=isset($usuario) ? "/usuario/atualizar?id={$usuario->getId()}" : '/usuario/inserir'?>" method="post">
        <p>
            <label for="user">Usuário:</label><br>
            <input type="email" name="user" id="user" 
                value="<?=isset($usuario) ? $usuario->getUser() : ''?>" required>
        </p>
        <p>
            <label for="password">Senha:</label><br>
            <input type="password" name="password" id="password" min="8" max="8" required>
        </p>
        <p>
            <input type="submit" value="Salvar">
            <input type="button" value="Cancelar"
                onclick="javascript:window.location.href='/usuario/listar'">
        </p>                
    </form>
</main>

<?php require_once __DIR__.'/../template/html_rodape.php'; ?>