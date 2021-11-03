	var insumoSubTablaBase=document.getElementsByClassName('insumoPrestamo')[0].cloneNode(true);
document.getElementsByClassName('tabla')[1].removeChild(document.getElementsByClassName('insumoPrestamo')[0])

var prestamoTablaBase=document.getElementsByClassName('item')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item')[0]);


var insumos = [];
var prestamos=[];
var tipo='';

function cargarInfo(prestamosn, insumosn =[], tipon=[],sectoresn){
    prestamos=prestamosn;
    insumos=insumosn;
    tipo=tipon;
    sectores=sectoresn;
    llenarTabla(sectores[0]);
}

function llenarTabla(sector) {
    let i=0;
    prestamos[sector].forEach(prestamo => {
        prestamoTabla=prestamoTablaBase.cloneNode(true);
        prestamoInfo=prestamoTabla.childNodes[1];
        prestamoCard=prestamoTabla.childNodes[3];

        const itemId='prestamo'+i;
        prestamoTabla.id=itemId;

        prestamoInfo.childNodes[1].innerHTML=prestamo.ciPrestatario;
        prestamoInfo.childNodes[3].innerHTML=prestamo.curso;
        prestamoInfo.childNodes[5].innerHTML=prestamo.fechaPrestado;
        prestamoInfo.childNodes[7].innerHTML=prestamo.horaPrestamo;
        prestamoInfo.childNodes[9].innerHTML=prestamo.insumos != undefined ? prestamo.insumos.length : '-';
        if(prestamo.fechaDevuelto == null){
            prestamoInfo.childNodes[11].innerHTML='Marcar como devuelto';
            prestamoInfo.childNodes[11].value='devolverPrestamo/'+prestamo.codPrestamo;
            prestamoInfo.childNodes[11].id='devolverPrestamo'+prestamo.codPrestamo;
            prestamoInfo.childNodes[11].className='btnPrestamo noDevuelto';
        }
        
        document.getElementsByClassName('items')[0].appendChild(prestamoTabla);
        let queryId='#'+itemId;

        //Abrir y cerrar card
        $(queryId).children().last().hide();
            $(queryId).children().first().on('click', function(){
                //$('.close').slideUp(100);
                if($(queryId).children().is(':hidden') ){
                    $(queryId).children().last().slideDown();
                }else{
                    $(queryId).children().last().slideUp();
                }
        });

        //Boton de devolver prestamo
        if($('#devolverPrestamo'+prestamo.codPrestamo).length){
            $('#devolverPrestamo'+prestamo.codPrestamo).on('click', function(e){
                $('.popup').find('h1').html("Marcar prestamo como devuelto?");
                $('.popup').prop('action', $('.popup').prop('action')+e.target.value);

                $('.blurr').fadeIn();
                $('.popup').fadeIn(); 
            });
        }

        $(queryId).find('textarea').html(prestamo.razon);
        $(queryId).find('textarea').prop('disabled', true);
        prestamo.insumos.forEach(insumo => {
            insumoSubTabla=insumoSubTablaBase.cloneNode(true);

            insumoSubTabla.childNodes[1].innerHTML=insumo.nombre;
            insumoSubTabla.childNodes[3].innerHTML=insumo.nombreMarca == null ? 'Sin marca' : insumo.nombreMarca;
            insumoSubTabla.childNodes[5].innerHTML=insumo.modelo == '' ? 'Sin modelo' : insumo.modelo;
            insumoSubTabla.childNodes[7].innerHTML=insumo.identificador == undefined ? '-' : insumo.identificador;
            insumoSubTabla.childNodes[9].innerHTML=insumo.cantidad == undefined ? '-' : insumo.cantidad;

            $(queryId).find('.tabla').append(insumoSubTabla);
        });
        i++;
    });
}
function vaciarTabla(){
    $('.items').empty();
}

$('#selectorSectores').on('change', function(){
    vaciarTabla();
    llenarTabla($(this).val());
});
$('#buscador').on('input', function(){
    const busqueda= $('#buscador').val().toLowerCase();
    showItems();
    for (let i = 0; i < $('.item').length; i++) {
        const nombreItem=$('.item')[i].childNodes[1].childNodes[1].innerHTML.toLowerCase();
        if(!(nombreItem.includes(busqueda))){
            $('.item')[i].style.display='none';
        } 
    }
})
function showItems(){
    $('.item').css('display','grid');
}

