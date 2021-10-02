<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '\views\includes/filters.php'; ?>

    <div class="contenido">
        <div class="tabla">
            <div class="cabecera clase">
                <p>Materia</p>
                <p>Grupo</p>
                <p>Docente</p>
                <p>Fecha</p>
            </div>
            <hr>
            <div class="items">
                <div class="item clase">
                    <p>Materia</p>
                    <p>Grupo</p>
                    <p>Docente</p>
                    <p>Fecha</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?> /public/js/clases.js"></script>
<script>
    clases_json = <?= $data['clases'] ?>;
    clases = JSON.parse(clases_json);
    llenarTabla(clases);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>