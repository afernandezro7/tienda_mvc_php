<?php if (is_object($prod)): ?>
    <h1><?= $prod->nombre ?></h1>
    <?= Utils::renderProduct($prod,true)?>
<?php else: ?>
    <h1>No existe este Producto</h1>    
<?php endif; ?>