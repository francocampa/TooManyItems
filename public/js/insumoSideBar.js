function llenarInfoInsumo(insumo){
    $('.titulo').html($('.titulo').html()+" "+insumo.nombre);
    $('#nombre').val(insumo.nombre);
    $('#nombre').on('input', function(e){
        let validaciones;
        let isCorrecto=true;
        validaciones=validarLargo(1, 20, '#nombre');
        if(!validaciones[0]){
            $(this).addClass('errorInputInsumo');
            $('.btnInsumo').prop('disabled', true);
            isCorrecto=false;
        }
        if(!validaciones[1]){
            $(this).addClass('errorInputInsumo');
            $('.btnInsumo').prop('disabled', true);
            isCorrecto=false;
        }
        if(isCorrecto){
            $(this).removeClass('errorInputInsumo');
            validarFormInsumo();      
        }
    });

    $('#categoria').val(insumo.categoria);
    actualizarTipo();
    $('#tipo').val(insumo.tipo);
    if(insumo.marca !== null){
        $('#marcaCB').val(insumo.marca.codMarca);
    }else{
        $('#marcaCB').val('-1');
    }
    $('#modelo').val(insumo.modelo);
    $('#modelo').on('input', function(e){
        let validaciones;
        let isCorrecto=true;
        validaciones=validarLargo(0, 20, '#modelo');
        if(!validaciones[0]){
            $(this).addClass('errorInputInsumo');
            $('.btnInsumo').prop('disabled', true);
            isCorrecto=false;
        }
        if(!validaciones[1]){
            $(this).addClass('errorInputInsumo');
            $('.btnInsumo').prop('disabled', true);
            isCorrecto=false;
        }
        if(isCorrecto){
            $(this).removeClass('errorInputInsumo');
            validarFormInsumo();      
        }
    });
    $('#stockMinimo').val(insumo.stockMinimo);
    $('#stockActual').val(insumo.stockActual);
    $('#stockActual').prop('max',insumo.stockActual);

    let caracteristicaTablaBase=document.getElementsByClassName("input base")[0].cloneNode(true);
    let tablaCaracteristica = document.getElementsByClassName("containerInputs cTecnicas")[0];
    tablaCaracteristica.removeChild(document.getElementsByClassName("input base")[0]);
    let i=0;
    insumo.caracteristicasT.forEach(caracteristica => {
        const caracteristicaTabla=caracteristicaTablaBase.cloneNode(true);
        caracteristicaTabla.childNodes[1].innerHTML=caracteristica.nombre;
        caracteristicaTabla.childNodes[3].value=caracteristica.valor;
        caracteristicaTabla.childNodes[3].name="caracteristicaT|"+caracteristica.codCaracteristicaTecnica;
        caracteristicaTabla.childNodes[3].id="caracteristicaT"+caracteristica.codCaracteristicaTecnica;

        tablaCaracteristica.appendChild(caracteristicaTabla);
        $('#caracteristicaT'+caracteristica.codCaracteristicaTecnica).on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 15, '#caracteristicaT'+caracteristica.codCaracteristicaTecnica);
            if(!validaciones[0]){
                $(this).addClass('errorInputInsumo');
                $('.btnInsumo').prop('disabled', true);
                isCorrecto=false;
            }
            if(!validaciones[1]){
                $(this).addClass('errorInputInsumo');
                $('.btnInsumo').prop('disabled', true);
                isCorrecto=false;
            }
            if(isCorrecto){
                $(this).removeClass('errorInputInsumo');
                validarFormInsumo();      
            }
        });
        i++;
    });
}
$('#categoria').on('change', function (e) {
    actualizarTipo();
});
function actualizarTipo() {
        let options=[];
        switch ($('#categoria').val()) {
            case 'material':
                options.push('<option value="material">Material</option>');
                options.push('<option value="consumible">Consumible</option>');
                break;
            case 'herramienta':
                options.push('<option value="de_mano">De mano</option>');
                options.push('<option value="fija">Fija</option>');
                break;
            case 'maquinaria':
                options.push('<option value="movil">Móvil</option>');
                options.push('<option value="fija">Fija</option>');
                break;
            case 'informatico':
                options.push('<option value="pc">PC</option>');
                options.push('<option value="monitor">Monitor</option>');
                options.push('<option value="impresora">Impresora</option>');
                options.push('<option value="periferico">Periférico</option>');
                break;
            default:
                break;
        }
        $('#tipo').empty();
        $('#tipo').append(options);
        currentCat=$('#categoria').val();   
}
 $('#frontInputImagen').on('click',function(){
        document.getElementById('inputImagen').click()
    })
    $('#inputImagen').on('change', function (){
        let isCorrecto=true;
        let fileReader= new FileReader();
        const imagen=$('#inputImagen').prop('files')[0];
            console.log(imagen)
        fileReader.onload=function(e){
            let imagen= new Image();
            imagen.src=e.target.result;
            imagen.onload=function(e){
                const height=this.height;
                const width=this.width;
                if(width == height){
                    document.getElementById('frontInputImagen').src=URL.createObjectURL($('#inputImagen').prop('files')[0]);
                    //$('').css('background-image','url('++')');
                }else{
                    isCorrecto=false; 
                }
            }
        }
    
        const extension= imagen.name.split('.')[1];
        const extensionValida=['png'];
        if(!extension.includes(extensionValida)){
            isCorrecto=false;
        }else{
            fileReader.readAsDataURL(imagen);
        }
        if(isCorrecto){
            $('#frontInputImagen').removeClass('errorInputInsumo');
            validarFormInsumo();
        }else{
            document.getElementById('frontInputImagen').src=routeAddImage;
            $('#inputImagen').val('');
        }
    })
    function validarFormInsumo(){
        if(!$('.errorInputInsumo').length){
            $('.btnInsumo').prop('disabled', false);
        }
    }

    function validarLargo(min, max, selector){
    let validacion=[true,true]
    validacion[0]=$(selector).val().length >= min ? true : false;
    validacion[1]=$(selector).val().length <= max ? true : false;
    return validacion;
}