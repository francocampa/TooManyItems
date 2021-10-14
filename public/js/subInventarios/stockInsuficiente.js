var insumos=[];
function inicializar(insumosr){
    insumos=insumosr;
    llenarTabla();
}
var itemTabla=document.getElementsByClassName('item')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item')[0]);

function llenarTabla(){
    insumos.forEach(insumo => {
        let insumoTabla=itemTabla.cloneNode(true);
        insumoTabla.childNodes[3].innerHTML=insumo.nombre;
        insumoTabla.childNodes[5].innerHTML=insumo.categoria;
        insumoTabla.childNodes[7].innerHTML=insumo.marca != null ? insumo.marca.nombre : 'Sin marca';
        insumoTabla.childNodes[9].innerHTML=insumo.nombre;
        insumoTabla.childNodes[11].innerHTML=insumo.stockActual+"/"+insumo.stockMinimo;
        insumoTabla.childNodes[13].href+=insumo.codInsumo+"/"+insumo.codSector;


        document.getElementsByClassName('items')[0].appendChild(insumoTabla);
    });
}