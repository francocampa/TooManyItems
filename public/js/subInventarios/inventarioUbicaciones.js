var itemTabla=document.getElementsByClassName("item marcas")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item marcas")[0]);
function llenarTabla(ubicaciones){
    ubicaciones.forEach(ubicacion => {
        const ubicacionTabla=itemTabla.cloneNode(true);
        //insumoTabla.href=insumoTabla.href+"/Inventario/instancias/"+insumo.codInsumo;
        ubicacionTabla.childNodes[1].innerHTML=ubicacion.nombre;
        ubicacionTabla.childNodes[3].innerHTML=ubicacion.tipo;

        tabla.appendChild(ubicacionTabla);

    });
}