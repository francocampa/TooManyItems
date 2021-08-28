<navbar>
    <img src="<?php echo URLROOT; ?>/public/img/logos/Logo.svg" alt="" class="navbarLogo">
    <div class="navbarIcons">
        <?php
        if ($_SESSION['permisos']['admin'] || $_SESSION['permisos']['coord']) {
            echo    '<a href="' . URLROOT . '/Estadisticas">
                            <img src="' . URLROOT . '/public/img/iconos/Estadisticas.svg" alt="" class="navbarIcon">
                        </a>';
        }
        ?>
        <?php
        if ($_SESSION['permisos']['admin'] || $_SESSION['permisos']['panio']) {
            echo    '<a href="' . URLROOT . '/Paniol">
                            <img src="'.URLROOT.'/public/img/iconos/Paniol.svg" alt="" class="navbarIcon">
                        </a>';
        }
        ?>
        <?php
        if ($_SESSION['permisos']['admin'] || $_SESSION['permisos']['docente']) {
            echo    '<a href="' . URLROOT . '/Clases">
                            <img src="' . URLROOT . '/public/img/iconos/Clases.svg" alt="" class="navbarIcon">
                        </a>';
        }
        ?>
        <a href="<?php echo URLROOT; ?>/Inventario/herramientas">
            <img src="<?php echo URLROOT; ?>/public/img/iconos/Herramientas.svg" alt="" class="navbarIcon">
        </a>
        <a href="<?php echo URLROOT; ?>/Inventario/materiales">
            <img src="<?php echo URLROOT; ?>/public/img/iconos/Materiales.svg" alt="" class="navbarIcon">
        </a>
        <a href="<?php echo URLROOT; ?>/Inventario/maquinaria">
            <img src="<?php echo URLROOT; ?>/public/img/iconos/Maquinaria.svg" alt="" class="navbarIcon">
        </a>
        <a href="<?php echo URLROOT; ?>/Inventario/informatico">
            <img src="<?php echo URLROOT; ?>/public/img/iconos/Informatica.svg" alt="" class="navbarIcon">
        </a>
        <?php
            if ($_SESSION['permisos']['admin']) {
                echo    '<a href="' . URLROOT . '/Empleados">
                                <img src="' . URLROOT . '/public/img/iconos/Empleados.svg" alt="" class="navbarIcon">
                            </a>';
            }
        ?>
    </div>
    <a href="<?php echo URLROOT; ?>/Cuenta/ver">
        <img src="<?php echo URLROOT; ?>/public/img/iconos/Usuario.svg" alt="" class="navbarIconCuenta">
    </a>
</navbar>