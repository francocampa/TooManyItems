<?php
    session_start();

    function isLoggedIn(){
        if(isset($_SESSION['ciCuenta'])){
            return true;
        }
        return false;
    }
    function logIn($cuenta){
        $_SESSION['ciCuenta']=$cuenta->ci;
        $_SESSION['contraseniaCuenta']=$cuenta->contrasenia;
        $permisosAdmin= true;
        $permisosCoord=false;
        $permisosPanio=false;
        $permisosDocente=false;
        $permisos=[
            'admin' => $permisosAdmin,
            'coord' => $permisosCoord,
            'panio' => $permisosPanio,
            'docente' => $permisosDocente
        ];
        $_SESSION['permisos']= $permisos;
        if($_SESSION['permisos']['admin'] || $_SESSION['permisos']['coord']){
            header('location: ' . URLROOT . '/Estadisticas');
        }
        if ($_SESSION['permisos']['panio']) {
            header('location: ' . URLROOT . '/Paniol');
        }
        if ($_SESSION['permisos']['docente']) {
            header('location: ' . URLROOT . '/Clases');
        }
    }
    function logOut(){
        session_destroy();
        header('location: '.URLROOT.'/Login');
    }