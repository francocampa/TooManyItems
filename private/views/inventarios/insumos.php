<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true
];
require_once APPROOT . '\views\includes/head.php';
$_SESSION['insumos'] = $data['insumos_json'];
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
                <p>Tipo</p>
                <p>Marca</p>
                <p>Modelo</p>
                <p>Stock</p>
            </div>
            <hr>
            <div class="items">
                <a class="item insumos headerItem" href="<?php echo URLROOT ?>">
                    <p>Imagen</p>
                    <p>Nombre</p>
                    <p>Tipo</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                    <p>Stock</p>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?> /public/js/inventarioInsumos.js"></script>
<script>
    let insumos_json = '<?= $data['insumos_json'] ?>';
    console.log(insumos_json);
    let insumos = JSON.parse(insumos_json);
    llenarTabla(insumos);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>