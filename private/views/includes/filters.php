<div class="filtros">
    <input type="text" class="busqueda" id="buscador">
    <select name="" id="">
        <option value="Consumible"></option>
        <option value="Otro tipo"></option>
    </select>
    <select name="" id="">
        <option value="MI"></option>
        <option value="MA"></option>
    </select>
    <?php
        if($data['titulo']=="Inventario de "){
            echo '<a href="'.URLROOT.'/Formulario/compra" class="btnOrange">Agregar</a>';
        } else if (isset($data['origen'])) {
            echo '<a href="' . URLROOT . '/Formulario/insumo/' . $data['origen'] . '" class="btnOrange">Agregar</a>';
        }
        
    ?>
</div>