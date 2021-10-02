
var compras;
function inicializar(comprasIn){
    compras=comprasIn;
    llenarTabla();
}
function llenarInfoInsumo(insumo){
    $('.titulo').html($('.titulo').html()+" "+insumo.nombre);
    $('#nombre').val(insumo.nombre);
    $('#categoria').val(insumo.categoria);
    actualizarTipo();
    $('#tipo').val(insumo.tipo);
    if(insumo.marca !== null){
        $('#marcaCB').val(insumo.marca.codMarca);
    }else{
        $('#marcaCB').val('-1');
    }
    $('#modelo').val(insumo.modelo);
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

        tablaCaracteristica.appendChild(caracteristicaTabla);
        i++;
    });
}

var instanciaTablaBase=document.getElementsByClassName("item in")[0].cloneNode(true);
var compraTablaBase=document.getElementsByClassName("item com")[0].cloneNode(true);

var headerInstancia= document.getElementsByClassName("cabecera instancias")[0].cloneNode(true);
var headerCompra= document.getElementsByClassName("cabecera compras")[0].cloneNode(true);
document.getElementsByClassName('tabla')[0].removeChild(document.getElementsByClassName("cabecera")[0]);


var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item")[0]);

function llenarTabla() {
    document.getElementsByClassName('tabla')[0].removeChild(document.getElementsByClassName("cabecera")[0]);
    if($('#inventario').val() == 'instancias'){
        document.getElementsByClassName('tabla')[0].prepend(headerInstancia.cloneNode(true));
    }else{
        document.getElementsByClassName('tabla')[0].prepend(headerCompra.cloneNode(true));
    }
    $('.items').empty();
    console.log($('#inventario').val());
    let i=0;
    if(compras != undefined){
        compras.forEach(compra => {
        if($('#inventario').val() == 'instancias'){     //Determina si se quiere visualizar el inventario de instancias o compras
            compra.instancias.forEach(instancia => {
            const itemTabla=instanciaTablaBase.cloneNode(true)
            itemTabla.id="item"+i;
            itemTabla.action=itemTabla.action+compra.codCompra;

            const itemId='#'+itemTabla.id;
            const itemCabeceraTabla=itemTabla.childNodes[1];
            itemCabeceraTabla.childNodes[1].innerHTML=instancia.identificador;
            itemCabeceraTabla.childNodes[3].innerHTML=instancia.estado;
            itemCabeceraTabla.childNodes[5].innerHTML=instancia.ubicacion.nombre;
            itemCabeceraTabla.childNodes[7].innerHTML=compra.infoCompra != null ? compra.infoCompra.fechaAdquisicion : '-';
            itemCabeceraTabla.childNodes[9].innerHTML= compra.infoCompra != null ? compra.infoCompra.proveedor != null ? compra.infoCompra.proveedor.nombre : "Sin proveedor" : '-';
            itemCabeceraTabla.childNodes[13].value='eliminarInstancia/'+instancia.codInstancia+'/'+compra.codSector+'/'+compra.codInsumo;
            
            if(!instancia.falla){
                itemCabeceraTabla.childNodes[11].innerHTML='+';
                itemCabeceraTabla.childNodes[11].className='btnFalla noActiva';
                itemCabeceraTabla.childNodes[11].value='agregarFalla/'+instancia.codInstancia;
            }else{
                itemCabeceraTabla.childNodes[11].innerHTML='!';
                itemCabeceraTabla.childNodes[11].className='btnFalla activa';
                itemCabeceraTabla.childNodes[11].value='solucionarFalla/'+instancia.codInstancia+'/'+instancia.falla.codFalla;
            }
            

            tabla.appendChild(itemTabla);
            $(itemId).children().last().hide();
            $(itemId).children().first().on('click', function(){
                //$('.close').slideUp(100);
                if($(itemId).children().is(':hidden') ){
                    $(itemId).children().last().slideDown();
                }else{
                    $(itemId).children().last().slideUp();
                }
            });

            const instanciaForm=$(itemId).children().last().children()[0];  //Obtengo el container de los input y select de la instancia
            const infoCompraForm=$(itemId).children().last().children()[1];  //Obtengo el container de los input y select de la info de compra
            const garantiaForm=$(itemId).children().last().children()[2];  //Obtengo el container de los input y select de la garantia

            $(instanciaForm).find('#codInstancia').val(instancia.codInstancia)
            $(instanciaForm).find('#codInstancia').prop('id','codInstancia'+i);

            $(instanciaForm).find('#identificador').val(instancia.identificador)
            $(instanciaForm).find('#identificador').prop('id','identificador'+i);
            
            $(instanciaForm).find('#estado').val(instancia.estado)
            $(instanciaForm).find('#estado').prop('id','estado'+i);
            
            console.log(instancia.ubicacion.codUbicacion);
            $(instanciaForm).find('#ubicacion').val(instancia.ubicacion.codUbicacion)
            $(instanciaForm).find('#ubicacion').prop('id','ubicacion'+i);

            if(compra.infoCompra !=null){
                $(infoCompraForm).find('#codInfoCompra').val(compra.infoCompra.codInfoCompra);
                $(infoCompraForm).find('#codInfoCompra').prop('id', 'codInfoCompra'+i);

                if(compra.infoCompra.proveedor != null){
                    $(infoCompraForm).find('#proveedor').val(compra.infoCompra.proveedor.codProveedor);
                }else{
                    $(infoCompraForm).find('#proveedor').val('-1');
                }
                $(infoCompraForm).find('#proveedor').prop('id', 'proveedor'+i);


                $(infoCompraForm).find('#tipoCompra').val(compra.infoCompra.tipo);
                $(infoCompraForm).find('#tipoCompra').prop('id', 'tipoCompra'+i);

                $(infoCompraForm).find('#cantidad').val(compra.cantidad);
                $(infoCompraForm).find('#cantidad').prop('id', 'cantidad'+i);
                $(infoCompraForm).find('#cantidad').prop('disabled',true);


                $(infoCompraForm).find('#costo').val(compra.infoCompra.costo);
                $(infoCompraForm).find('#costo').prop('id', 'costo'+i);

                $(infoCompraForm).find('#fechaCompra').val(compra.infoCompra.fechaAdquisicion);
                $(infoCompraForm).find('#fechaCompra').prop('id', 'fechaCompra'+i);
            }else{
                $(infoCompraForm).find('#proveedor').prop('disabled',true);
                $(infoCompraForm).find('#tipoCompra').prop('disabled',true);
                $(infoCompraForm).find('#proveedor').prop('disabled',true);
                $(infoCompraForm).find('#costo').prop('disabled',true);
            }

            if(compra.garantia != null){
                $(garantiaForm).find('#codGarantia').val(compra.garantia.codGarantia);
                $(garantiaForm).find('#codGarantia').prop('id', 'codGarantia'+i);

                $(garantiaForm).find('#tipoGarantia').val(compra.garantia.tipo);
                $(garantiaForm).find('#tipoGarantia').prop('id', 'tipoGarantia'+i);

                $(garantiaForm).find('#fechaInicio').val(compra.garantia.fechaInicio);
                $(garantiaForm).find('#fechaInicio').prop('id', 'fechaInicio'+i);

                $(garantiaForm).find('#fechaLimite').val(compra.garantia.fechaTerminacion);
                $(garantiaForm).find('#fechaLimite').prop('id', 'fechaLimite'+i);
            }else{
                $(garantiaForm).find('#tipoGarantia').prop('disabled',true);
                $(garantiaForm).find('#fechaInicio').prop('disabled',true);
                $(garantiaForm).find('#fechaLimite').prop('disabled',true);
            }
            
            //console.log($(infoCompraForm).find('input'));
            i++
            });
        }else{
            const itemTabla=compraTablaBase.cloneNode(true)
            itemTabla.id="item"+i;
            itemTabla.action=itemTabla.action+compra.codCompra;
            const itemId='#'+itemTabla.id;
            const itemCabeceraTabla=itemTabla.childNodes[1];
            itemCabeceraTabla.childNodes[5].innerHTML=compra.cantidad;
            itemCabeceraTabla.childNodes[11].value='eliminarCompra/'+compra.codCompra+'/'+compra.codInsumo+'/'+compra.codSector;

            if(compra.infoCompra != null){
                itemCabeceraTabla.childNodes[1].innerHTML=compra.infoCompra.proveedor != null ? compra.infoCompra.proveedor.nombre : "Sin proveedor";
                itemCabeceraTabla.childNodes[3].innerHTML=compra.infoCompra.tipo;
                itemCabeceraTabla.childNodes[7].innerHTML=compra.infoCompra.fechaAdquisicion;
                itemCabeceraTabla.childNodes[9].innerHTML= compra.infoCompra.costo;
            }else{
                itemCabeceraTabla.childNodes[1].innerHTML='-';
                itemCabeceraTabla.childNodes[3].innerHTML='-';
                itemCabeceraTabla.childNodes[7].innerHTML='-';
                itemCabeceraTabla.childNodes[9].innerHTML= '-';
            }

            tabla.appendChild(itemTabla);

            $(itemId).children().last().hide();
            $(itemId).children().first().on('click', function(){
                if($(itemId).children().is(':hidden') ){
                    $(itemId).children().last().slideDown();
                }else{
                    $(itemId).children().last().slideUp();
                }
            });
            const infoCompraForm=$(itemId).children().last().children()[0];  //Obtengo el container de los input y select de la info de compra
            const garantiaForm=$(itemId).children().last().children()[1];  //Obtengo el container de los input y select de la garantia

            if(compra.infoCompra !=null){
                $(infoCompraForm).find('#codInfoCompra').val(compra.infoCompra.codInfoCompra);
                $(infoCompraForm).find('#codInfoCompra').prop('id', 'codInfoCompra'+i);

                if(compra.infoCompra.proveedor != null){
                    $(infoCompraForm).find('#proveedor').val(compra.infoCompra.proveedor.codProveedor);
                }else{
                    $(infoCompraForm).find('#proveedor').val('-1');
                }
                $(infoCompraForm).find('#proveedor').prop('id', 'proveedor'+i);


                $(infoCompraForm).find('#tipoCompra').val(compra.infoCompra.tipo);
                $(infoCompraForm).find('#tipoCompra').prop('id', 'tipoCompra'+i);

                $(infoCompraForm).find('#cantidad').val(compra.cantidad);
                $(infoCompraForm).find('#cantidad').prop('id', 'cantidad'+i);
                $(infoCompraForm).find('#cantidad').prop('disabled',true);

                $(infoCompraForm).find('#costo').val(compra.infoCompra.costo);
                $(infoCompraForm).find('#costo').prop('id', 'costo'+i);

                $(infoCompraForm).find('#fechaCompra').val(compra.infoCompra.fechaAdquisicion);
                $(infoCompraForm).find('#fechaCompra').prop('id', 'fechaCompra'+i);
            }
            if(compra.garantia != null){
                $(garantiaForm).find('#codGarantia').val(compra.garantia.codGarantia);
                $(garantiaForm).find('#codGarantia').prop('id', 'codGarantia'+i);

                $(garantiaForm).find('#tipoGarantia').val(compra.garantia.tipo);
                $(garantiaForm).find('#tipoGarantia').prop('id', 'tipoGarantia'+i);

                $(garantiaForm).find('#fechaInicio').val(compra.garantia.fechaInicio);
                $(garantiaForm).find('#fechaInicio').prop('id', 'fechaInicio'+i);

                $(garantiaForm).find('#fechaLimite').val(compra.garantia.fechaTerminacion);
                $(garantiaForm).find('#fechaLimite').prop('id', 'fechaLimite'+i);

            }
            i++
        }
     });
    $('.btnEliminar').on('click', function(e){
        let texto='<h2>Está seguro de que desea eliminar este item?</h2>';
        $('.popup').find('h1').html('Eliminar');
        $('.popup').prop('action', $('.popup').prop('action')+e.target.value);  //El value fue seteado a los par[ametros necesarios para eliminar una instancia
        $('.popupInputs').append(texto);

        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
    }
    $('.noActiva').on('click', function(e){
        let inputNombre='<h2>Nombre</h2> <input type="text" id="inputNombre" name="inputNombre">';
        let inputObservaciones='<h2>Observaciones</h2> <textarea id="inputObservaciones" name="inputObservaciones"></textarea>';
        let inputDiagnostico='<h2>Diagnóstico</h2> <textarea id="inputDiagnostico" name="inputDiagnostico"></textarea>';


        $('.popup').find('h1').html('Agregar falla');
        $('.popup').prop('action', $('.popup').prop('action')+e.target.value);  //El value fue seteado a los par[ametros necesarios para eliminar una instancia
        $('.popupInputs').append(inputNombre);
        $('.popupInputs').append(inputObservaciones);
        $('.popupInputs').append(inputDiagnostico);


        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
    $('.activa').on('click',function(e){
        let falla;
        compras.forEach(compra => {
            compra.instancias.forEach(instancia => {
                if($(this).val() === 'solucionarFalla/'+instancia.codInstancia+'/'+instancia.falla.codFalla){
                    falla=instancia.falla;
                }
            });
        });
        // let inputNombre='<h2>Nombre</h2> <input type="text" id="inputNombre" name="inputNombre" value="'+falla.nombre+'">';
        let inputFecha='<h2>Fecha</h2> <input type="date" id="inputFecha" disabled="true" name="inputFecha" value="'+falla.fechaInicio+'">';
        let inputObservaciones='<h2>Observaciones</h2> <textarea id="inputObservaciones" disabled="true" name="inputObservaciones">'+falla.observaciones+'</textarea>';
        let inputDiagnostico='<h2>Diagnóstico</h2> <textarea id="inputDiagnostico" disabled="true" name="inputDiagnostico">'+falla.diagnostico+'</textarea>';


        $('.popup').find('h1').html("Solucionar "+falla.nombre);
        $('.popup').prop('action', $('.popup').prop('action')+e.target.value);  //El value fue seteado a los par[ametros necesarios para eliminar una instancia
        //$('.popupInputs').append(inputNombre);
        $('.popupInputs').append(inputFecha);
        $('.popupInputs').append(inputObservaciones);
        $('.popupInputs').append(inputDiagnostico);


        $('.blurr').fadeIn();
        $('.popup').fadeIn(); 
    });
}

    $('#categoria').on('click', function (e) {
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
            currentCat=$('#categoria').val();   
    }
    var currentInventario='instancias';
    $('#inventario').on('change', function (e){
        if(currentInventario != $(this).val()){
            llenarTabla();
            currentInventario = $(this).val();
        }
    });
