var itemTabla=document.getElementsByClassName("item marcas")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item marcas")[0]);
function llenarTabla(proveedores){
    proveedores.forEach(proveedor => {
        const proveedorTabla=itemTabla.cloneNode(true);
        //insumoTabla.href=insumoTabla.href+"/Inventario/instancias/"+insumo.codInsumo;
        proveedorTabla.childNodes[1].innerHTML=proveedor.nombre;
        proveedorTabla.childNodes[3].innerHTML=proveedor.telefono;

        tabla.appendChild(proveedorTabla);

    });
}