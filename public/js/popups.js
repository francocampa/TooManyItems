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
    function createPopupInput(titulo, id, name){
        return '<h2>'+titulo+'</h2> <input type="text" id="'+id+'" name="'+name+'">';
    }

    function createPopupText(text){
        return '<h2>'+text+'</h2>';
    }
    //Aqu[i est[an los m[etodos por bot[on, cada bot[on hace que aparezca el blurr y el popup, adem[as crea los input necesarios 
    $('#marca').on('click', function (){
        //Creo los input
        let nombreInput=createPopupInput('Nombre', 'nombre', 'nombre');
        //Aplico los valores que necesito a las propiedades
        $('.popup').prop('action', $('.popup').prop('action')+'/marca');    //Esto me enviar[a al controller que se encargar[a de agregar la info del popup a la bd
        $('.popup').find('h1').html('Agregar Marca');
        //Agrego el input al container dentro del popupp
        $('.popupInputs').append(nombreInput);
        //Muestro el blurr y el popup
        $('.blurr').fadeIn();
        $('.popup').fadeIn();
    });
    $('#proveedor').on('click', function (){
        let nombreInput=createPopupInput('Nombre', 'nombre', 'nombre');
        let telefonoInput=createPopupInput('Telefono', 'telefono', 'telefono');

        $('.popup').find('h1').html('Agregar Proveedor');
        $('.popup').prop('action', $('.popup').prop('action')+'/proveedor');
        $('.popupInputs').append(nombreInput);
        $('.popupInputs').append(telefonoInput);
        
        $('.blurr').fadeIn();
        $('.popup').fadeIn();        
    });
    $('#ubicacion').on('click', function (){
        let nombreInput=createPopupInput('Nombre', 'nombre', 'nombre');
        let tipoInput=createPopupInput('Tipo', 'tipo', 'tipo');

        $('.popup').find('h1').html('Agregar Ubicacion');
        $('.popup').prop('action', $('.popup').prop('action')+'/ubicacion');
        $('.popupInputs').append(nombreInput);
        $('.popupInputs').append(tipoInput);

        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
    
});