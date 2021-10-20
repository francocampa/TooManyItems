<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true,
    'popup' => true,
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <div class="contenido">
        <div class="tabla">
            <div class="cabecera insumosFallados">
                <p>Imagen</p>
                <p>Nombre</p>
                <p>Marca</p>
                <p>Modelo</p>
                <p>Identificador</p>
                <p>Falla</p>
                <p>Fecha Inicio</p>
            </div>
            <hr>
            <div class="items">
                <div class="item insumosFallados headerItem">
                    <img src="<?= URLROOT . "/public/img/insumosUploads/" ?>" class="imagenInsumoTabla">
                    <p>Nombre</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                    <p>Identificador</p>
                    <p>Falla</p>
                    <p>Fecha Inicio</p>
                    <button class="btnFalla" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?> /public/js/subInventarios/instanciasFalladas.js"></script>
<script>
    let instanciasr = <?= json_encode($data['instancias']) ?>;
    inicializar(instanciasr);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>