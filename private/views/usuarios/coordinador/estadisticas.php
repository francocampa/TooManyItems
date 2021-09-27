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
        <div class="grid">
            <h2>Informacion del sector</h2>
            <div class="info">
                <div class="row">
                    <div class="a">
                        <p>Proveedores</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/proveedores" class="btn">Ver info</a>
                    </div>
                    <div class="a">
                        <p>Marcas</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/marcas" class="btn">Ver info</a>
                    </div>

                </div>
                <div class="row">
                    <div class="a">
                        <p>Ubicaciones</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/ubicaciones" class="btn">Ver info</a>
                    </div>
                    <div class="a">
                        <p>Grupos</p>
                        <a href="" class="btn">Ver info</a>
                    </div>
                </div>
                <div class="row">
                    <div class="b">
                        <p>Insumos con fallas</p>
                        <a href="" class="btng">Ver insumos</a>
                    </div>
                </div>
            </div>
            <h2>Informacion del sector</h2>
            <div class="info">
                <div class="row">
                    <div class="a">
                        <p>Materiales</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/materiales" class="btn">Ver info</a>
                    </div>
                    <div class="a">
                        <p>Herramientas</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/herramientas" class="btn">Ver info</a>
                    </div>

                </div>
                <div class="row">
                    <div class="a">
                        <p>Maquinarias</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/maquinaria" class="btn">Ver info</a>
                    </div>
                    <div class="a">
                        <p>Equipamiento Informatico</p>
                        <a href="<?php echo URLROOT; ?>/Inventario/informatico" class="btn">Ver info</a>
                    </div>
                </div>
                <div class="row">
                    <div class="b">
                        <p>Insumos con stock insuficiente</p>
                        <a href="" class="btng">Ver insumos</a>
                    </div>
                </div>
            </div>
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