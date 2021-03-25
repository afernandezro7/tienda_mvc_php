<?php if(is_object($cat)):?>
    <h1><?=$cat->nombre?></h1>
    <?php if($cat_productos->num_rows>0):?>
        <?php while ($prod = $cat_productos->fetch_object()): ?>
            <?= Utils::renderProduct($prod)?>
        <?php endwhile; ?>
    <?php else:?>
        <p>No hay productos en esta Categoría</p>
    <?php endif;?>
<?php else:?>
    <h1>No existe esta Categoría </h1>    
<?php endif; ?>
