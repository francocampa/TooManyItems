$(document).ready(function (){
    //El blurr y el popup ya est[an en el footer, pero los oculto hasta que sea necesario
    $('.blurr').hide();
    $('.popup').hide();
    // $('popup').find('hr').width($('popup').width());
    var accion=$('.popup').prop('action');
    $('#closePopup').on('click',function(){
        $('.blurr').fadeOut();
        $('.popup').fadeOut();
        $('.popup').prop('action', accion);
        setTimeout(() => {
            $('.popupInputs').empty();
        }, 350);
    });
    function createPopupInput(titulo, id, name, clase, tipo = 'text'){
        return '<h2>'+titulo+'</h2> <input type="'+tipo+'" autocomplete="off" id="'+id+'" name="'+name+'" class="'+clase+'">';
    }

    var inputSector;
    getSector();
    function getSector(){
        if(document.getElementById('sectorPopup') != null){
            inputSector=document.getElementById('sectorPopup').cloneNode(true);
            document.getElementsByClassName('estructura')[0].removeChild(document.getElementById('sectorPopup'));
        }
    }
    //Aqu[i est[an los m[etodos por bot[on, cada bot[on hace que aparezca el blurr y el popup, adem[as crea los input necesarios 
    $('#marcaPopup').on('click', function (){
        //Creo los input
        let nombreInput=createPopupInput('Nombre', 'nombreMarca', 'nombre','errorPopupInput');
        //Aplico los valores que necesito a las propiedades
        $('.popup').prop('action', $('.popup').prop('action')+'/marca');    //Esto me enviar[a al controller que se encargar[a de agregar la info del popup a la bd
        $('.popup').find('h1').html('Agregar Marca');
        //Agrego el input al container dentro del popupp
        $('.popupInputs').append(nombreInput);
        $('.popupInputs').append(inputSector.cloneNode(true));
        $('#popupBtnConfirmar').prop('disabled', true);
        $('#nombreMarca').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 15, '#nombreMarca');
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
        //Muestro el blurr y el popup
        $('.blurr').fadeIn();
        $('.popup').fadeIn();
    });
    $('#proveedorPopup').on('click', function (){
        let nombreInput=createPopupInput('Nombre', 'nombreProveedor', 'nombre','errorPopupInput');
        let telefonoInput=createPopupInput('Telefono', 'telefonoProveedor', 'telefono');

        $('.popup').find('h1').html('Agregar Proveedor');
        $('.popup').prop('action', $('.popup').prop('action')+'/proveedor');
        $('.popupInputs').append(nombreInput);
        $('.popupInputs').append(inputSector.cloneNode(true));
        $('#popupBtnConfirmar').prop('disabled', true);
        $('#nombreProveedor').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 30, '#nombreProveedor');
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
        $('.popupInputs').append(telefonoInput);
        $('#telefonoProveedor').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(0, 9, '#telefonoProveedor');
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
            if(isNaN($(this).val()) || $(this).val().includes(" ") ){
                $(this).val($(this).val().slice(0, $(this).val().length -1));
            }
            if(isCorrecto){
                $(this).removeClass('errorPopupInput');
                validarPopup();      
            }
        });
        $('.blurr').fadeIn();
        $('.popup').fadeIn();        
    });
    $('#ubicacionPopup').on('click', function (){
        let nombreInput=createPopupInput('Nombre', 'nombreUbicacion', 'nombre','errorPopupInput');
        let tipoInput=createPopupInput('Tipo', 'tipoUbicacion', 'tipo','errorPopupInput');

        $('.popup').find('h1').html('Agregar Ubicacion');
        $('.popup').prop('action', $('.popup').prop('action')+'/ubicacion');
        $('.popupInputs').append(nombreInput);
        $('.popupInputs').append(inputSector.cloneNode(true));
        $('#popupBtnConfirmar').prop('disabled', true);
        $('#nombreUbicacion').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 30, '#nombreUbicacion');
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
        $('.popupInputs').append(tipoInput);
        $('#tipoUbicacion').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 20, '#tipoUbicacion');
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
        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
    $('#cambiarContrasenia').unbind("click").on('click', function (){
        let contraInput=createPopupInput('Contraseña', 'contrasenia', 'contrasenia','errorPopupInput', 'password');
        let seguridadInput=createPopupInput('Ingresela otra vez', 'seguridad', 'seguridad','errorPopupInput', 'password');

        $('.popup').find('h1').html('Cambiar contraseña');
        $('.popup').prop('action', $('.popup').prop('action')+'/cambiarContrasenia');
        $('.popupInputs').append(contraInput);
        $('#popupBtnConfirmar').prop('disabled', true);
        $('#contrasenia').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(8, 20, '#contrasenia');
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
        $('.popupInputs').append(seguridadInput);
        $('#seguridad').on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            if($(this).val() == $('#contrasenia').val()){
                $(this).removeClass('errorPopupInput');
                validarPopup();      
            }else{
                $(this).addClass('errorPopupInput');
                $('#popupBtnConfirmar').prop('disabled', true);
            }
        });
        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
        return false;
    });
});
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