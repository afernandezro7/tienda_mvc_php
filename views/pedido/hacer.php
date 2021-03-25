<h1>Hacer pedido</h1>
<p>
    <a href="<?= base_url ?>carrito/index">Ver los productos y precios del pedido</a>
</p>
<br/>
<h3>Dirección de Envío</h3>

<form action="<?= base_url ?>pedido/add" method="POST">
    <label for="provincia">Provincia</label>
    <input type="text" name="provincia" value="La Habana" required>

    <label for="localidad">Localidad</label>
    <input type="text" name="localidad" value="La Habana Vieja" required>

    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" value="Calle Angeles 255A entre Rosa Serra y JL Dardel,Guanabacoa" required>


    <input type="submit" value="Confirmar pedido">
</form>
