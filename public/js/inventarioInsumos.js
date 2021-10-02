var itemTabla=document.getElementsByClassName("item")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item")[0]);
var insumos=[];
var todosSectores=[];
var currentSector='todos';
var cuentaDeCambios=0;
function inicializar(insumosN, sectores){
    insumos=insumosN;
    todosSectores=sectores;
    llenarTabla(sectores);
}
function llenarTabla(sectores) {
    $('.items').empty();
    sectores.forEach(sector => {
        if(insumos!= []){
            insumos[sector].forEach(insumo => {
                insumoTabla=itemTabla.cloneNode(true);
                insumoInfo=insumoTabla.childNodes[1];
                console.log(insumoInfo);
                insumoInfo.href=insumoInfo.href+"/Inventario/instancias/"+insumo.codInsumo+"/"+insumo.codSector;
                insumoInfo.childNodes[3].innerHTML=insumo.nombre;
                insumoInfo.childNodes[5].innerHTML=insumo.tipo;
                if(insumo.marca == null){
                    insumoInfo.childNodes[7].innerHTML="Sin marca";
                }else{ 
                    insumoInfo.childNodes[7].innerHTML=insumo.marca.nombre;
                }
                insumoInfo.childNodes[9].innerHTML=insumo.modelo;
                insumoInfo.childNodes[11].innerHTML=sector;
                insumoInfo.childNodes[13].innerHTML=insumo.stockActual+"/"+insumo.stockMinimo;

                insumoTabla.childNodes[3].value="eliminarInsumo/"+insumo.codInsumo+"/"+insumo.codSector;
                tabla.appendChild(insumoTabla);
            });
        }
    });
    $('.btnEliminar').on('click', function(e){
        let texto='<h2>Está seguro de que desea eliminar este item?</h2>';
        console.log(e.target);
        $('.popup').find('h1').html('Eliminar');
        $('.popup').prop('action', $('.popup').prop('action')+e.target.value);
        $('.popupInputs').append(texto);

        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
}
$('#selectorSectores').on('click', function (){
    let sectorSeleccionado=$(this).val();
    if(sectorSeleccionado!=currentSector){
        currentSector=sectorSeleccionado;
        sectorSeleccionado= sectorSeleccionado == 'todos' ? sectores : [sectorSeleccionado];
        llenarTabla(sectorSeleccionado);
    }
});