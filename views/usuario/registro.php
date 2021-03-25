<h1>Registrarse</h1>

<?php  if(isset($_SESSION['register']) && $_SESSION['register']=='Completed'):?>   
    <strong class="alert_green">Registro completado Correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=='Failed'):?>      
    <strong class="alert_red">Registro fallido</strong>
<?php endif;?>
    
<?php Utils::deleteSession('register')?>  
    
<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <?=isset($_SESSION['errors']) ? Utils::showError($_SESSION['errors'],'nombre') : '';?>
    <input type="text" name="nombre" required>
    
    <label for="apellidos">Apellidos</label>
    <?=isset($_SESSION['errors']) ? Utils::showError($_SESSION['errors'],'apellidos') : '';?>
    <input type="text" name="apellidos" required>
    
    <label for="email">Email</label>
    <?=isset($_SESSION['errors']) ? Utils::showError($_SESSION['errors'],'email') : '';?>
    <input type="email" name="email" required>
    
    <label for="password">Contraseña</label>
    <?=isset($_SESSION['errors']) ? Utils::showError($_SESSION['errors'],'password') : '';?>
    <input type="password" name="password" required>
    
    <input type="submit" value="Enviar">
</form>
<?php Utils::deleteSession('register')?>  
<?php Utils::deleteSession('errors')?>  
