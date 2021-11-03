<?php
    session_start();

    function isLoggedIn(){
        require_once '../private/models/Cuenta.php';
        $cuentaModelToken= new Usuario();
        $validacionCuenta= isset($_SESSION['cuenta']) ? $cuentaModelToken->validarToken() : false;
        //echo($validacionCuenta['@output']);
        if($validacionCuenta['@output']){
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
        if($_SESSION['permisos']['admin'] || $_SESSION['permisos']['coord']){
            header('location: ' . URLROOT . '/Estadisticas/es/'.$_SESSION['sectores'][0]);
        }
        if ($_SESSION['permisos']['panio']) {
            header('location: ' . URLROOT . '/Prestamo/paniol');
        }
        if ($_SESSION['permisos']['docente']) {
            header('location: ' . URLROOT . '/Prestamo/paniol');
        }
    }
    function logOut(){
        require_once '../private/models/Cuenta.php';
        $cuentaModelLogout = new Usuario();
        $cuentaModelLogout->logOut();
        session_destroy();
        header('location: '.URLROOT.'/Login');
    }