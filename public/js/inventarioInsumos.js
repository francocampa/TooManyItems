var itemTabla=document.getElementsByClassName("item insumos")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item insumos")[0]);
function llenarTabla(insumos) {
    insumos.forEach(insumo => {
        insumoTabla=itemTabla.cloneNode(true);
        insumoTabla.childNodes[3].innerHTML=insumo.nombre;
        insumoTabla.childNodes[5].innerHTML=insumo.categoria;
        if(insumo.marca == null){
            insumoTabla.childNodes[7].innerHTML="Sin marca";
        }else{ 
            insumoTabla.childNodes[7].innerHTML=insumo.marca;
            insumoTabla.childNodes[7].innerHTML=insumo.marca;
        }
        insumoTabla.childNodes[9].innerHTML=insumo.modelo;
        insumoTabla.childNodes[11].innerHTML=insumo.stockActual;

        console.log();
        tabla.appendChild(insumoTabla);
    });
    for (let index = 0; index < 4; index++) {
    }
}