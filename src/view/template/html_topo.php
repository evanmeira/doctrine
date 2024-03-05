<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctrine - Fiados</title>
</head>
<body>
    <header>
        <h1>Gestão de Fiados</h1>
        <?php if(isset($_SESSION['user'])) { ?>
        <nav>
            <hr>
            <a href="/fiado/">Home</a>
            | <a href="/fiado/listar">Fiados</a>
            | <a href="/fiado/novo">Novo Fiado</a>            
            | <a href="/usuario/listar">Usuários</a>
            | <a href="/usuario/novo">Novo Usuário</a>
            <hr>
        </nav>
        <div>
            <i>Usuário: <?=$_SESSION['user']?></i>
            <a href="/login/logoff">Sair</a>
        </div>
        <?php } ?>
    </header>