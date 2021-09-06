<?php
    session_start();

    function isLoggedIn(){
        if(isset($_SESSION['cuenta'])){
            return true;
        }
        return false;
    }
    function logIn($cuenta){
        $_SESSION['cuenta']=$cuenta;
        $_SESSION['sectores']=['IN','MI'];
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
        var_dump($_SESSION);
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