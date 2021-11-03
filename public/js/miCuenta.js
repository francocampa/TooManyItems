// var infoCuenta=[];
$('.accionesRecientes').height($('.updateCuentaForm').height())
function cargarInfoCuenta(cuenta){
    $('#nombre').val(cuenta.nombre);
    $('#apellido').val(cuenta.apellido);
    $('#telefono').val(cuenta.telefono);
    $('#email').val(cuenta.email);
}
var tabla=document.getElementsByClassName('items')[0];
var auditoriaTablaBase=document.getElementsByClassName('item')[0].cloneNode(true);
tabla.removeChild(document.getElementsByClassName('item')[0]);

function cargarAuditorias(auditorias){
    console.log(auditorias)
    let i=0;
    let height=0;
    auditorias.forEach(auditoria => {
        auditoriaTabla=auditoriaTablaBase.cloneNode(true);

        auditoriaTabla.childNodes[1].innerHTML=auditoria.ciEmpleado;
        auditoriaTabla.childNodes[3].innerHTML=auditoria.fecha;
        switch (auditoria.tipo) {
            case 'a':
                tipo='Dio de alta'
                break;
            case 'm':
                tipo='Modificó'
                break;
            case 'b':
                tipo='Dio de baja'
                break;
            default:
                break;
        }
        accion=tipo+" un "+auditoria.tabla;
        auditoriaTabla.childNodes[5].innerHTML=accion;

        tabla.appendChild(auditoriaTabla);
        i++
        if(i == 7){ //7 filas es lo m[aximo que soporta sin overflow
            height=$('.tabla').height(); 
        }
    });
    if (height > 0) $('.tabla').height(height);
}

$('#nombre').on('input', () => {
    let validaciones;
    let isCorrecto=true;
    validaciones=validarLargo(1, 30, '#nombre');
    if(!validaciones[0]){
        $('#nombre').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
        isCorrecto=false;
    }
    if(!validaciones[1]){
        $('#nombre').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $('#nombre').removeClass('errorInput');
        validarForm();      
    }
});
$('#apellido').on('input', () => {
    let validaciones;
    let isCorrecto=true;
    validaciones=validarLargo(1, 30, '#apellido');
    if(!validaciones[0]){
        $('#apellido').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
        isCorrecto=false;
    }
    if(!validaciones[1]){
        $('#apellido').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $('#apellido').removeClass('errorInput');
        validarForm();      
    }
});
$('#telefono').on('input', () => {
    let validaciones;
    let isCorrecto=true;
    if(isNaN($('#telefono').val()) || $('#telefono').val().includes(" ") ){
        $('#telefono').val($('#telefono').val().slice(0, $('#telefono').val().length -1));
    }
    validaciones=validarLargo(9, 9, '#telefono');
    if(!validaciones[0]){
        $('#telefono').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
        isCorrecto=false;
    }
    if(!validaciones[1]){
        $('#telefono').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
        isCorrecto=false;
    }
    if(isCorrecto){
        $('#telefono').removeClass('errorInput');
        validarForm();      
    }
});
$('#email').on('input', () => {
    let validaciones;
    let isCorrecto=true;
    validaciones=validarLargo(1, 40, '#email');
    if(!validaciones[0]){
        isCorrecto=false;
    }
    if(!validaciones[1]){
        isCorrecto=false;
    }
    if($('#email').val().includes('@')){
        let segundaMitad= $('#email').val().split('@')[1]
        if(segundaMitad.includes('.')){

        }else{
            isCorrecto=false;
        }
    }else{
        isCorrecto=false;
    }
    if(isCorrecto){
        $('#email').removeClass('errorInput');
        validarForm();      
    }else{
        $('#email').addClass('errorInput');
        $('.btnConfirmar').prop('disabled', true);
    }
});

 function validarForm(){
     console.log($('.errorInput').length);
    if(!$('.errorInput').length){
        $('.btnConfirmar').prop('disabled', false);
    }
}
function validarLargo(min, max, selector){
    let validacion=[true,true]
    validacion[0]=$(selector).val().length >= min ? true : false;
    validacion[1]=$(selector).val().length <= max ? true : false;
    return validacion;
}