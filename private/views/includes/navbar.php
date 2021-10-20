<div class="containerNavbar">
    <navbar>
        <img src="<?php echo URLROOT; ?>/public/img/logos/Logo.svg" alt="" class="navbarLogo">
        <div class="navbarIcons">
            <?php
            if ($_SESSION['permisos']['admin'] || $_SESSION['permisos']['coord']) {
                echo    '<a href="' . URLROOT . '/Estadisticas/es/'.$_SESSION['sectores'][0].'" id="Estadisticas">
                            <img src="' . URLROOT . '/public/img/iconos/Estadisticas.svg" alt="" class="navbarIcon">
                            <p class="subtitulo">Estadisticas</p>
                        </a>';
            }
            ?>
            <?php
            if ($_SESSION['permisos']['admin'] || $_SESSION['permisos']['panio']) {
                echo    '<a href="' . URLROOT . '/Prestamo/paniol" id="Pañol">
                            <img src="' . URLROOT . '/public/img/iconos/Paniol.svg" alt="" class="navbarIcon">
                            <p class="subtitulo">Pañol</p>
                        </a>';
            }
            ?>
            <?php
            if ($_SESSION['permisos']['admin'] || $_SESSION['permisos']['docente']) {
                echo    '<a href="' . URLROOT . '/Prestamo/clases" id="Clases">
                            <img src="' . URLROOT . '/public/img/iconos/Clases.svg" alt="" class="navbarIcon">
                            <p class="subtitulo">Clases</p>
                        </a>';
            }
            ?>
            <a href="<?php echo URLROOT; ?>/Inventario/herramientas" id='Herramientas'>
                <img src="<?php echo URLROOT; ?>/public/img/iconos/Herramientas.svg" alt="" class="navbarIcon">
                <p class="subtitulo">Herramientas</p>
            </a>
            <a href="<?php echo URLROOT; ?>/Inventario/materiales" id="Materiales">
                <img src="<?php echo URLROOT; ?>/public/img/iconos/Materiales.svg" alt="" class="navbarIcon">
                <p class="subtitulo">Materiales</p>
            </a>
            <a href="<?php echo URLROOT; ?>/Inventario/maquinaria" id="Maquinaria">
                <img src="<?php echo URLROOT; ?>/public/img/iconos/Maquinaria.svg" alt="" class="navbarIcon">
                <p class="subtitulo">Maquinaria</p>
            </a>
            <a href="<?php echo URLROOT; ?>/Inventario/informatico" id="Informatica">
                <img src="<?php echo URLROOT; ?>/public/img/iconos/Informatica.svg" alt="" class="navbarIcon">
                <p class="subtitulo">Informatico</p>
            </a>
            <?php
            if ($_SESSION['permisos']['admin']) {
                echo    '<a href="' . URLROOT . '/Empleados/em" id="Empleados">
                                <img src="' . URLROOT . '/public/img/iconos/Empleados.svg" alt="" class="navbarIcon">
                                <p class="subtitulo">Empleados</p>
                            </a>';
            }
            ?>
        </div>
        <a href="<?php echo URLROOT; ?>/Cuenta/ver" id="Mi cuenta">
            <img src="<?php echo URLROOT; ?>/public/img/iconos/Usuario.svg" alt="" class="navbarIconCuenta">
            <p class="subtitulo">Mi cuenta</p>
        </a>
    </navbar>
    <script src="<?php echo URLROOT ?> /public/js/navbar.js"></script>
</div>