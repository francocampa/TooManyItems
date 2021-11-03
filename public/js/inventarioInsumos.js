var itemTabla=document.getElementsByClassName("item")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item")[0]);
var insumos=[];
var currentSector='todos';
var tipos=[];
function inicializar(insumosN, sectores){
    insumos=insumosN;
    llenarFiltroPorTipo();
    for (let i = 0; i < $('#tipoInsumo').children().length; i++) {
        tipos.push($('#tipoInsumo').children()[i].value);
    }  
    tipos.shift();
    llenarTabla(sectores,tipos);
}
function llenarTabla(sectores,tiposSeleccionados) {
    $('.items').empty();
    console.log(tiposSeleccionados);
    sectores.forEach(sector => {
        if(insumos!= []){
            insumos[sector].forEach(insumo => {
                tiposSeleccionados.forEach(tipo => {
                    if(insumo.tipo.includes(tipo)){
                        insumoTabla=itemTabla.cloneNode(true);
                        insumoInfo=insumoTabla.childNodes[1];
                        insumoInfo.href=insumoInfo.href+"/Inventario/instancias/"+insumo.codInsumo+"/"+insumo.codSector;
                        insumoInfo.childNodes[1].src=insumo.foto != null ? insumoInfo.childNodes[1].src+insumo.foto.ruta : '';
                        insumoInfo.childNodes[3].innerHTML=insumo.nombre;
                        insumoInfo.childNodes[5].innerHTML=insumo.tipo;
                        if(insumo.marca == null){
                            insumoInfo.childNodes[7].innerHTML="Sin marca";
                        }else{ 
                            insumoInfo.childNodes[7].innerHTML=insumo.marca.nombre;
                        }
                        insumoInfo.childNodes[9].innerHTML=insumo.modelo != '' ? insumo.modelo : 'Sin modelo';
                        insumoInfo.childNodes[11].innerHTML=sector;
                        insumoInfo.childNodes[13].innerHTML=insumo.stockActual+"/"+insumo.stockMinimo;

                        insumoTabla.childNodes[3].value="eliminarInsumo/"+insumo.codInsumo+"/"+insumo.codSector;
                        tabla.appendChild(insumoTabla);
                    }
                });
            });
        }
    });
    $('.btnEliminar').on('click', function(e){
        let texto='<h2>Está seguro de que desea eliminar este item?</h2>';
        $('.popup').find('h1').html('Eliminar');
        $('.popup').prop('action', $('.popup').prop('action')+e.target.value);
        $('.popupInputs').append(texto);

        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
}

//Filtros
$('#buscador').on('input',function(){
    filtrar('busqueda');
})
$('#selectorSectores').on('change', function (){
    filtrar('filtro');
});
$('#tipoInsumo').on('change', function(){
    filtrar('filtro');
});
function filtrar(tipoFiltro){
    if(tipoFiltro == 'filtro'){
        let sectorSeleccionado=$('#selectorSectores').val();
        sectorSeleccionado= sectorSeleccionado == 'todos' ? sectores : [sectorSeleccionado];

        let tipoSeleccionado=$('#tipoInsumo').val();
        tipoSeleccionado=tipoSeleccionado == 'todos' ? tipos : [tipoSeleccionado];

        llenarTabla(sectorSeleccionado,tipoSeleccionado);
    }
    const busqueda= $('#buscador').val().toLowerCase();
    showItems();
    for (let i = 0; i < $('.item').length; i++) {
        const nombreItem=$('.item')[i].childNodes[1].childNodes[3].innerHTML.toLowerCase();
        if(!(nombreItem.includes(busqueda))){
            $('.item')[i].style.display='none';
        } 
    }
}
function showItems(){
    $('.item').css('display','grid');
}

function llenarFiltroPorTipo(){
    const categoria=$('#tipoInsumo').prop('name');
    let options=[];
    switch (categoria) {
        case 'materiales':
            options.push('<option value="material">Material</option>');
            options.push('<option value="consumible">Consumible</option>');
        break;
        case 'herramientas':
            options.push('<option value="de_mano">De mano</option>');
            options.push('<option value="fija">Fija</option>');
        break;
        case 'maquinaria':
            options.push('<option value="movil">Móvil</option>');
            options.push('<option value="fija">Fija</option>');
        break;
        case 'informatico':
            options.push('<option value="pc">PC</option>');
            options.push('<option value="monitor">Monitor</option>');
            options.push('<option value="impresora">Impresora</option>');
            options.push('<option value="periferico">Periférico</option>');
        break;
        default:
            break;
    }
    $('#tipoInsumo').append(options);
}