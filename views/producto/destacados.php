<h1>Productos destacados</h1>

<?php while ($prod = $prod_rand->fetch_object()): ?>
    <?= Utils::renderProduct($prod)?>
<?php endwhile; ?>
