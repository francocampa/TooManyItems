<?php
    class Controller{
        public function view($view, $data = []){
            if(file_exists('../private/views/' . $view . '.php')){
                //echo $data['error']." controller";
                require_once '../private/views/' . $view . '.php';
            }else{
                die("No existe view");
            }
        }
    }