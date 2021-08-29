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
            <div class="col">
                <p>Tipo e imagen</p>
                <hr>
                <input type="image">
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
                <input type="text" name="nombre" placeholder="nombre">
                <select name="tipo" id="tipo">
                </select>
                <select name="marca">
                    <option value="-1">Sin marca</option>
                    <?php
                        foreach ($data['marcas'] as $marca) {
                            echo '<option value="'.$marca['nombre'].'">'.$marca['nombre'].'</option>';
                        }
                    ?>
                </select>
                <input type="text" name="modelo" placeholder="modelo">
                <input type="text" name="stockMinimo" placeholder="stock minimo">
            </div>
            <div class="col overflow">
                <p>Características técnicas</p>
                <hr>
                <div class="caracteristicasT">
                    <input type="text" name="caracteristicaNombre0" placeholder="nombre">
                    <input type="text" name="caracteristicaValor0" placeholder="valor">
                </div>
                <button id="agregarCaracteristica" type="button">+</button>
            </div>
            <input type="submit" name="submit">
        </form>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/formularioInsumo.js"></script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>