<?php
    class ErrorController extends Controller{
        public function permisos(){
            $data=[
                'titulo' => "",
                'permisos' => ''
            ];
            $this->view('errorMessages/permisosErroneos',$data);
        }
        public function e404()
        {
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => "",
                'permisos' => $permisos
            ];
            $this->view('errorMessages/noExiste',$data);
        }
    }