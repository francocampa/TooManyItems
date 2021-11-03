
$('.tabla.max').height($('.item').height()*10);

var itemTabla=document.getElementsByClassName("item mar")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item mar")[0]);

var itemInformacionSubTabla=document.getElementsByClassName('item fallaSubinventario')[0].cloneNode(true);
$('.items.subSubInventario').empty();
var itemInformacionTabla= document.getElementsByClassName('item')[0].cloneNode(true);
$('.items.subInventario').empty();
var informacionBase= document.getElementsByClassName('informacion')[0].cloneNode(true);
$('.informacion').empty();


var ubicaciones=[];
function inicializar(ubicacionesr){
    ubicaciones=ubicacionesr;
    llenarTabla();
}
let contador=0;

function llenarTabla(){
    ubicaciones.forEach(ubicacion => {
        const ubicacionTabla=itemTabla.cloneNode(true);
        const ubicacionInfo= ubicacionTabla.childNodes[1];
        const botonEliminar= ubicacionTabla.childNodes[3];
        //insumoTabla.href=insumoTabla.href+"/Inventario/instancias/"+insumo.codInsumo;
        ubicacionInfo.childNodes[1].innerHTML=ubicacion.nombre;
        ubicacionInfo.childNodes[3].innerHTML=ubicacion.tipo;
        ubicacionInfo.id=ubicacion.codUbicacion;

        botonEliminar.value='eliminarUbicacion/'+ubicacion.codUbicacion;

        tabla.appendChild(ubicacionTabla);
    });
    //Evento de click para los items en la tabla principal de ubicaciones
    $('div.item.mar').on('click',function(e){      
        const codUbicacion=$(this).children()[0].id;
        const ubicacionPresionada=ubicaciones.filter(ubicacion => ubicacion.codUbicacion == codUbicacion)[0];
        $('.informacion').remove();
        const informacion=informacionBase.cloneNode(true);
        document.getElementsByClassName('division5050')[0].appendChild(informacion);
        $('.informacion').find('h1').html(ubicacionPresionada.nombre);
        
        ubicacionPresionada.instancias.forEach(instancia => {
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
    $('.btnEliminar').on('click', function(e){
        let texto='<h2>Está seguro de que desea eliminar este item?</h2>';
        $('.popup').find('h1').html('Eliminar');
        $('.popup').prop('action', $('.popup').prop('action')+e.target.value);
        $('.popupInputs').append(texto);

        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
}
$('#buscador').on('input',function(){
    const busqueda= $(this).val().toLowerCase();
    showItems();
    for (let i = 0; i < $('.item').length; i++) {
        const nombreUbicacion=$('.item')[i].childNodes[1].innerHTML.toLowerCase();
        if(!(nombreUbicacion.includes(busqueda))){
            $('.item')[i].style.display='none';
        } 
    }
})
function showItems(){
    $('.item').css('display','grid');
}