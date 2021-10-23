<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true,
    'popup' => true
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '/views/includes/filters.php'; ?>
    <div class="contenido">
        <div class="tabla">
            <div class="unBoton">
                <div class="cabecera stockBajo">
                    <p>Imagen</p>
                    <p>Nombre</p>
                    <p>Categoria</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                    <p>Stock</p>
                </div>
            </div>
            <hr>
            <div class="items">
                <div class="item stockBajo headerItem">
                    <img src="<?= URLROOT . "/public/img/insumosUploads/" ?>" class="imagenInsumoTabla">
                    <p>Nombre</p>
                    <p>Tipo</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                    <p>Stock</p>
                    <a class="btnOrange" href="<?= URLROOT ?>/Formulario/compra/">+ Agregar Compra</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/subInventarios/stockInsuficiente.js"></script>
<script>
    let insumosr = <?= json_encode($data['insumos']) ?>;
    inicializar(insumosr);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>