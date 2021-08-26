<?php
$css = [
    'estructura' => true,
    'form' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <!-- <?php require_once APPROOT . '\views\includes/filters.php'; ?> -->

    <div class="contenido">

    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>