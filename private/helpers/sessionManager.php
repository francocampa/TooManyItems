<?php
    session_start();

    function isLoggedIn(){

    }
    function logIn($cuenta){
        $_SESSION['ciCuenta']=$cuenta->ci;
        $_SESSION['contraseniaCuenta']=$cuenta->contrasenia;
        header('location: '. URLROOT . '/Pages/index');
    }
    function logOut(){

    }