<?php require_once __DIR__.'/../template/html_topo.php'; ?>

<main>
    <h2>Usuários</h2>
    
    <?php if(sizeof($usuarioList) > 0) {?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th></th>
            </tr>            
        </thead>
        <tbody>
            <?php 
                foreach($usuarioList as $u) {
                    echo "
                    <tr>
                        <td>{$u->getId()}</td>
                        <td>{$u->getUser()}</td>
                        <td><a href=\"/usuario/editar?id={$u->getId()}\">&#x270f;Editar</a></td>
                        <td><a href=\"/usuario/excluir?id={$u->getId()}\">&#x1f5d1;Excluir</a></td>
                    </tr>";
                }
            ?>            
        </tbody>        
    </table>
    <?php } else { ?>
    <p><strong><i>Não há usuários cadastrados.</i></strong></p>
    <?php } ?>
    
</main>

<?php require_once __DIR__.'/../template/html_rodape.php'; ?>