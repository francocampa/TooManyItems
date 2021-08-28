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
        <form action="">
            <div class="col">
                <p>Tipo e imagen</p>
                <hr>
                <input type="image">
                <select>
                    <option value="">Material</option>
                    <option value="">Herramienta</option>
                    <option value="">Maquinaria</option>
                    <option value="">Informatico</option>
                </select>
            </div>
            <div class="col">
                <p>Características generales</p>
                <hr>
                <input type="text" name="nombre" placeholder="nombre">
                <select>
                    <option value="">Material</option>
                    <option value="">Herramienta</option>
                    <option value="">Maquinaria</option>
                    <option value="">Informatico</option>
                </select>
                <select>
                    <option value="">Material</option>
                    <option value="">Herramienta</option>
                    <option value="">Maquinaria</option>
                    <option value="">Informatico</option>
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
        </form>
    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>