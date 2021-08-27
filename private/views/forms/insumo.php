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
                <input type="text" name="nombre">
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
                <input type="text" name="modelo">
                <input type="text" name="stockMinimo">
            </div>
            <div class="col">
                <p>Características técnicas</p>
                <hr>
                <div class="caracteristicasT">

                </div>
                <button class="agregarCaracteristica">+</button>
            </div>
        </form>
    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>