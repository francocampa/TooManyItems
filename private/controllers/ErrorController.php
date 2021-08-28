<?php
    class ErrorController extends Controller{
        public function permisos(){
            $data=[
                'title' => "",
                'permisos' => ''
            ];
            $this->view('errorMessages/permisosErroneos',$data);
        }
    }