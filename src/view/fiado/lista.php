<?php require_once __DIR__.'/../template/html_topo.php'; ?>

<main>
    <h2>Fiados</h2>
    
    <?php if(sizeof($fiadoList) > 0) {?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th></th>
            </tr>            
        </thead>
        <tbody>
            <?php 
                $total = 0;
                foreach($fiadoList as $f) {
                    $total += $f->getValor();
                    echo "
                    <tr>
                        <td>{$f->getId()}</td>
                        <td>{$f->getNomeCliente()}</td>
                        <td>{$f->getValorFormatado()}</td>
                        <td><a href=\"/fiado/editar?id={$f->getId()}\">&#x270f;Editar</a></td>
                        <td><a href=\"/fiado/excluir?id={$f->getId()}\">&#x1f5d1;Excluir</a></td>
                    </tr>";
                }
            ?>            
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total:</td>
                <td><?='R$ '.number_format($total, 2, ',', '.')?></td>
            </tr>
        </tfoot>
    </table>
    <?php } else { ?>
    <p><strong><i>Não há fiados cadastrados.</i></strong></p>
    <?php } ?>
    
</main>

<?php require_once __DIR__.'/../template/html_rodape.php'; ?>