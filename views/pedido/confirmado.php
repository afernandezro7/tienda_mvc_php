<?php if ($_SESSION['pedido'] == 'Completed'): ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con éxito, una vez que realices la transferencia
        bancaria a la cuenta 43769093309945444 con el coste del pedido, será procesado y enviado.
    </p>
    <br/>
    <?php if (isset($ped)) : ?>
        <h3>Datos del Pedido</h3>

        Numero de Pedido:<?= $ped->id ?> <br/>
        Total a pagar: $<?= $ped->coste ?> <br/>
        Productos:        
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>       
                <th>Precio</th>       
                <th>Unidades</th>            
            </tr>
            <?php while ($producto = $ped_products->fetch_object()): ?>
                <tr>
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
                    <td><?= $producto->precio; ?></td>       
                    <td><?= $producto->unidades ?></td>            
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

<?php elseif ($_SESSION['pedido'] == 'Failed'): ?>
    <h1>Tu pedido NO ha podido confirmarse</h1>
<?php endif; ?>
