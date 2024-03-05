<?php require_once __DIR__.'/template/html_topo.php'; ?>

<main>
    <h2>Página não encontrada!</h2>
    <p><?=@$_SERVER['PATH_INFO']?></p>
</main>

<?php require_once __DIR__.'/template/html_rodape.php'; ?>