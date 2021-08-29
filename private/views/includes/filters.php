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
    <a href="<?php echo URLROOT; ?>/Formulario/insumo/<?php if(isset($data['origen'])){echo $data['origen'];}?>" class="btnOrange">Agregar</a>
</div>