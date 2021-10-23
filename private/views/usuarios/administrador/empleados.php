<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '/views/includes/filters.php'; ?>

    <div class="contenido">
        <div class="division5050">
            <div class="tabla">
                <div class="unBoton">
                    <div class="cabecera empleados">
                        <p>Cédula</p>
                        <p>Nombre Completo</p>
                        <p>Cargo</p>
                    </div>
                    <div class="existo"></div>
                </div>
                <hr>
                <div class="items">
                    <a class="item unBoton">
                        <div class="headerItem empleados">
                            <p>12345678</p>
                            <p>Nombre Completo</p>
                            <p>Cargo</p>
                        </div>
                        <button class="btnEliminar">X</button>
                    </a>
                </div>
            </div>
            <div class="informacion">

            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/subInventarios/empleados.js"></script>
<script>
    empleados=<?= json_encode($data['empleados'])?>;
    cargarInfo(empleados);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>