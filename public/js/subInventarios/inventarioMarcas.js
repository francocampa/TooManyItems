var itemTabla=document.getElementsByClassName("item marcas")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item marcas")[0]);

var itemInformacionSubTabla=document.getElementsByClassName('item fallaSubinventario')[0].cloneNode(true);
$('.items.subSubInventario').empty();
var itemInformacionTabla= document.getElementsByClassName('item')[0].cloneNode(true);
$('.items.subInventario').empty();
var informacionBase= document.getElementsByClassName('informacion')[0].cloneNode(true);
$('.informacion').empty();

var marcas=[];
var sector;
function inicializar(marcasr,sectorr){
    marcas=marcasr;
    sector=sectorr;
    llenarTabla();
}
let contador=0;
function llenarTabla(){
    marcas.forEach(marca => {
        const marcaTabla=itemTabla.cloneNode(true);
        //insumoTabla.href=insumoTabla.href+"/Inventario/instancias/"+insumo.codInsumo;
        marcaTabla.childNodes[1].innerHTML=marca.nombre;
        marcaTabla.childNodes[3].innerHTML=10;
        marcaTabla.id=marca.codMarca;
        tabla.appendChild(marcaTabla);
    });
    $('div.item.marcas').on('click',function(e){
        const codMarca=$(this).prop('id');
        const marcaPresionada=marcas.filter(marca => marca.codMarca == codMarca)[0];
        $('.informacion').remove();
        const informacion=informacionBase.cloneNode(true);
        document.getElementsByClassName('division5050')[0].appendChild(informacion);
        $('.informacion').find('h1').html(marcaPresionada.nombre);
        marcaPresionada.insumos.forEach(insumo => {
            let itemInsumo=itemInformacionTabla.cloneNode(true);
            itemInsumo.childNodes[1].childNodes[1].innerHTML=insumo.nombre;
            itemInsumo.childNodes[1].childNodes[3].innerHTML=insumo.modelo;
            itemInsumo.childNodes[1].childNodes[5].innerHTML=insumo.fallas.length;
            itemInsumo.id="insumoSubinventario"+insumo.codInsumo;
            document.getElementsByClassName("items subInventario")[0].appendChild(itemInsumo);
            let itemId="#insumoSubinventario"+insumo.codInsumo;
            $(itemId).children().last().hide();
            $(itemId).children().first().on('click', function(){
                //$('.close').slideUp(100);
                if($(itemId).children().is(':hidden') ){
                    $(itemId).children().last().slideDown();
                }else{
                    $(itemId).children().last().slideUp();
                }
            });
            insumo.fallas.forEach(falla => {
                const itemFalla=itemInformacionSubTabla.cloneNode(true);
                itemFalla.childNodes[1].innerHTML=falla.nombre;
                itemFalla.childNodes[3].innerHTML=falla.fechaInicio;
                itemFalla.childNodes[5].innerHTML=falla.fechaFinal != null ? 'Resuelta' : 'Activa';

                document.getElementsByClassName('items subSubInventario')[contador].appendChild(itemFalla);
            });
            contador++;
        }); 
    });
    $('#scriptFeo').remove();
}
