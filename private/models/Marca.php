<?php
    class Marca{
        public function __construct(){
            
        }
        public function getMarcasPorSector()
        {
            $marca=[
                'codMarca' => 1,
                'nombre' => 'marca1'
            ];
            $marca1 = [
                'codMarca' => 2,
                'nombre' => 'marca2'
            ];
            $marca2 = [
                'codMarca' => 3,
                'nombre' => 'marca3'
            ];
            return [$marca,$marca1,$marca2];
        }
    }
    