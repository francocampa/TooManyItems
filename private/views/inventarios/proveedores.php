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
        <div class="division5050">
            <div class="tabla">
                <div class="cabecera marcas">
                    <p>Nombre</p>
                    <p>Teléfono</p>
                </div>
                <div class="items">
                    <a class="item marcas headerItem">
                        <p>Nombre</p>
                        <p>Nro Insumos</p>
                    </a>
                </div>
            </div>
            <div class="informacion">

            </div>
        </div>

    </div>
</div>

<script src="<?php echo URLROOT ?> /public/js/subinventarios/inventarioProveedores.js"></script>
<script>
    let proveedores_json = '<?= $data['proveedores_json'] ?>';
    console.log(proveedores_json);
    let proveedores = JSON.parse(proveedores_json);
    llenarTabla(proveedores);
</script>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>