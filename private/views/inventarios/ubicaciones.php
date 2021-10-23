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
    <input type="text" style="display:none;" name='sector' id='sectorPopup' value="<?= $data['sector'] ?>">

    <div class="contenido">
        <div class="division5050">
            <div class="tabla">
                <div class="cabecera marcas">
                    <p>Nombre</p>
                    <p>Tipo</p>
                </div>
                <div class="items">
                    <div class="item marcas headerItem">
                        <p>Nombre</p>
                        <p>Nro Insumos</p>
                    </div>
                </div>
            </div>
            <div class="informacion">
                <h1>Nombre marca</h1>
                <hr>
                <div class="tabla">
                    <div class="cabecera insumosEnSubinventarios">
                        <p>Identificador</p>
                        <p>Nombre Insumo</p>
                        <p>Fallas</p>
                    </div>
                    <div class="items subInventario">
                        <div class="item" id='itemSubinventario'>
                            <div class="headerItem insumosEnSubinventarios">
                                <p>Identificador</p>
                                <p>Nombre Insumo</p>
                                <p>Fallas</p>
                            </div>
                            <div class="insumoSubinventarioCard">
                                <div class="tabla">
                                    <div class="cabecera fallaSubinventario">
                                        <p>Falla</p>
                                        <p>Fecha</p>
                                        <p>Estado</p>
                                    </div>
                                    <hr>
                                    <div class="items subSubInventario">
                                        <div class="item fallaSubinventario">
                                            <p>Falla</p>
                                            <p>Fecha</p>
                                            <p>Estado</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo URLROOT ?>/public/js/subInventarios/inventarioUbicaciones.js"></script>
<script>
    let ubicaciones_json = '<?= $data['ubicaciones_json'] ?>';
    let ubicacionesr = JSON.parse(ubicaciones_json);
    console.log(ubicacionesr);
    inicializar(ubicacionesr);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>