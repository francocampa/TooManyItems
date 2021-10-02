var prestamoTablaBase=document.getElementsByClassName('item')[0].cloneNode(true);
//document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item')[0]);

function llenarTabla(prestamos) {
    let i=0;
    prestamos.forEach(prestamo => {
        prestamoTabla=prestamoTablaBase.cloneNode(true);
        prestamoInfo=prestamoTabla.childNodes(1);
        console.log(prestamoInfo)
        const itemId='prestamo'+i;
        prestamoInfo.childNodes()[1].innerHTML=prestamo.materia;
        prestamoInfo.childNodes()[3].innerHTML=prestamo.grupo;
        prestamoInfo.childNodes()[5].innerHTML=prestamo.docente;
        prestamoInfo.childNodes()[7].innerHTML=prestamo.fecha;
        prestamoInfo.id=itemId;

        document.getElementsByClassName('items')[0].appendChild(prestamoTabla);

        $(itemId).children().last().hide();
            $(itemId).children().first().on('click', function(){
                //$('.close').slideUp(100);
                if($(itemId).children().is(':hidden') ){
                    $(itemId).children().last().slideDown();
                }else{
                    $(itemId).children().last().slideUp();
                }
        });
        i++;
    });
}

    $('.item').children().last().hide();
    $('.item').children().first().on('click', function(){
        //$('.close').slideUp(100);
        if($('.item').children().is(':hidden') ){
            $('.item').children().last().slideDown();
        }else{
            $('.item').children().last().slideUp();
        }
    });


const formPrestamo=document.getElementsByClassName('formPrestamo')[0].cloneNode(true);
const insumoPrestadoTabla=document.getElementsByClassName('insumoSeleccionado')[0].cloneNode(true);
document.getElementsByClassName('listaInsumosSeleccionados')[0].removeChild(document.getElementsByClassName('insumoSeleccionado')[0]);
document.getElementsByClassName('contenido')[0].removeChild(document.getElementsByClassName('formPrestamo')[0]);

var insumos;
var grupos;
var alumnos;

function cargarInfo(insumosn, gruposn, alumnosn){
    insumos=insumosn;
    grupos=gruposn;
    alumnos=alumnosn
}

