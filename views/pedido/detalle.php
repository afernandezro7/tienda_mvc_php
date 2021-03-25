<h1>Detalles del pedido</h1>
<?php if (isset($gestion) && $gestion == true): ?>                      
    <a href="<?= base_url ?>pedido/gestion" class="button-large" style="font-size: 2rem;"><i class="fas fa-arrow-left"></i></a>
<?php else: ?>                      
    <a href="<?= base_url ?>pedido/mis_pedidos" class="button-large" style="font-size: 2rem;"><i class="fas fa-arrow-left"></i></a>
<?php endif; ?>
<br/>
<br/>

<?php if (isset($ped)) : ?>
    <?php if (isset($gestion) && $gestion == true && isset($_SESSION['admin'])): ?> 
        <h3>Cambiar Estado del pedido</h3>
        
        <?php if (isset($_SESSION['cambio_estado']) && $_SESSION['cambio_estado'] == 'Completed'): ?>   
            <strong class="alert_green">Acción completada con éxito</strong>
        <?php elseif (isset($_SESSION['cambio_estado']) && $_SESSION['cambio_estado'] == 'Failed'): ?>      
            <strong class="alert_red">Acción fallida, intente nuevamente</strong>
        <?php elseif (isset($_SESSION['cambio_estado']) && $_SESSION['cambio_estado'] == 'Invalid'): ?>      
            <strong class="alert_red">Una vez enviado el pedido no se puede cambiar el estado</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('cambio_estado') ?>  
            
        <div class="form_container">
            <form action="<?= base_url ?>pedido/estado" method="POST">
                <input type="hidden" name="pedido_id" value="<?= $ped->id ?>">
                <select name='estado'>
                    <option value="confirm" <?=($ped->estado == "confirm") ? 'selected': ''?> ><?= Utils::showState('confirm') ?></option>
                    <option value="preparation" <?=($ped->estado == "preparation") ? 'selected': ''?>><?= Utils::showState('preparation') ?></option>
                    <option value="ready" <?=($ped->estado == "ready") ? 'selected': ''?> ><?= Utils::showState('ready') ?></option>
                    <option value="sent" <?=($ped->estado == "sent") ? 'selected': ''?> ><?= Utils::showState('sent') ?></option>
                    <option value="canceled" <?=($ped->estado == "canceled") ? 'selected': ''?> ><?= Utils::showState('canceled') ?></option>
                </select>
                <input type="submit" value="Cambiar estado">
            </form>
        </div>
    <?php endif; ?>    

    <br/>
    <strong>Datos del Pedido</strong><br/>
    N° Pedido: <?= $ped->id ?> <br/>
    Total a pagar: $<?= $ped->coste ?> <br/>
    Estado del pedido: <?= Utils::showState($ped->estado) ?> <br/>
    <br/>
    <strong>Información cliente</strong><br/>
    Cliente: <?= $cliente->nombre ?> <?= $cliente->apellidos ?><br/>
    Email: <?= $cliente->email ?><br/>
    <br/>
    <strong>Dirección de envío</strong><br/>
    Provincia: <?= $ped->provincia ?> <br/>
    Localidad: <?= $ped->localidad ?> <br/>
    Dirección: <?= $ped->direccion ?> <br/>
    <br/>

    <br/>
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