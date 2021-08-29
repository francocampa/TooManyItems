<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '\views\includes/filters.php'; ?>

    <div class="contenido">
        <div class="tabla">
            <div class="cabecera insumos">
                <p>Imagen</p>
                <p>Nombre</p>
                <p>Categoria</p>
                <p>Marca</p>
                <p>Modelo</p>
                <p>Stock</p>
            </div>
            <hr>
            <div class="items">
                <div class="item insumos">
                    <p>Imagen</p>
                    <p>Nombre</p>
                    <p>Categoria</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                    <p>Stock</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$insumos = $data['insumos_json'];
?>
<script src="<?php echo URLROOT ?> /public/js/inventarioInsumos.js"></script>
<script>
    var insumos_json = '<?= $insumos ?>';
    var insumos = JSON.parse(insumos_json);
    llenarTabla(insumos);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>