var instanciaTablaBase=document.getElementsByClassName('instancia')[0].cloneNode(true);
$('#containerInstancias').empty();

$('#cboxInfoCompra').on('click', function (e){
    const estado=!($(this).prop('checked'));
    $("#costo").prop('disabled', estado);
    $("#tipo").prop('disabled', estado);
    $("#proveedor").prop('disabled', estado);
    //$("#cantidad").prop('disabled', estado);
    $("#fechaCompra").prop('disabled', estado);
    if(!estado){
        $('#colInfoCompra').find('.errorInputOff').addClass('errorInput');
        $('#colInfoCompra').find('.errorInputOff').removeClass('errorInputOff');
    }else{
        $('#colInfoCompra').find('.errorInput').addClass('errorInputOff');
        $('#colInfoCompra').find('.errorInput').removeClass('errorInput');
    }
    validarForm();
});
$('#cboxGarantia').on('click', function (e){
    const estado=!($(this).prop('checked'));
    $("#tipoGarantia").prop('disabled', estado);
    $("#fechaInicioGarantia").prop('disabled', estado);
    $("#fechaLimiteGarantia").prop('disabled', estado);
    if(!estado){
        $('#colGarantia').find('.errorInputOff').addClass('errorInput');
        $('#colGarantia').find('.errorInputOff').removeClass('errorInputOff');
    }else{
        $('#colGarantia').find('.errorInput').addClass('errorInputOff');
        $('#colGarantia').find('.errorInput').removeClass('errorInput');
    }
    validarForm();
});
$('#cboxInstancias').on('click', function (e){
    updateInstancias();
    const estado=!($(this).prop('checked'));
    let i=0;
    let identificadorInstancia="#identificador"+i;
    let estadoInstancia="#estado"+i;
    let ubicacionInstancia="#ubicacion"+i;
    while ($(identificadorInstancia).length) {
        $(identificadorInstancia).prop('disabled', estado);
        $(estadoInstancia).prop('disabled', estado);
        $(ubicacionInstancia).prop('disabled', estado);

        i++;
        identificadorInstancia="#identificador"+i;
        estadoInstancia="#estado"+i;
        ubicacionInstancia="#ubicacion"+i;
    }
    if(!estado){
        $('#colInstancias').find('.errorInputOff').addClass('errorInput');
        $('#colInstancias').find('.errorInputOff').removeClass('errorInputOff');
    }else{
        $('#colInstancias').find('.errorInput').addClass('errorInputOff');
        $('#colInstancias').find('.errorInput').removeClass('errorInput');
    }
    validarForm();
});
var contador=1;
updateInstancias();
function updateInstancias(){
    if(contador > $('#cantidad').val()){      //Comprueba si debe quitar instancias
        cantidadARemover= contador - Number.parseInt($('#cantidad').val());
        for (let i = 0; i < cantidadARemover; i++) {
            $('#containerInstancias input:last')[0].remove();
            $('#containerInstancias select:last')[0].remove();
            $('#containerInstancias select:last')[0].remove();
            contador--;
        }
    }else{  //Si no debe quitar agregar[a las necesarias
        for (let i = 0; i < Number.parseInt($('#cantidad').val()); i++) { //reitera el valor de la cantidad, que indica cuantas instancias se necesitan
            let identificadorInstancia="#identificador"+i;
            if(!($(identificadorInstancia).length)){    //Si no est[a colocado en el DOM lo crear[a y lo incluir[a 
                const identificador=instanciaTablaBase.childNodes[1].cloneNode(true);
                identificador.name="identificador"+i;
                identificador.id="identificador"+i;

                const estado=instanciaTablaBase.childNodes[3].cloneNode(true);
                estado.name="estado"+i;
                estado.id="estado"+i;

                const ubicacion=instanciaTablaBase.childNodes[5].cloneNode(true);
                ubicacion.name="ubicacion"+i;
                ubicacion.id="ubicacion"+i;
                $('.instancia').append(identificador);
                $(identificadorInstancia).on('input',function(e){
                    let validaciones;
                    let isCorrecto=true;
                    validaciones=validarLargo(1, 15, identificadorInstancia);
                    if(!validaciones[0]){
                        $(this).addClass('errorInput');
                        $('#btnSubmit').prop('disabled', true);
                        isCorrecto=false;
                    }
                    if(!validaciones[1]){
                        $(this).addClass('errorInput');
                        $('#btnSubmit').prop('disabled', true);
                        isCorrecto=false;
                    }
                    if(isCorrecto){
                        $(this).removeClass('errorInput');
                        validarForm();      
                    }
                });
                $('.instancia').append(estado);
                $('.instancia').append(ubicacion);
                contador++;
            }            
        }
    }
}
$('#costo').on('input',function(e){
    let validaciones;
    let isCorrecto=true;
    if(isNaN($(this).val()) || $(this).val().includes(" ") ){
        $(this).val($(this).val().slice(0, $(this).val().length -1));
    }
    validaciones=validarLargo(1, 11, '#costo');
    if(!validaciones[0]){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(!validaciones[1]){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $(this).removeClass('errorInput');
        validarForm();      
    }
});
$('#cantidad').change(function (){
    if($('#cboxInstancias').prop('checked')){
        updateInstancias();
    }
});
$('#fechaCompra').on('change', function(e){
    let isCorrecto=true
    if($(this).val() == ''){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $(this).removeClass('errorInput');
        validarForm();      
    }
});
$('#tipoGarantia').on('input',function(e){
    let validaciones;
    let isCorrecto=true;
    validaciones=validarLargo(1, 20, '#tipoGarantia');
    if(!validaciones[0]){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(!validaciones[1]){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $(this).removeClass('errorInput');
        validarForm();      
    }
});
$('#fechaInicioGarantia').on('change', function(e){
    let isCorrecto=true
    if($(this).val() == ''){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    let thisDate=convertToDate($(this).val());
    let lastDate=convertToDate($('#fechaLimiteGarantia').val());
    if(thisDate>lastDate){
        $(this).addClass('errorInput');
        $('#fechaLimiteGarantia').addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $(this).removeClass('errorInput');
        if($('#fechaLimiteGarantia').val() != ''){
            $('#fechaLimiteGarantia').removeClass('errorInput');
        }
        validarForm();      
    }
});
$('#fechaLimiteGarantia').on('change', function(e){
    let isCorrecto=true
    if($(this).val() == ''){
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    let thisDate=convertToDate($(this).val());
    let initDate=convertToDate($('#fechaInicioGarantia').val());
    if(thisDate<initDate){
        $('#fechaInicioGarantia').addClass('errorInput');
        $(this).addClass('errorInput');
        $('#btnSubmit').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $(this).removeClass('errorInput');
        if($('#fechaInicioGarantia').val() != ''){
            $('#fechaInicioGarantia').removeClass('errorInput');
        }
        validarForm();      
    }
});

function validarForm(){
    if(!$('.errorInput').length){
        $('#btnSubmit').prop('disabled', false);
    }else{
        $('#btnSubmit').prop('disabled', true);
    }
}
function validarLargo(min, max, selector){
    let validacion=[true,true]
    validacion[0]=$(selector).val().length >= min ? true : false;
    validacion[1]=$(selector).val().length <= max ? true : false;
    return validacion;
}
function convertToDate(fechaString) {
    let splitString= fechaString.split('-');
    let fechaDate= new Date(splitString[0],Number.parseInt(splitString[1])-1,splitString[2]);
    return fechaDate;
}