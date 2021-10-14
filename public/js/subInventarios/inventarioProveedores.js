var itemTabla=document.getElementsByClassName("item marcas")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item marcas")[0]);

var itemInformacionSubTabla=document.getElementsByClassName('item fallaSubinventario')[0].cloneNode(true);
$('.items.subSubInventario').empty();
var itemInformacionTabla= document.getElementsByClassName('item')[0].cloneNode(true);
$('.items.subInventario').empty();
var informacionBase= document.getElementsByClassName('informacion')[0].cloneNode(true);
$('.informacion').empty();

console.log($('div.item.marcas'))
var proveedores=[];
function inicializar(proveedoresr){
    proveedores=proveedoresr;
    llenarTabla();
}
let contador=0;
function llenarTabla(){
    proveedores.forEach(proveedor => {
        const proveedorTabla=itemTabla.cloneNode(true);
        //insumoTabla.href=insumoTabla.href+"/Inventario/instancias/"+insumo.codInsumo;
        proveedorTabla.childNodes[1].innerHTML=proveedor.nombre;
        proveedorTabla.childNodes[3].innerHTML=proveedor.telefono;
        proveedorTabla.id=proveedor.codProveedor;
        tabla.appendChild(proveedorTabla);
    });
    //Evento de click para los items en la tabla principal de proveedores
    $('div.item.marcas').on('click',function(e){       
        const codProveedor=$(this).prop('id');
        const proveedorPresionado=proveedores.filter(proveedor => proveedor.codProveedor == codProveedor)[0];
        $('.informacion').remove();
        const informacion=informacionBase.cloneNode(true);
        document.getElementsByClassName('division5050')[0].appendChild(informacion);
        $('.informacion').find('h1').html(proveedorPresionado.nombre);
        proveedorPresionado.instancias.forEach(instancia => {
            let itemInstancia=itemInformacionTabla.cloneNode(true);
            itemInstancia.childNodes[1].childNodes[1].innerHTML=instancia.identificador;
            itemInstancia.childNodes[1].childNodes[3].innerHTML=instancia.nombre;
            itemInstancia.childNodes[1].childNodes[5].innerHTML=instancia.fallas.length;
            itemInstancia.id="insumoSubinventario"+instancia.codInstancia;
            document.getElementsByClassName("items subInventario")[0].appendChild(itemInstancia);
            let itemId="#insumoSubinventario"+instancia.codInstancia;
            $(itemId).children().last().hide();
            $(itemId).children().first().on('click', function(){
                //$('.close').slideUp(100);
                if($(itemId).children().is(':hidden') ){
                    $(itemId).children().last().slideDown();
                }else{
                    $(itemId).children().last().slideUp();
                }
            });
            instancia.fallas.forEach(falla => {
                const itemFalla=itemInformacionSubTabla.cloneNode(true);
                itemFalla.childNodes[1].innerHTML=falla.nombre;
                itemFalla.childNodes[3].innerHTML=falla.fechaInicio;
                itemFalla.childNodes[5].innerHTML=falla.fechaFinal != null ? 'Resuelta' : 'Activa';

                document.getElementsByClassName('items subSubInventario')[contador].appendChild(itemFalla);
            });
            contador++;
        }); 
        contador=0;
    });
}
$('#buscador').on('input',function(){
    const busqueda= $(this).val().toLowerCase();
    showItems();
    for (let i = 0; i < $('.item').length; i++) {
        const nombreProveedor=$('.item')[i].childNodes[1].innerHTML.toLowerCase();
        if(!(nombreProveedor.includes(busqueda))){
            $('.item')[i].style.display='none';
        } 
    }
})
function showItems(){
    $('.item').css('display','grid');
}


let itemId="#itemSubinventario";
$(itemId).children().last().hide();
$(itemId).children().first().on('click', function(){
    //$('.close').slideUp(100);
    if($(itemId).children().is(':hidden') ){
        $(itemId).children().last().slideDown();
    }else{
        $(itemId).children().last().slideUp();
    }
});