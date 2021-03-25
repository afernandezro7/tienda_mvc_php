<!--SIDEBAR-->
<aside id="lateral">
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <?php $stats = Utils::carStats();?>
        <ul>
            <li><a href="<?=base_url?>carrito/index">Productos en carrito:</a> (<?=$stats['count']?>)</li>
            <li><a href="<?=base_url?>carrito/index">Total a pagar:</a> $<?=$stats['total']?></li>
            <li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
            
        </ul>
    </div>
    <div id="login" class="block_aside">
        <?php  if(!isset($_SESSION['identity'])):?>             
        <h3>Entrar a la Web</h3>
        <form action="<?=base_url?>usuario/login" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <input type="submit" value="Enviar">
        </form>
        <?php else:?>  
        <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
        <?php endif;?>  
        <ul>
            <?php  if(isset($_SESSION['admin'])):?> 
                <li><a href="<?=base_url?>categoria/index">Gestionar Categorías</a></li>
                <li><a href="<?=base_url?>producto/gestion">Gestionar Productos</a></li>
                <li><a href="<?=base_url?>pedido/gestion">Gestionar Pedidos</a></li>
            <?php endif;?> 
            <?php  if(isset($_SESSION['identity'])):?>  
                <li><a href="<?=base_url?>pedido/mis_pedidos">Mis Pedidos</a></li>
                <li><a href="<?=base_url?>usuario/logout">Cerrar Sessión</a></li>           
            <?php else:?> 
                <li><a href="<?=base_url?>usuario/register">Crear Cuenta</a></li>
            <?php endif;?> 
        </ul>
    </div>
</aside>
<!--CONTENT-->
<div id="central">