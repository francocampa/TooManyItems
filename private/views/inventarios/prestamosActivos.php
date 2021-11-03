<?php
$css = [
    'estructura' => true,
    'tablas' => true,
    'filtros' => true,
    'popup' => true
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <?php require_once APPROOT . '/views/includes/filters.php'; ?>

    <div class="contenido">
        <div class="tabla">
            <div class="cabecera prestamo">
                <p>Alumno</p>
                <p>Curso</p>
                <p>Fecha</p>
                <p>Hora</p>
                <p>Cantidad</p>
                <p>Estado</p>
            </div>
            <hr>
            <div class="items">
                <div class="item">
                    <div class="headerItem prestamo">
                        <p>Alumno</p>
                        <p>Curso</p>
                        <p>Fecha</p>
                        <p>Hora</p>
                        <p>Cantidad</p>
                        <button class="btnBorder" id="devolverPrestamo">Devuelto</button>
                    </div>
                    <div class="prestamoCard close">
                        <div class="seccionPrestamo">
                            <h3>Razón del préstamo</h3>
                            <hr>
                            <textarea name="razonPrestamo" id="" cols="30" rows="10" class="razonPrestamo">

                            </textarea>
                        </div>
                        <div class="seccionPrestamo">
                            <h3>Insumos prestados</h3>
                            <hr>
                            <div class="insumosPrestados">
                                <div class="tabla">
                                    <div class="item insumoPrestamo">
                                        <p>Nombre</p>
                                        <p>Marca</p>
                                        <p>Modelo</p>
                                        <p>Identificador</p>
                                        <p>Cantidad</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT ?>/public/js/paniol.js"></script>
    <script>
        prestamosn = <?= json_encode($data['prestamos']) ?>;
       // let tipon = "<?= $data['titulo'] ?>";
        cargarInfo(prestamosn);
    </script>
</div>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>