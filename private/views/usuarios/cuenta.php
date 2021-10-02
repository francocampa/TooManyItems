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
    <!-- <?php //require_once APPROOT . '\views\includes/filters.php'; ?> -->

    <div class="contenido">
        <?php
            //var_dump($_SESSION);
        ?>
        <hr class="linea">
            <div class="subCont">
                <div class="grid">
                    <div class="datosCuenta">
                        <div class="subHeader"><h3>Datos de la cuenta</h2></div>
                        <hr>
                        <div class="contenidoDatosCuenta">
                            <div class="gridCont">
                                <div>
                                    <p>C.I</p>
                                    <input></input>
                                </div>
                                <div>
                                    <p>Email</p>
                                    <input type="email"></input>
                                </div>
                                <div>
                                    <p>Nombre</p>
                                    <input></input>
                                </div>
                                <div>
                                    <p>Apellido</p>
                                    <input></input>
                                </div>
                                <div>
                                    <p>Contraseña</p>
                                    <input type="password"></input>
                                </div>
                                <div>
                                    <p>Teléfono</p>
                                    <input></input>
                                </div>
                                <div>
                                    <button class="boton">Guardar</button>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <a href="<?php echo URLROOT ?>/Cuenta/logOut">Salir</a>
    </div>
</div>
<?php
require_once APPROOT . '\views\includes/footer.php';
?>