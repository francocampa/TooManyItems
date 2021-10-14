//$(document).ready(function(){
	actualizarTipo();
    
    //Agregar una nueva caracteristica tecnica
    var contador = 0;
    $('#agregarCaracteristica').on('click', function(e) {
        let caracteristica='<input type="text" name="caracteristicaNombre'+contador+'" id="caracteristicaNombre'+contador+'" class="errorInput"> <input type="text" name="caracteristicaValor'+contador+'" id="caracteristicaValor'+contador+'" class="errorInput">';
        $('#btnSubmit').prop('disabled', true);
        $('.caracteristicasT').append(caracteristica);
        $('#caracteristicaNombre'+contador).on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 15, "#"+$(this).prop('id'));
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
        $('#caracteristicaValor'+contador).on('input', function(e){
            let validaciones;
            let isCorrecto=true;
            validaciones=validarLargo(1, 15, "#"+$(this).prop('id'));
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
        contador++;
    });
    $('#quitarCaracteristica').on('click',function(e){
        $('.caracteristicasT').children().last().remove();
        $('.caracteristicasT').children().last().remove();
        contador=contador>0 ? contador-1 : contador;
        validarForm();
    });
    //Cambiar el tipo seg[un la categor[ia
    $('#categoria').on('change', function (e) {
        actualizarTipo();
    });
    function actualizarTipo() {
        let options=[];
        if ($('#categoria').val()=='material') {
            options.push('<option value="material">Material</option>');
            options.push('<option value="consumible">Consumible</option>');
        }
        if ($('#categoria').val()=='herramienta') {
            options.push('<option value="de_mano">De mano</option>');
            options.push('<option value="fija">Fija</option>');
        }
        if ($('#categoria').val()=='maquinaria') {
            options.push('<option value="movil">Móvil</option>');
            options.push('<option value="fija">Fija</option>');
        }
        if ($('#categoria').val()=='informatico') {
            options.push('<option value="pc">PC</option>');
            options.push('<option value="monitor">Monitor</option>');
            options.push('<option value="impresora">Impresora</option>');
            options.push('<option value="periferico">Periférico</option>');
        }
        $('#tipo').empty();
        $('#tipo').append(options);
    }

    //Cambiar las marcas cuando se seleccione un nuevo sector
    $('#sectorInsumo').on('change', function (e){
            $('#marcas').empty();
            let options=['<option value="-1">Sin marca</option>'];
            marcas[$(this).val()].forEach(marca => {    //Marcas del sector seleccionado
                options.push('<option value="'+marca.codMarca+'">'+marca.nombre+'</option>');
            });
            $('#marcas').append(options);
    });
    var marcas=[];
    function cargarMarcas(marcasR){
        marcas=marcasR;
    }

    //Validacion de datos min
    function validarLargo(min, max, selector){
        let validacion=[true,true]
        validacion[0]=$(selector).val().length >= min ? true : false;
        validacion[1]=$(selector).val().length <= max ? true : false;
        return validacion;
    }
    $('#nombreInsumo').on('input', function(e){
        let validaciones;
        let isCorrecto=true;
        validaciones=validarLargo(1, 20, '#nombreInsumo');
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
    $('#modeloInsumo').on('input', function(e){
        let validaciones;
        let isCorrecto=true;
        validaciones=validarLargo(0, 20, '#modeloInsumo');
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
    $('#stockMinimo').on('input', function(e){
        let validaciones;
        let isCorrecto=true;
        if(isNaN($(this).val()) || $(this).val().includes(" ") ){
            $(this).val($(this).val().slice(0, $(this).val().length -1));
        }
        validaciones=validarLargo(1, 20, '#stockMinimo');
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
    })
    function validarForm(){
        if(!$('.errorInput').length){
            $('#btnSubmit').prop('disabled', false);
        }
    }

    $('#frontInputImagen').on('click',function(){
        document.getElementById('inputImagen').click()
    })
    var routeAddImage=document.getElementById('frontInputImagen').src;
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
                    document.getElementById('frontInputImagen').src=routeAddImage;
                    $('#frontInputImagen').addClass('errorInput');
                    $('#btnSubmit').prop('disabled', true);
                    isCorrecto=false; 
                }
            }
        }
    
        const extension= imagen.name.split('.')[1];
        const extensionValida=['png'];
        if(!extension.includes(extensionValida)){
            $('#frontInputImagen').addClass('errorInput');
            $('#btnSubmit').prop('disabled', true);
            isCorrecto=false;
        }else{
            fileReader.readAsDataURL(imagen);
        }
        if(isCorrecto){
            $('#frontInputImagen').removeClass('errorInput');
            validarForm();
        }
    })