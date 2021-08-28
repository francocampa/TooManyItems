<?php
$css = [
    'estructura' => true,
    'tablas' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <!-- <?php require_once APPROOT . '\views\includes/filters.php'; ?> -->

    <div class="contenido">
        <?php
            var_dump($_SESSION);
        ?>
        <a href="<?php echo URLROOT ?>/Cuenta/logOut">Salir</a>
    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>