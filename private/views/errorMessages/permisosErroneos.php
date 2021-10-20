<?php
$css = [
    'estructura' => true,
    'form' => true,
    'error' => true
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <div class="contenido">
        <div class="tarjetaError">
            <img src="<?= URLROOT ?>/public/img/iconos/404.svg" alt="">
            <h1>No tiene permisos</h1>
            <p>No tiene los permisos necesarios para acceder a esta pestaña de la aplicación.</p>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>