<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <title>Tienda de Camisetas</title>
    </head>
    <body>
        <div id="container">
            <!--HEADER-->
            <header id="header">
                <div id="logo">
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo"/>
                    <a href="index.php">Tienda de Camisetas</a>
                </div>
            </header>

            <!--MENU-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">Inicio</a>
                    </li>
                    <?php $categorias= Utils::showCategories();
                        while ($cat = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url. "categoria/ver&id=". $cat->id ?>"><?= $cat->nombre; ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>

            </nav>

            <div id="content">
