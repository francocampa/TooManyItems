<?php
$css = [
    'estructura' => true,
    'form' => true,
    'error' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <div class="contenido">
        <div class="tarjetaError">
            <img src="<?= URLROOT ?>/public/img/iconos/404.svg" alt="">
            <h1>La pestaña a la que quiere acceder no existe</h1>
            <p>La dirección a la que quiere acceder no coincide con ninguna de las pestañas en la aplicación.</p>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>