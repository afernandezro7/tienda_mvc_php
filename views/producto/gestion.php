<h1>Gestión de Productos</h1> 

<a href="<?=base_url?>producto/crear" class="button button-small">Crear Producto</a>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'Completed'): ?>   
    <strong class="alert_green">Registro completado Correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'Failed'): ?>      
    <strong class="alert_red">Registro fallido</strong>
<?php endif; ?>
    
<?php if (isset($_SESSION['accion']) && $_SESSION['accion'] == 'Completed'): ?>   
    <strong class="alert_green">Acción completada con éxito</strong>
<?php elseif (isset($_SESSION['accion']) && $_SESSION['accion'] == 'Failed'): ?>      
    <strong class="alert_red">Acción fallida, intente nuevamente</strong>
<?php endif; ?>
    
<?php Utils::deleteSession('producto')?>  
<?php Utils::deleteSession('accion')?>  
        
<table border="1">
    <tr>
        <th>ID</th>
        <th>Categorías</th>       
        <th>Precio</th>       
        <th>Stock</th>       
        <th>Acciones</th>       
    </tr>
<?php while ($prod = $productos->fetch_object()):?>
    <tr>
        <td><?=$prod->id;?></td>
        <td><?=$prod->nombre;?></td>       
        <td><?=$prod->precio;?></td>       
        <td><?=$prod->stock;?></td>       
        <td>
            <a href="<?=base_url?>producto/editar&id=<?=$prod->id;?>" class="button-small"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
            <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id;?>" class="button-small alert_red"><i class="fas fa-trash-alt"></i></a> 
        </td>       
    </tr>
<?php endwhile; ?>
</table>
        
