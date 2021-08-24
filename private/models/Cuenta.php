<?php
    class Cuenta{
        private $ci;
        private $nombre;
        private $apellido;
        private $telefono;
        private $email;
        private $contrasenia;
        private $sectores;
        private $permisos;

        public function __construct($ci,$contrasenia)
        {
            $this->ci=$ci;
            $this->contrasenia=$contrasenia;
            $this->getCuentaByCi($ci);
            // $this->nombre=$nombre;
            // $this->apellido=$apellido;
            // $this->telefno=$telefono;
            // $this->email=$email;
            // $this->contrasenia=$contrasenia;
            // $this->sectores=$sectores;
            // $this->permisos=$permisos;
        }

        public function getCuentaByCi($ci){
            $db= db::conectar();
        }
    }