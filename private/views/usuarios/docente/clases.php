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
            <div class="cabecera clases">
                <p>Materia</p>
                <p>Grupo</p>
                <p>Cantidad</p>
                <p>Fecha</p>
                <p>Hora</p>
            </div>
            <hr>
            <div class="items">
                <div class="item">
                    <div class="headerItem clases">
                        <p>Materia</p>
                        <p>Grupo</p>
                        <p>Cantidad</p>
                        <p>Fecha</p>
                        <p>Hora</p>
                    </div>
                    <div class="prestamoCard close">
                        <div class="seccionPrestamo">
                            <h3>Objetivo de la clase</h3>
                            <hr>
                            <textarea name="razonPrestamo" id="" cols="30" rows="10" class="razonPrestamo">

                            </textarea>
                        </div>
                        <div class="seccionPrestamo">
                            <h3>Insumos utilizados</h3>
                            <hr>
                            <div class="insumosPrestados">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="formClase">
            <div class="infoGeneral">
                <h3>Información general</h3>
                <h2>Grupo</h2>
                <input type="text" id="grupo" name="grupo">
                <h2>Fecha</h2>
                <input type="date" id="fechaClase" name="fechaClase">
                <h2>Hora</h2>
                <input type="time" id="horaClase" name="horaClase">
                <h2>Razon</h2>
                <textarea name="razonClase" id="razonClase" cols="30" rows="10"></textarea>
            </div>
            <div class="insumosSeleccionados">
                <h3>Insumos seleccionados</h3>
                <hr>
                <div class="tablaInsumosSeleccionados">
                    <div class="cabecera insumoForm">
                        <p>Nombre</p>
                        <p>Marca</p>
                        <p>Modelo</p>
                        <p>Identificador</p>
                        <p>Cantidad</p>
                    </div>
                    <div class="listaInsumosSeleccionados">
                        <div class="insumoSeleccionado insumoForm">
                            <p>Nombre</p>
                            <p>Marca</p>
                            <p>Modelo</p>
                            <p>Identificador</p>
                            <p>Cantidad</p>
                            <button type="button" class="btnEliminarMini">x</button>
                            <input type="text" style="display: none;" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="selectorDeInsumos">
                <h3>Agregar insumo</h3>
                <hr>
                <h2>Categoría</h2>
                <select name="categoria" id="categoria">
                    <option value="material">Material</option>
                    <option value="herramienta">Herramienta</option>
                    <option value="maquinaria">Maquinaria</option>
                    <option value="informatico">Informatico</option>
                </select>
                <h2>Nombre de insumo</h2>
                <input type="search" id="nombreInstancia" list="listaNombreInsumo" autocomplete="off">
                <datalist id="listaNombreInsumo">

                </datalist>
                <div class="optionInstanciaCantidad">
                    <div>
                        <h2>Identificador</h2>
                        <input type="radio" name="optionInstanciaCantidad" value="instancia" class="radioInstanciaCantidad">
                        <!-- <label for="instancia">Seleccionar instancia</label> -->
                        <input type="search" list="listaIdentificadores" autocomplete="off" id="identificadorInstancia" name="identificadorInstancia" disabled="true">
                        <datalist id="listaIdentificadores">

                        </datalist>
                    </div>
                    <div>
                        <h2>Cantidad</h2>
                        <input type="radio" name="optionInstanciaCantidad" value="cantidad" class="radioInstanciaCantidad">
                        <!-- <label for="cantidad">Seleccionar cantidad</label> -->
                        <input type="number" id="cantidad" name="cantidad" autocomplete="off" min="1" disabled="true" value="0">
                        <input type="checkbox" id="consumir">
                        <label for="consumir">Consumir</label>
                    </div>
                </div>
                <button class="btnOrange" id="addInsumo" type="button">Agregar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/clases.js"></script>
<script>
    //clases_json = <?php //$data['clases'] 
                    ?>;
    //clases = JSON.parse(clases_json);
    //llenarTabla(clases);
    let insumosn = <?= json_encode($data['insumos']) ?>;
    let gruposn = '';
    cargarInfo(insumosn, gruposn);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>