<?php
    class Cuenta{
        public $ci;
        private $nombre;
        private $apellido;
        private $telefono;
        private $email;
        public $contrasenia;
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
        public function login(){
            $db = db::conectar();
            $callString = "CALL loginProvisorio(" . $this->ci . ", \"" . $this->contrasenia . "\", @validacion)";
            $consulta = $db->query($callString);
            $consulta = $db->query("SELECT @validacion");
            $respuesta = $consulta->fetch_array()["@validacion"];
            return $respuesta;
        }

        public function getCuentaByCi($ci){
            $db= db::conectar();
        }
    }