if($('#btnAgregarPrestamo').length){
    const formPrestamo=document.getElementsByClassName('formPrestamo')[0].cloneNode(true);
    const insumoPrestadoTabla=document.getElementsByClassName('insumoSeleccionado')[0].cloneNode(true);
    document.getElementsByClassName('listaInsumosSeleccionados')[0].removeChild(document.getElementsByClassName('insumoSeleccionado')[0]);
    document.getElementsByClassName('contenido')[0].removeChild(document.getElementsByClassName('formPrestamo')[0]);

    $('#btnAgregarPrestamo').on('click', function (e){
        document.getElementsByClassName('popupInputs')[0].appendChild(formPrestamo)
        $('.popup').prop('action', $('.popup').prop('action') + 'agregarPrestamo');
        $('.listaInsumosSeleccionados').empty();
        $('#codSector').val($('#selectorSectores').val());
        if(tipo=='Clases'){
            $('.popup').find('h1').html('Agregar Clase');
            $('#nombreAlumno').remove();
            $('#h1ci').remove();
        }else{
            $('.popup').find('h1').html('Agregar Prestamo');
            $('#nombreAlumno').val('')
            $('#nombreAlumno').on('input', function(e){
                let validaciones;
                let isCorrecto=true;
                if(isNaN($(this).val()) || $(this).val().includes(" ") ){
                    $(this).val($(this).val().slice(0, $(this).val().length -1));
                }
                validaciones=validarLargo(1, 20, '#nombreAlumno');
                if(!validaciones[0]){
                    $(this).addClass('errorPopupInput');
                    $('#popupBtnConfirmar').prop('disabled', true);
                    isCorrecto=false;
                }
                if(!validaciones[1]){
                    $(this).addClass('errorPopupInput');
                    $('#popupBtnConfirmar').prop('disabled', true);
                    isCorrecto=false;
                }
                if(isCorrecto){
                    $(this).removeClass('errorPopupInput');
                    validarPopup();
                }
            })
        }

        const date=new Date();
        const mes=date.getMonth() < 10 ? "0"+date.getMonth() : date.getMonth();
        const dia=date.getUTCDate() < 10 ? "0"+date.getUTCDate() : date.getUTCDate();
        const hora= date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
        const minutos= date.getMinutes() < 10 ? "0"+date.getMinutes() : date.getMinutes();
        const fecha=date.getFullYear()+"-"+mes+"-"+dia;
        const horaActual=hora+":"+minutos;

        $('#fechaPrestamo').val(fecha);
        $('#horaPrestamo').val(horaActual);
        
        $('#claseAlumno').val('')
        $('#claseAlumno').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 20, '#claseAlumno');
            if(!validaciones[0]){
                $(this).addClass('errorPopupInput');
                $('#popupBtnConfirmar').prop('disabled', true);
                isCorrecto=false;
            }
            if(!validaciones[1]){
                $(this).addClass('errorPopupInput');
                $('#popupBtnConfirmar').prop('disabled', true);
                isCorrecto=false;
            }
            if(isCorrecto){
                $(this).removeClass('errorPopupInput');
                validarPopup();      
            }
        });
        $('#razonPrestamo').val('')

        $('#fechaPrestamo').on('change', function(e){
            let isCorrecto=true
            if($(this).val() == ''){
                $(this).addClass('errorPopupInput');
                $('#popupBtnConfirmar').prop('disabled', true);
                isCorrecto=false;
            }
            if(isCorrecto){
                $(this).removeClass('errorPopupInput');
                validarPopup();      
            }
        });
        $('#horaPrestamo').on('change', function(e){
            let isCorrecto=true
            if($(this).val() == ''){
                $(this).addClass('errorPopupInput');
                $('#popupBtnConfirmar').prop('disabled', true);
                isCorrecto=false;
            }
            if(isCorrecto){
                $(this).removeClass('errorPopupInput');
                validarPopup();      
            }
        });
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
            insumos[$('#selectorSectores').val()].forEach(insumo => {
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
            insumos[$('#selectorSectores').val()].forEach(insumo => {
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
        $('.popup').prop('class', $('.popup').prop('class')+' bigPopup');
        validarPopup();
        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
}


function actualizarInstancias(codInsumoSeleccionado){
    $('#listaIdentificadores').empty();
    insumos[$('#selectorSectores').val()].forEach(insumo => {
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
    insumos[$('#selectorSectores').val()].forEach(insumo => {
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

function validarLargo(min, max, selector){
    let validacion=[true,true]
    validacion[0]=$(selector).val().length >= min ? true : false;
    validacion[1]=$(selector).val().length <= max ? true : false;
    return validacion;
}
function validarPopup(){
    if(!$('.errorPopupInput').length){
        $('#popupBtnConfirmar').prop('disabled', false);
    }
}