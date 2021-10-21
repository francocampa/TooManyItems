<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true,
    'popup' => true
];
require_once APPROOT . '/views/includes/head.php';
$_SESSION['insumos'] = $data['insumos_json'];
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '/views/includes/filters.php'; ?>

    <div class="contenido">
        <div class="tabla">
            <div class="unBoton">
                <div class="cabecera insumos">
                    <p>Imagen</p>
                    <p>Nombre</p>
                    <p>Tipo</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                    <p>Sector</p>
                    <p>Stock</p>
                </div>
                <div class="existo"></div>
            </div>
            <hr>
            <div class="items">
                <div class="item unBoton">
                    <a class="insumos headerItem" href="<?php echo URLROOT ?>">
                        <img src="<?= URLROOT . "/public/img/insumosUploads/" ?>" class="imagenInsumoTabla">
                        <p>Nombre</p>
                        <p>Tipo</p>
                        <p>Marca</p>
                        <p>Modelo</p>
                        <p>Sector</p>
                        <p>Stock</p>
                    </a>
                    <button class="btnEliminar">X</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/inventarioInsumos.js"></script>
<script>
    let insumos_json = '<?= $data['insumos_json'] ?>';
    let insumosN = JSON.parse(insumos_json);
    let sectores_json = '<?= json_encode($_SESSION['sectores']) ?>';
    let sectores = JSON.parse(sectores_json);
    inicializar(insumosN, sectores);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>