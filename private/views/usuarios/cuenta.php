<?php
$css = [
    'estructura' => true,
    'form' => true,
    'cuenta' => true,
    'popup' => true,
    'tablas' => true
];
require_once APPROOT . '/views/includes/head.php';
// var_dump($_POST);
// var_dump($data);
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <!-- <?php //require_once APPROOT . '/views/includes/filters.php'; 
            ?> -->

    <div class="contenido miCuenta">
        <div class="updateCuentaForm">
            <form method="POST" action="<?= URLROOT ?>/Modificacion/cuenta">
                <h2>Información personal</h2>
                <hr>
                <h2>Nombre</h2>
                <input type="text" id="nombre" name="nombre" class="d">
                <h2>Apellido</h2>
                <input type="text" id="apellido" name="apellido" class="d">
                <h2>Telefono</h2>
                <input type="text" id="telefono" name="telefono" class="d">
                <h2>Email</h2>
                <input type="text" id="email" name="email" class="d">
                <br>
                <button class="btnConfirmar">Confirmar</button>
            </form>    
            <br>
            <h2>Contraseña</h2>
            <hr>
            <form class="inputOldPass" action="" method="post">
                <p><?php
                if(!$data['currentPass']){
                    echo 'Ingrese su contraseña';
                }
                ?></p>
                <input name="currentPass" id="currentPass" <?php
                if($data['currentPass']){
                    echo "disabled value='Se confirmó la contraseña' type='input'";
                }else{
                    echo 'type="password"';
                }
            ?>>
            <?php
                if(!$data['currentPass']){
                    echo '<button type="submit" class="btnConfirmar">Verificar</button>';
                }
            ?>
            </form>
            <button class="btnChangePass" id='cambiarContrasenia' type="button"
            <?php
                if(!$data['currentPass']){
                    echo "disabled";
                }
            ?>>Cambiar contraseña</button>
        </div>
        
        <div class="accionesRecientes">
            <h2>Acciones recientes</h2>
            <hr>
            <div class="tabla">
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
        <a class="logout" href="<?php echo URLROOT ?>/Cuenta/logOut">Cerrar sesión</a>
    </div>
    <script src="<?php echo URLROOT ?>/public/js/popups.js"></script>
    <script src="<?php echo URLROOT ?>/public/js/miCuenta.js"></script>
    <script class="script">
        let cuentan = {
            "ci": <?= $_SESSION['cuenta']['ci'] ?>,
            "nombre": "<?= $_SESSION['cuenta']['nombre'] ?>",
            "apellido": "<?= $_SESSION['cuenta']['apellido'] ?>",
            "telefono": <?= $_SESSION['cuenta']['telefono'] ?>,
            "email": "<?= $_SESSION['cuenta']['email'] ?>"
        };
        let auditoriasn = <?= json_encode($data['auditorias']) ?>;
        cargarInfoCuenta(cuentan);
        cargarAuditorias(auditoriasn)
    </script>
</div>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>