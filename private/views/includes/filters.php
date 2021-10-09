<form class="filtros" action="" method="POST">
    <input type="text" class="busqueda" id="buscador">
    <select name="" id="">
        <option value="Consumible"></option>
        <option value="Otro tipo"></option>
    </select>
    <?php
    if ($data['titulo'] == "Inventario de ") {
        echo '
                <select name="inventario" id="inventario">
                    <option value="instancias" class="cambioInventario">Instancias</option>
                    <option value="compras" class="cambioInventario">Compras</option>
                </select>
            ';
    }
    ?>
    <select name="sector" id="selectorSectores">
        <option value="todos">Todos</option>
        <?php
        foreach ($_SESSION['sectores'] as $sector) {
            echo '<option value="' . $sector . '">' . $sector . '</option>';
        }
        ?>
    </select>
    <!-- <?php
            // if(isset($data['sectorInstancia'])){
            //     echo '<input style="display:none;" value="'.$data['sectorInstancia'].'" name="sectorInstancia">';
            // }
            ?> -->
    <?php
        if ($data['titulo'] == "Inventario de " || isset($data['origen'])) {
            echo '<a href="';
            if ($data['titulo'] == "Inventario de ") {
                echo URLROOT . '/Formulario/compra/' . $data['codInsumo'];
            } else if (isset($data['origen'])) {
                echo URLROOT . '/Formulario/insumo/' . $data['origen'];
            }
            echo '" class="btnOrange">+ Agregar</a>';
        }else{
            switch ($data['titulo']) {
                case 'Pañol':
                    echo '<button class="btnOrange" id="btnAgregarPrestamo" type="button">+ Agregar</button>';
                    break;
                case 'Clases':
                    echo '<button class="btnOrange" id="btnAgregarClase" type="button">+ Agregar</button>';
                    break;
                case 'Inventario de Marcas':
                    echo '<button class="btnOrange" id="marca" type="button">+ Agregar</button>';
                    break;
                case 'Inventario de Proveedores':
                    echo '<button class="btnOrange" id="proveedor" type="button">+ Agregar</button>';
                    break;
                case 'Inventario de Ubicaciones':
                    echo '<button class="btnOrange" id="ubicacion" type="button">+ Agregar</button>';
                    break;
                default:
                    # code...
                    break;
            }
        }
    ?>
    <!-- <a href="" class="btnRed">x Eliminar</a> -->
</form>