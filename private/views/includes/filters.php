<form class="filtros" action="" method="POST">
    <!-- <div class="fila">
        <h2>Hola</h2>
        <h2>Hola</h2>
        <h2>Hola</h2>
    </div> -->
        <p>Buscador</p>
        <input type="text" class="busqueda" id="buscador">
        <!-- Filtro por tipo de inventario, solo para instancias -->
        <?php
        if ($data['titulo'] == "Inventario de ") {
            echo ' <p>Inventario</p>
                    <select name="inventario" id="inventario">
                        <option value="instancias" class="cambioInventario">Instancias</option>
                        <option value="compras" class="cambioInventario">Compras</option>
                    </select>
                ';
        }
        ?>

        <!-- Filtro por sector -->
        <?php
        if (isset($data['tipo'])) {
            echo '<p>Sector</p>
                  <select name="sector" id="selectorSectores">
                  <option value="todos">Todos</option>';
            foreach ($_SESSION['sectores'] as $sector) {
                echo '<option value="' . $sector . '">' . $sector . '</option>';
            }
            echo '</select>';
            echo "<p>Tipo</p>
                <select name='" . $data['origen'] . "' id='tipoInsumo'>
                <option value='todos'>Todos</option>
                 </select>";
        }elseif (isset($data['prestamos'])) {
            echo '<p>Sector</p>
                  <select name="sector" id="selectorSectores">';
            foreach ($_SESSION['sectores'] as $sector) {
                echo '<option value="' . $sector . '">' . $sector . '</option>';
            }
            echo '</select>';
        }elseif (isset($data['empleados'])){
            echo '<p>Sector</p>
                  <select name="sector" id="selectorSectores">
                   <option value="todos">Todos</option>';
            foreach ($_SESSION['sectores'] as $sector) {
                echo '<option value="' . $sector . '">' . $sector . '</option>';
            }
            echo '</select>';
        }
        ?>

        <!-- Boton agregar dependiendo de la pestania -->
        <?php
        if($_SESSION['permisos']['admin'] || $_SESSION['permisos']['coord']){
            if ($data['titulo'] == "Inventario de " || isset($data['tipo'])) {
                echo '<a href="';
                if ($data['titulo'] == "Inventario de ") {
                    echo URLROOT . '/Formulario/compra/' . $data['codInsumo'] . '/' . json_decode($data['insumo'])->codSector;
                } else if (isset($data['tipo'])) {
                    echo URLROOT . '/Formulario/insumo/' . $data['origen'];
                }
                echo '" class="btnOrange" id="agregarInstancia">+ Agregar</a>';
            } else {
                switch ($data['titulo']) {
                    case 'Inventario de Marcas':
                        echo '<button class="btnOrange" id="marcaPopup" type="button">+ Agregar</button>';
                        break;
                    case 'Inventario de Proveedores':
                        echo '<button class="btnOrange" id="proveedorPopup" type="button">+ Agregar</button>';
                        break;
                    case 'Inventario de Ubicaciones':
                        echo '<button class="btnOrange" id="ubicacionPopup" type="button">+ Agregar</button>';
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        if($data['titulo']=='Pañol' || $data['titulo']=='Clases'){
                echo '<button class="btnOrange" id="btnAgregarPrestamo" type="button">+ Agregar</button>';
        }
        ?>
</form>