<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true,
    'popup' => true
];
require_once APPROOT . '\views\includes/head.php';
?>

<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '\views\includes/filters.php'; ?>
    <input type="text" style="display:none;" name='sector' id='sectorPopup' value="<?= $data['sector'] ?>">

    <div class="contenido">
        <div class="division5050">
            <div class="tabla">
                <div class="cabecera marcas">
                    <p>Nombre</p>
                    <p>Tipo</p>
                </div>
                <div class="items">
                    <a class="item marcas headerItem">
                        <p>Nombre</p>
                        <p>Nro Insumos</p>
                    </a>
                </div>
            </div>
            <div class="informacion">

            </div>
        </div>

    </div>
</div>

<script src="<?php echo URLROOT ?> /public/js/subinventarios/inventarioUbicaciones.js"></script>
<script>
    let ubicaciones_json = '<?= $data['ubicaciones_json'] ?>';
    console.log(ubicaciones_json);
    let ubicaciones = JSON.parse(ubicaciones_json);
    llenarTabla(ubicaciones);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>