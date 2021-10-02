var itemTabla=document.getElementsByClassName("item marcas")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item marcas")[0]);
function llenarTabla(marcas){
    marcas.forEach(marca => {
        const marcaTabla=itemTabla.cloneNode(true);
        //insumoTabla.href=insumoTabla.href+"/Inventario/instancias/"+insumo.codInsumo;
        marcaTabla.childNodes[1].innerHTML=marca.nombre;
        marcaTabla.childNodes[3].innerHTML=10;

        tabla.appendChild(marcaTabla);

    });
}