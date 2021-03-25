<h1>Carrito</h1>
<?php if (empty($carrito)): ?>
    <p>No hay productos en el carrito</p>
<?php else: ?> 

    <table>
        <tr>
            <th></th>            
            <th>Imagen</th>
            <th>Nombre</th>       
            <th>Precio</th>       
            <th>Unidades</th>            
        </tr>
        <?php
        foreach ($carrito as $indice => $elemento):
            $producto = $elemento['producto'];
            ?>
            <tr>
                <td>
                    <a href="<?=base_url."carrito/delete&index=$indice"?>" class="button-small alert_red"><i style="color: #ff8686;" class="fas fa-trash-alt"></i></a>
                </td>            
                <td>
                    <?php if (!empty($producto->imagen)): ?>
                        <img src='<?= base_url . "uploads/images/" . $producto->imagen; ?>' class="img_carrito" alt="$producto->nombre"/>           
                    <?php else: ?>
                        <img src='<?= base_url . "assets/img/no-image.png"; ?>' class="img_carrito" alt="$producto->nombre"/> 
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url . "producto/ver&id=$producto->id" ?>"><?= $producto->nombre; ?></a>

                </td>       
                <td><?= $elemento['precio']; ?></td>       
                <td class="updown">
                    <a href="<?=base_url."carrito/up&index=$indice"?>"><i class="fas fa-sort-up"></i></a>
                    <span><?= $elemento['unidades']; ?></span>
                    <a href="<?=base_url."carrito/down&index=$indice"?>"><i class="fas fa-sort-down"></i></a>
                </td>            
            </tr>
        <?php endforeach; ?>
    </table>
    <br/> 

    <?php if (isset($_SESSION['pedido_identity']) && $_SESSION['pedido_identity'] == false): ?>   
        <strong class="alert_red">Debe estar Autenticado para realizar un pedido</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('pedido_identity') ?>

    <div class="delete-carrito">
        <a href="<?= base_url ?>carrito/delete_all" class="button button-red">Vaciar carrito</a>
    </div>
    <div class="total-carrito">
        <?php $stats = Utils::carStats(); ?>
        <h3>Precio total: $<?= $stats['total'] ?></h3>
        <a href="<?= base_url . "pedido/hacer" ?>" class="button button-pedido">Hacer pedido</a>       
    </div>
<?php endif; ?> 
