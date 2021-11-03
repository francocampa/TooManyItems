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
                <div class="unBoton">
                    <div class="cabecera marcas">
                        <p>Nombre</p>
                        <p>Nro Insumos</p>
                    </div>
                    <div class="existo"></div>
                </div>
                <div class="items">
                    <div class="item unBoton mar">
                        <div class="marcas headerItem">
                            <p>Nombre</p>
                            <p>Nro Insumos</p>
                        </div>
                        <button class="btnEliminar">X</button>
                    </div>
                </div>
            </div>
            <div class="informacion">
                <h1>Nombre marca</h1>
                <hr>
                <div class="tabla max">
                    <div class="cabecera insumosEnSubinventarios">
                        <p>Nombre</p>
                        <p>Modelo</p>
                        <p>Fallas</p>
                    </div>
                    <div class="items subInventario">
                        <div class="item" id='itemSubinventario'>
                            <div class="headerItem insumosEnSubinventarios">
                                <p>Nombre</p>
                                <p>Modelo</p>
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

<script src="<?php echo URLROOT ?>/public/js/subInventarios/inventarioMarcas.js"></script>
<script id="scriptFeo">
    let marcas_json = '<?= $data['marcas_json'] ?>';
    let marcasr = JSON.parse(marcas_json);
    let sectorr = '<?= $data['sector'] ?>';
    inicializar(marcasr, sectorr);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>