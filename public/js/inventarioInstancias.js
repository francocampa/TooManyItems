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
var instanciaTablaBase=document.getElementsByClassName("item instancias")[0].cloneNode(true);
var tabla = document.getElementsByClassName("items")[0];
tabla.removeChild(document.getElementsByClassName("item instancias")[0]);
function llenarTabla(instancias) {
    instancias.forEach(instancia => {
        instanciaTabla=instanciaTablaBase.cloneNode(true);
        instanciaTabla.childNodes[3]=instancia.identificador;
        instanciaTabla.childNodes[5]=instancia.estado;
        instanciaTabla.childNodes[7]=instancia.ubicacion;
        instanciaTabla.childNodes[9]=instancia.fechaCompra;
        instanciaTabla.childNodes[11]=instancia.proveedor;

        tabla.appendChild(instanciaTabla);
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
   