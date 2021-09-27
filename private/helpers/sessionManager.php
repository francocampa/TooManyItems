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
        $_SESSION['sectores'] = [];
        foreach ($cuenta['sectores'] as $sector) {
            array_push($_SESSION['sectores'],$sector['codSector']);
        }
        $_SESSION['permisos']= $cuenta['permisos'];
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