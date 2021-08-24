<?php
    class Controller{
        public function view($view, $data = []){
            if(file_exists('../private/views/' . $view . '.php')){
                require_once '../private/views/' . $view . '.php';
            }else{
                die("No existe view");
            }
        }
    }