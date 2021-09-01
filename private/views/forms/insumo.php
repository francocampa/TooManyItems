<?php
$css = [
    'estructura' => true,
    'form' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <!-- <?php require_once APPROOT . '\views\includes/filters.php'; ?> -->

    <div class="contenido">
        <form action="" method="POST">
            <div class="containerInputs">
                <div class="col">
                    <p>Tipo e imagen</p>
                    <hr>
                    <h3>Imagen</h3>
                    <input type="image">
                    <h3>Categoría</h3>
                    <select name="categoria" id="categoria">
                        <option value="material">Material</option>
                        <option value="herramienta">Herramienta</option>
                        <option value="maquinaria">Maquinaria</option>
                        <option value="informatico">Informatico</option>
                    </select>
                </div>
                <div class="col">
                    <p>Características generales</p>
                    <hr>
                    <h3>Nombre</h3>
                    <input type="text" name="nombre">
                    <h3>Tipo</h3>
                    <select name="tipo" id="tipo">
                    </select>
                    <h3>Marca</h3>
                    <select name="marca">
                        <option value="-1">Sin marca</option>
                        <?php
                        foreach ($data['marcas'] as $marca) {
                            echo '<option value="' . $marca['nombre'] . '">' . $marca['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <h3>Modelo</h3>
                    <input type="text" name="modelo">
                    <h3>Stock Mínimo</h3>
                    <input type="text" name="stockMinimo">
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
                        <input type="text" name="caracteristicaNombre0">
                        <input type="text" name="caracteristicaValor0">
                    </div>
                    <button id="agregarCaracteristica" type="button">+</button>
                </div>
            </div>
            <input type="submit" name="submit">
        </form>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/formularioInsumo.js"></script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>