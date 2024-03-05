<?php require_once __DIR__.'/../template/html_topo.php';?>

<main>
    <h2><?=isset($fiado) ? 'Fiado' : 'Novo fiado'?></h2>
    <form action="<?=isset($fiado) ? "/fiado/atualizar?id={$fiado->getId()}" : '/fiado/inserir'?>" method="post">
        <p>
            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" 
                value="<?=isset($fiado) ? $fiado->getNomeCliente() : ''?>" required>
        </p>
        <p>
            <label for="valor">Valor:</label><br>
            <input type="number" name="valor" id="valor" 
                step="0.1" min="1"  
                value="<?=isset($fiado) ? $fiado->getValor() : ''?>" required>
        </p>
        <p>
            <input type="submit" value="Salvar">
            <input type="button" value="Cancelar"
                onclick="javascript:window.location.href='/fiado/listar'">
        </p>                
    </form>
</main>

<?php require_once __DIR__.'/../template/html_rodape.php'; ?>