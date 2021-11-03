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
                <h2>Acciones recientes</h2>
                <hr>
                <div class="tabla tablaAuditorias">
                    <div class="cabecera auditorias">
                        <p>Cédula</p>
                        <p>Fecha</p>
                        <p>Accion</p>
                    </div>
                    <hr>
                    <div class="items">
                        <div class="item headerItem auditorias">
                            <p>Cédula</p>
                            <p>Fecha</p>
                            <p>Accion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo URLROOT ?>/public/js/subInventarios/empleados.js"></script>
<script>
    empleados = <?= json_encode($data['empleados']) ?>;
    sectoresn = <?= json_encode($_SESSION['sectores']) ?>;
    cargarInfo(empleados, sectoresn);
</script>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>