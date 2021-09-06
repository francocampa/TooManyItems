function llenarInfoInsumo(insumo){
    $('.titulo').html($('.titulo').html()+" "+insumo.nombre);
    $('#nombre').val(insumo.nombre);
    $('#categoria').val(insumo.categoria);
    actualizarTipo();
    $('#tipo').val(insumo.tipo);
    if(insumo.marca !== null){
        $('#marca').val(insumo.marca);
    }else{
        $('#marca').val('-1');
    }
    $('#modelo').val(insumo.modelo);
    $('#stockMinimo').val(insumo.stockMinimo);

    let caracteristicaTablaBase=document.getElementsByClassName("input base")[0].cloneNode(true);
    let tablaCaracteristica = document.getElementsByClassName("containerInputs cTecnicas")[0];
    tablaCaracteristica.removeChild(document.getElementsByClassName("input base")[0]);
    insumo.caracteristicasT.forEach(caracteristica => {
        const caracteristicaTabla=caracteristicaTablaBase.cloneNode(true);
        caracteristicaTabla.childNodes[1].innerHTML=caracteristica.nombre;
        caracteristicaTabla.childNodes[3].value=caracteristica.valor;
        tablaCaracteristica.appendChild(caracteristicaTabla);
    });
}

var instanciaTablaBase=document.getElementsByClassName("item")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item")[0]);
function llenarTabla(compras) {
    console.log(compras);
    compras.forEach(compra => {
        let i=0;
        compra.instancias.forEach(instancia => {
            const itemTabla=instanciaTablaBase.cloneNode(true)
            itemTabla.id="item"+i;
            const itemId='#'+itemTabla.id;
            const itemCabeceraTabla=itemTabla.childNodes[1];
            itemCabeceraTabla.childNodes[1].innerHTML=instancia.identificador;
            itemCabeceraTabla.childNodes[3].innerHTML=instancia.estado;
            itemCabeceraTabla.childNodes[5].innerHTML=instancia.ubicacion.nombre;
            itemCabeceraTabla.childNodes[7].innerHTML=compra.infoCompra.fechaAdquisicion;
            itemCabeceraTabla.childNodes[9].innerHTML= compra.infoCompra.proveedor != null ? compra.infoCompra.proveedor.nombre : "Sin proveedor";

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

            $(instanciaForm).find('#identificador').val(instancia.identificador)
            $(instanciaForm).find('#identificador').prop('id','identificador'+i);
            
            $(instanciaForm).find('#estado').val(instancia.estado)
            $(instanciaForm).find('#estado').prop('id','estado'+i);
            
            $(instanciaForm).find('#ubicacion').val(instancia.ubicacion.nombre)
            $(instanciaForm).find('#ubicacion').prop('id','ubicacion'+i);


            $(infoCompraForm).find('#tipoCompra').val(compra.infoCompra.tipo);
            $(infoCompraForm).find('#tipoCompra').prop('id', 'tipoCompra'+i);

            $(infoCompraForm).find('#cantidad').val(compra.infoCompra.cantidad);
            $(infoCompraForm).find('#cantidad').prop('id', 'cantidad'+i);

            $(infoCompraForm).find('#costo').val(compra.infoCompra.costo);
            $(infoCompraForm).find('#costo').prop('id', 'costo'+i);

            $(infoCompraForm).find('#fechaCompra').val(compra.infoCompra.fechaAdquisicion);
            $(infoCompraForm).find('#fechaCompra').prop('id', 'fechaCompra'+i);



            $(garantiaForm).find('#tipoGarantia').val(compra.garantia.tipo);
            $(garantiaForm).find('#tipoGarantia').prop('id', 'tipoGarantia'+i);

            $(garantiaForm).find('#fechaInicio').val(compra.garantia.fechaInicio);
            $(garantiaForm).find('#fechaInicio').prop('id', 'fechaInicio'+i);

            $(garantiaForm).find('#fechaLimite').val(compra.garantia.fechaTerminacion);
            $(garantiaForm).find('#fechaLimite').prop('id', 'fechaLimite'+i);

            console.log($(infoCompraForm).find('input'));
            i++
        });
    });
}

$('#categoria').on('click', function (e) {
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
        options.forEach(option => {
            $('#tipo').append(option);
        });
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
        options.forEach(option => {
            $('#tipo').append(option);
        });
    }
   