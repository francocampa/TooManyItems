<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'insumo' => true,
    'filtros' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/insumoSideBar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '\views\includes/filters.php'; ?>

    <div class="contenido">
        <div class="tabla">
            <div class="cabecera instancias">
                <p>Identificador</p>
                <p>Estado</p>
                <p>Ubicación</p>
                <p>Fecha de compra</p>
                <p>Proveedor</p>
            </div>
            <hr>
            <div class="items">
                <form class="item">
                    <div class="headerItem instancias">
                        <p>Imagen</p>
                        <p>Nombre</p>
                        <p>Categoria</p>
                        <p>Marca</p>
                        <p>Modelo</p>
                    </div>
                    <div class="instanciaCard close">
                        <div class="infoInstancia tripleCol">
                            <div class="input base">
                                <h4>Identificador</h4>
                                <input type="text" name="identificador" id="identificador">
                            </div>
                            <div class="input base">
                                <h4>Estado</h4>
                                <select name="estado" id="estado">
                                    <?php
                                    foreach ($data['estados'] as $estado) {
                                        echo '<option value="' . $estado['estado'] . '">' . $estado['estado'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input base">
                                <h4>Ubicacion</h4>
                                <select name="ubicacion" id="ubicacion">
                                    <?php
                                    foreach ($data['ubicaciones'] as $ubicacion) {
                                        echo '<option value="' . $ubicacion['nombre'] . '">' . $ubicacion['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="infoCompra ">
                            <h3>Información de compra</h3>
                            <div class="containerInputs">
                                <div class="input base">
                                    <h4>Proveedor</h4>
                                    <select name="proveedor" id="proveedor">
                                        <?php
                                        foreach ($data['proveedores'] as $proveedor) {
                                            echo '<option value="' . $proveedor['codProveedor'] . '">' . $proveedor['nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input base">
                                    <h4>Tipo</h4>
                                    <select name="tipoCompra" id="tipoCompra">
                                        <option value="ordenDeCompra">Orden de compra</option>
                                        <option value="licitacion">Licitación</option>
                                        <option value="donacion">Donación</option>
                                        <option value="otra">Otra</option>
                                    </select>
                                </div>
                                <div class="input base">
                                    <h4>Cantidad</h4>
                                    <input type="number" name="cantidad" id="cantidad">
                                </div>
                                <div class="input base">
                                    <h4>Costo</h4>
                                    <input type="text" name="costo" id="costo">
                                </div>
                                <div class="input base">
                                    <h4>Fecha de compra</h4>
                                    <input type="date" name="fechaCompra" id="fechaCompra">
                                </div>
                            </div>
                        </div>
                        <div class="infoGarantia">
                            <h3>Garantia</h3>
                            <div class="containerInputs">
                                <div class="input base">
                                    <h4>Tipo</h4>
                                    <input type="text" name="tipoGarantia" id="tipoGarantia">
                                </div>
                                <div class="input base">
                                    <h4>Fecha de inicio</h4>
                                    <input type="date" name="fechaInicio" id="fechaInicio">
                                </div>
                                <div class="input base">
                                    <h4>Fecha límite</h4>
                                    <input type="date" name="fechaLimite" id="fechaLimite">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?> /public/js/inventarioInstancias.js"></script>
<script>
    let compras_json = '<?= $data['compras_json'] ?>';
    let compras = JSON.parse(compras_json);
    let insumo_json = '<?= $data['insumo'] ?>';
    let insumo = JSON.parse(insumo_json);
    llenarInfoInsumo(insumo);
    llenarTabla(compras);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>