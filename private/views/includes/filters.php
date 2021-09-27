<form class="filtros" action="" method="$_POST">
    <input type="text" class="busqueda" id="buscador">
    <select name="" id="">
        <option value="Consumible"></option>
        <option value="Otro tipo"></option>
    </select>
    <?php
        if($data['titulo'] == "Inventario de "){
            echo '
                <select name="inventario" id="inventario">
                    <option value="instancias" class="cambioInventario">Instancias</option>
                    <option value="compras" class="cambioInventario">Compras</option>
                </select>
            ';
        }
    ?>
    <select name="sector" id="">
        <!-- <option value="todos">Todos</option> -->
        <?php
        foreach ($_SESSION['sectores'] as $sector) {
            echo '<option value="' . $sector . '">' . $sector . '</option>';
        }
        ?>
    </select>
    <a href="<?php if($data['titulo'] == "Inventario de "){
                    echo URLROOT.'/Formulario/compra/'.$data['codInsumo'];
                    }else if(isset($data['origen'])){
                        echo URLROOT . '/Formulario/insumo/' . $data['origen'];
                    }
        ?>" class="btnOrange">+ Agregar</a>
    <a href="" class="btnRed">x Eliminar</a>
</form>