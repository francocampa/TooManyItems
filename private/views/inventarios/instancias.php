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
                <a class="item instancias">
                    <p>Imagen</p>
                    <p>Nombre</p>
                    <p>Categoria</p>
                    <p>Marca</p>
                    <p>Modelo</p>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?> /public/js/inventarioInstancias.js"></script>
<script>
    let instancias_json = "<?= $data['instancias_json'] ?>";
    let instancias = JSON.parse(instancias_json);
    let insumo_json = '<?= $data['insumo'] ?>';
    let insumo = JSON.parse(insumo_json);
    llenarInfoInsumo(insumo);
    llenarTabla(instancias);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>