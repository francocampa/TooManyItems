var itemTabla=document.getElementsByClassName("item")[0].cloneNode(true);
console.log(itemTabla);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item")[0]);
function llenarTabla(insumos) {
    insumos.forEach(insumo => {
        insumoTabla=itemTabla.cloneNode(true);
        insumoInfo=insumoTabla.childNodes[1];
        console.log(insumoInfo);
        insumoInfo.href=insumoInfo.href+"/Inventario/instancias/"+insumo.codInsumo;
        insumoInfo.childNodes[3].innerHTML=insumo.nombre;
        insumoInfo.childNodes[5].innerHTML=insumo.tipo;
        if(insumo.marca == null){
            insumoInfo.childNodes[7].innerHTML="Sin marca";
        }else{ 
            insumoInfo.childNodes[7].innerHTML=insumo.marca.nombre;
        }
        insumoInfo.childNodes[9].innerHTML=insumo.modelo;
        insumoInfo.childNodes[11].innerHTML=insumo.stockActual+"/"+insumo.stockMinimo;

        insumoTabla.childNodes[3].value="eliminarInsumo/"+insumo.codInsumo+"/"+insumo.codSector;
        tabla.appendChild(insumoTabla);
    });
}