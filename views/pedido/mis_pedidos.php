<?php if (isset($gestion) && $gestion == true): ?>
    <h1>Gestion de Pedidos</h1>
<?php else: ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>


<table>
    <tr>
        <th>No° Pedido</th>
        <th>Coste</th>       
        <th>Fecha</th>       
        <th>Estado</th>       
        <th>Acción</th>       

    </tr>
    <?php while ($pedido = $pedidos->fetch_object()): ?>
        <tr>   
            <td><?= $pedido->id ?></td>       
            <td>$<?= $pedido->coste ?></td>            
            <td><?= $pedido->fecha ?></td>            
            <td><?= Utils::showState($pedido->estado )?></td>            
            <td>
                <?php if (isset($gestion) && $gestion == true): ?>                   
                    <a href="<?= base_url ?>pedido/detalle&gestion&id=<?= $pedido->id ?>" class="button-small"><i class="far fa-eye"></i></a>
                <?php else: ?>                   
                    <a href="<?= base_url ?>pedido/detalle&id=<?= $pedido->id ?>" class="button-small"><i class="far fa-eye"></i></a>
                <?php endif; ?>

            </td>            
        </tr>
    <?php endwhile; ?>
</table>