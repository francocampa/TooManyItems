<?php
$css = [
    'estructura' => true,
    'estadisticas' => true,
    'popup' => true,
    'form' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '\views\includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>

    <div class="contenido">
        <div class="seccion tarjetas">
            <div>
                <h2>Informacion del sector</h2>
                <div class="containerTarjetas">
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/marcas">
                        <p>Marcas</p>
                        <p class="numero"><?= $data['infoSector']['marcas'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/proveedores">
                        <p>Proveedores</p>
                        <p class="numero"><?= $data['infoSector']['proveedores'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/ubicaciones">
                        <p>Ubicaciones</p>
                        <p class="numero"><?= $data['infoSector']['ubicaciones'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="">
                        <p>Grupos</p>
                        <p class="numero"><?= $data['infoSector']['grupos'] ?></p>
                    </a>
                </div>
            </div>
            <div>
                <h2>Inventarios de insumos</h2>
                <div class="containerTarjetas">
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/materiales">
                        <p>Materiales</p>
                        <p class="numero"><?= $data['infoInventarios']['materiales'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/herramientas">
                        <p>Herramientas</p>
                        <p class="numero"><?= $data['infoInventarios']['herramientas'] ?></p>
                    </a>

                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/maquinaria">
                        <p>Maquinarias</p>
                        <p class="numero"><?= $data['infoInventarios']['maquinarias'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/informatico">
                        <p>Equipamiento Informatico</p>
                        <p class="numero"><?= $data['infoInventarios']['informaticos'] ?></p>
                    </a>
                </div>
            </div>
            <div>
                <h2>Alertas</h2>
                <div class="containerTarjetas alertas">
                    <a class="tarjeta roja" href="">
                        <p>Insumos con stock insuficiente</p>
                        <p class="numero"><?= $data['infoInventarios']['insumosBajoStock'] ?></p>
                    </a>
                    <a class="tarjeta roja" href="">
                        <p>Insumos con fallas</p>
                        <p class="numero"><?= $data['infoInventarios']['instanciasFalladas'] ?></p>
                    </a>
                    <a class="tarjeta roja" href="">
                        <p>Insumos no devueltos</p>
                        <p class="numero">10</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="seccion graficas">
            <h2>Estadísticas</h2>
        </div>

        <button id="ubicacion">
            Agregar Ubicacion
        </button>
        <button id="marca">
            Agregar Marca
        </button>
        <button id="proveedor">
            Agregar Proveedor
        </button>
    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>