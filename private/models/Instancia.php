<?php
    class Instancia{
        public function __construct(){
            
        }
        public function getInstanciasPorInsumo($codInsumo, $codSector){
            $instancias=[];
            $db= db::conectar();
            $callString='SELECT * FROM instancia i WHERE i.codInsumo='.$codInsumo.' i.codSector="'.$codSector.'"';
            $consulta= $db->query($callString);
            // while($filas = $consulta->fetch_assoc()){
            //     $instancias[]=$filas;
            // }
            return $instancias;
        }
    }