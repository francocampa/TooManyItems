<?php
$css = [
    'estructura' => true,
    'form' => true,
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php';
    ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>

    <div class="contenido">
        <form action="" method="POST">
            <div class="containerInputs">
                <div class="col" id="colInfoCompra">
                    <div class="tituloCheckbox">
                        <p>Información de compra</p>
                        <input type="checkbox" id="cboxInfoCompra" name="cboxInfoCompra" checked="true">
                    </div>
                    <hr>
                    <h3>Costo</h3>
                    <input type="text" name="costo" id="costo" class="errorInput">
                    <h3>Tipo</h3>
                    <select name="tipo" id="tipo">
                        <option value="ordenDeCompra">Orden de compra</option>
                        <option value="licitacion">Licitación</option>
                        <option value="donacion">Donación</option>
                        <option value="otra">Otra</option>
                    </select>
                    <h3>Proveedor</h3>
                    <select name="proveedor" id="proveedorInput">
                        <option value="-1">Sin proveedor</option>
                        <?php
                        foreach ($data['proveedores'] as $proveedor) {
                            echo '<option value="' . $proveedor['codProveedor'] . '">' . $proveedor['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <h3>Cantidad</h3>
                    <input type="number" name="cantidad" min="1" id="cantidad" value="1">
                    <h3>Fecha de compra</h3>
                    <input type="date" name="fechaCompra" id="fechaCompra" class="errorInput">
                </div>
                <div class="col" id="colGarantia">
                    <div class="tituloCheckbox">
                        <p>Garantía</p>
                        <input type="checkbox" id="cboxGarantia" name="cboxGarantia" checked="true">
                    </div>
                    <hr>
                    <h3>Tipo</h3>
                    <input type="text" name="tipoGarantia" id="tipoGarantia" class="errorInput">
                    <h3>Fecha de inicio</h3>
                    <input type="date" name="fechaInicioGarantia" id="fechaInicioGarantia" class="errorInput">
                    <h3>Fecha límite</h3>
                    <input type="date" name="fechaLimiteGarantia" id="fechaLimiteGarantia" class="errorInput">
                </div>
                <div class="col overflow" id="colInstancias">
                    <div class="tituloCheckbox">
                        <p>Instancias individuales</p>
                        <input type="checkbox" id="cboxInstancias" name="cboxInstancias" checked="true">
                    </div>
                    <hr>
                    <div class="indicacionesTresSubtitulos">
                        <h3>Identificador</h3>
                        <h3>Estado</h3>
                        <h3>Ubicacion</h3>
                    </div>
                    <hr>
                    <div class="instancia" id="containerInstancias">
                        <input type="text" name="identificador0" id="identificador0" class="errorInput">
                        <select name="estado0" id="estado0">
                            <option value="stock">Stock</option>
                            <option value="mantenimiento">Mantenimiento</option>
                        </select>
                        <select name="ubicacion0" id="ubicacion0">
                            <?php
                            foreach ($data['ubicaciones'] as $ubicacion) {
                                echo '<option value="' . $ubicacion['codUbicacion'] . '">' . $ubicacion['nombre'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btnConfirmar" id="btnSubmit" disabled>
        </form>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/formularioInstancia.js"></script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>