$('#btnAgregarPrestamo').on('click', function (e){
    document.getElementsByClassName('popupInputs')[0].appendChild(formPrestamo)
    $('.listaInsumosSeleccionados').empty();

    $('.popup').find('h1').html('Agregar Prestamo');
    const date=new Date();
    const mes=date.getMonth() < 10 ? "0"+date.getMonth() : date.getMonth();
    const dia=date.getUTCDate() < 10 ? "0"+date.getUTCDate() : date.getUTCDate();
    const hora= date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
    const minutos= date.getMinutes() < 10 ? "0"+date.getMinutes() : date.getMinutes();
    const fecha=date.getFullYear()+"-"+mes+"-"+dia;
    const horaActual=hora+":"+minutos;

    $('#claseAlumno').val('')
    $('#nombreAlumno').val('')
    $('#razonPrestamo').val('')

    $('#fechaPrestamo').val(fecha);
    $('#horaPrestamo').val(horaActual);
    let categoriaSeleccionada=$('#categoria').val();
    actualizarCategoria(categoriaSeleccionada);
    $('#categoria').on('change', function(e){
        $('#nombreInstancia').val('');
        $('#identificadorInstancia').val('');
        $('#cantidad').val('0');
        categoriaSeleccionada=$(this).val();
        actualizarCategoria(categoriaSeleccionada);
    });
    $('#nombreInstancia').val('');
    $('#identificadorInstancia').val('');
    $('#cantidad').val('0');
    $('.radioInstanciaCantidad').on('click', function (e){
        if($(this).val() == 'instancia'){
            $('#cantidad').prop('disabled', true);
            $('#identificadorInstancia').prop('disabled', false);
        }else{
            $('#cantidad').prop('disabled', false);
            $('#identificadorInstancia').prop('disabled', true);
        }
    });
    let codInsumoSeleccionado;
    $('#nombreInstancia').on('change', function (e){
        codInsumoSeleccionado=$('[value="'+$(this).val()+'"]').attr('data-value');
        actualizarInstancias(codInsumoSeleccionado);
        insumos.forEach(insumo => {
            if(insumo.codInsumo==codInsumoSeleccionado.split("/")[0] && insumo.codSector==codInsumoSeleccionado.split("/")[1]){
                $('#cantidad').prop('max', insumo.stockActual);
                if(insumo.stockActual == 0){
                    $('#cantidad').prop('min', '0');
                }else{
                    $('#cantidad').prop('min', '1');
                }
            }
        });    
    });
    $('#addInsumo').on('click', function(e){
        const nuevoInsumoTabla= insumoPrestadoTabla.cloneNode(true);
        const codInstanciaSeleccionada=$('[value="'+$('#identificadorInstancia').val()+'"]').attr('data-value')
        let validacionParaAgregar=true;
        let insumoSeleccionado;
        let instanciaSeleccionada='';
        insumos.forEach(insumo => {
            if(insumo.codInsumo==codInsumoSeleccionado.split("/")[0] && insumo.codSector==codInsumoSeleccionado.split("/")[1]){
                insumoSeleccionado=insumo;
                if($('input[name="optionInstanciaCantidad"]:checked').val()=='instancia'){
                    insumo.instancias.forEach(instancia =>{
                        if(codInstanciaSeleccionada==instancia.codInstancia){
                            instanciaSeleccionada=instancia;
                            if(isInstanciaEnTabla(instancia.codInstancia)){
                                validacionParaAgregar=false;
                            }
                            //break;
                        }
                    });
                }
                //break;
            }
        }); 
        let cantidad=-1;
        if($('input[name="optionInstanciaCantidad"]:checked').val()=='cantidad'){
            cantidad=$('#cantidad').val(); 
            if(isInsumoEnTabla(insumoSeleccionado.codInsumo, insumoSeleccionado.codSector)){
                validacionParaAgregar=false;
            }
        } 
        if(instanciaSeleccionada=='' && cantidad==-1){
            validacionParaAgregar=false;
        }
        if(validacionParaAgregar){   //si no est[a el insumo en la tabla con una cantidad, o la misma instancia
            document.getElementsByClassName('listaInsumosSeleccionados')[0].appendChild(nuevoInsumoTabla);
            const idInsumoSeleccionado='insumo'+$('.listaInsumosSeleccionados').children().length;
            $('.listaInsumosSeleccionados').children().last().prop('id',idInsumoSeleccionado);
            console.log(('#'+idInsumoSeleccionado));
            $('#'+idInsumoSeleccionado).children()[0].innerHTML=(insumoSeleccionado.nombre);
            $('#'+idInsumoSeleccionado).children()[1].innerHTML=insumoSeleccionado.marca!=null ? (insumoSeleccionado.marca.nombre) : 'Sin marca';
            $('#'+idInsumoSeleccionado).children()[2].innerHTML=(insumoSeleccionado.modelo);
            $('#'+idInsumoSeleccionado).children()[3].innerHTML=instanciaSeleccionada!='' ? (instanciaSeleccionada.identificador) : '-';
            $('#'+idInsumoSeleccionado).children()[4].innerHTML=cantidad!=-1 ? (cantidad) : '-';
            $('#'+idInsumoSeleccionado).children()[5].onclick=function(e){
                $('.listaInsumosSeleccionados').find("#"+idInsumoSeleccionado).remove();
            };
            $('#'+idInsumoSeleccionado).children()[6].value=insumoSeleccionado.codInsumo+'.'+insumoSeleccionado.codSector+'.'+codInstanciaSeleccionada+'.'+cantidad+'.'+$('#consumir').val();
            $('#'+idInsumoSeleccionado).children()[6].name='insumo'+$('.listaInsumosSeleccionados').children().length;

        }
    })
    $('.popup').prop('action', $('.popup').prop('action')+'agregarPrestamo');
    $('.popup').prop('class', $('.popup').prop('class')+' bigPopup');

    $('.blurr').fadeIn();
    $('.popup').fadeIn(); 
});
function actualizarInstancias(codInsumoSeleccionado){
    $('#listaIdentificadores').empty();
    insumos.forEach(insumo => {
        if(insumo.codInsumo==codInsumoSeleccionado.split("/")[0] && insumo.codSector==codInsumoSeleccionado.split("/")[1]){
            insumo.instancias.forEach(instancia => {
                $('#listaIdentificadores').append('<option value="'+instancia.identificador+'" data-value="'+instancia.codInstancia+'"></option>'); 
                //break;
            });
        }
    });   
}
function actualizarCategoria(categoriaSeleccionada){
    $('#listaNombreInsumo').empty();
    $('#listaIdentificadores').empty();
    insumos.forEach(insumo => {
        if(insumo.categoria == categoriaSeleccionada){
            $('#listaNombreInsumo').append('<option value="'+insumo.nombre+'" data-value="'+insumo.codInsumo+'/'+insumo.codSector+'" class="optionNombreInstancia"></option>');
        }
    });
}
function isInstanciaEnTabla(codInstancia){
    for (let i = 0; i < $('.listaInsumosSeleccionados').children().length; i++) {
        const codInstanciaItem=$('.listaInsumosSeleccionados').children()[i].childNodes[13].value.split('.')[2];       //id de item es: codInsumo/codSector/codInstancia
        if(codInstancia==codInstanciaItem){
            return true;
        }
    }
    return false;
}
function isInsumoEnTabla(codInsumo, codSector){
    for (let i = 0; i <  $('.listaInsumosSeleccionados').children().length; i++) {
        const codInsumoItem=$('.listaInsumosSeleccionados').children()[i].childNodes[13].value.split('.')[0];       //id de item es: codInsumo/codSector/codInstancia
        const codSectorItem=$('.listaInsumosSeleccionados').children()[i].childNodes[13].value.split('.')[1];       //id de item es: codInsumo/codSector/codInstancia
        if(codInsumo==codInsumoItem && codSector==codSectorItem){
            return true;
        }
    }
    return false;
}
