<?php
$css = [
    'estructura' => true,
    'form' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php';
    ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>

    <div class="contenido">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="containerInputs">
                <div class="col">
                    <p>Tipo e imagen</p>
                    <hr>
                    <h3>Imagen</h3>
                    <input type="file" id="inputImagen" name="imagenInsumo" style="display:none;">
                    <img class="inputImagen" id="frontInputImagen" src="<?= URLROOT ?>/public/img/iconos/AddImage.svg">
                    <!-- <img width="15rem" height="15rem" id="imagenRandom"> -->
                    <h3>Categoría</h3>
                    <select name="categoria" id="categoria">
                        <option value="material">Material</option>
                        <option value="herramienta">Herramienta</option>
                        <option value="maquinaria">Maquinaria</option>
                        <option value="informatico">Informatico</option>
                    </select>
                    <h3>Sector</h3>
                    <select name="sector" id="sectorInsumo">
                        <?php
                        foreach ($_SESSION['sectores'] as $sector) {
                            echo '<option value="' . $sector . '">' . $sector . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <p>Características generales</p>
                    <hr>
                    <h3>Nombre</h3>
                    <input type="text" name="nombre" id="nombreInsumo" class="errorInput">
                    <h3>Tipo</h3>
                    <select name="tipo" id="tipo">
                    </select>
                    <h3>Marca</h3>
                    <select name="marca" id='marcas'>
                        <option value="-1">Sin marca</option>
                        <?php
                        foreach ($data['marcas'][$_SESSION['sectores'][0]] as $marca) {
                            echo '<option value="' . $marca['codMarca'] . '">' . $marca['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <h3>Modelo</h3>
                    <input type="text" name="modelo" id="modeloInsumo">
                    <h3>Stock Mínimo</h3>
                    <input type="text" name="stockMinimo" id="stockMinimo" class="errorInput">
                </div>
                <div class="col overflow">
                    <p>Características técnicas</p>
                    <hr>
                    <div class="indicacionesDosSubtitulos">
                        <h3>Nombre</h3>
                        <h3>Valor</h3>
                    </div>
                    <hr>
                    <div class="caracteristicasT">
                        <!-- <input type="text" name="caracteristicaNombre0">
                        <input type="text" name="caracteristicaValor0"> -->
                    </div>
                    <button id="agregarCaracteristica" class="btnCaracteristicaT" type="button">+</button>
                    <button id="quitarCaracteristica" class="btnCaracteristicaT" type="button">-</button>
                </div>
            </div>
            <input type="submit" name="submit" class="btnConfirmar" id="btnSubmit" disabled>
        </form>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/formularioInsumo.js"></script>
<script>
    let marcasN = <?= json_encode($data['marcas']) ?>;
    cargarMarcas(marcasN);
    let categoria = "<?= $data['categoria'] ?>";
    categoria = categoria == 'herramientas' ? 'herramienta' : categoria;
    categoria = categoria == 'materiales' ? 'material' : categoria;


    $('#categoria').val(categoria);
    actualizarTipo();
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>