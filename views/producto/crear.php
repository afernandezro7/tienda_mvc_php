<?php if(isset($edit) && $edit):?>
    <h1>Editar Producto <?=$producto->nombre?></h1>
    <?php  $url_action= base_url."producto/save&id=".$product_id;?>
<?php else: ?>
    <h1>Crear Producto</h1>
    <?php  $url_action= base_url."producto/save";
           $edit=false;
    ?>
<?php endif; ?>
<div class="form_container">  
        
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="<?= $edit ? $producto->nombre : ""?>">

        <label for="descripcion">Descripción del producto</label>
        <textarea name="descripcion" rows="5" cols="10"><?=$edit ? $producto->descripcion : ""?></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" required value="<?=$edit ? $producto->precio : ""?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" required value="<?= $edit ? $producto->stock : ""?>">

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php $categorias = Utils::showCategories();
            while ($cat = $categorias->fetch_object()): ?>
                <option value=<?= $cat->id; ?> <?=($edit && $cat->id==$producto->categoria_id) ? 'selected' : ""?> ><?= $cat->nombre; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">Imagen</label>
        <?php if($edit && !empty($producto->imagen)):?>
            <img src="<?=base_url."uploads/images/".$producto->imagen?>" alt="<?=$producto->imagen?>" class="thumb"/>
        <?php endif; ?>
        <input type="file" name="imagen" >

        <input type="submit" value="Guardar">
    </form>
</div>


