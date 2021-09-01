var instanciaTablaBase=document.getElementsByClassName('instancia')[0].cloneNode(true);

$('#cboxInfoCompra').on('click', function (e){
    const estado=!($(this).prop('checked'));
    $("#costo").prop('disabled', estado);
    $("#tipo").prop('disabled', estado);
    $("#proveedor").prop('disabled', estado);
    //$("#cantidad").prop('disabled', estado);
    $("#fechaCompra").prop('disabled', estado);

});
$('#cboxGarantia').on('click', function (e){
    const estado=!($(this).prop('checked'));
    $("#tipoGarantia").prop('disabled', estado);
    $("#fechaInicioGarantia").prop('disabled', estado);
    $("#fechaLimiteGarantia").prop('disabled', estado);

});
$('#cboxInstancias').on('click', function (e){
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
});
$('#cantidad').change(function (){
    let ultimaInstancia= $('#containerInstancias input:last')[0] != undefined ? $('#containerInstancias input:last')[0].id.slice(-1) : 0;   //obtiene el numero de la [ultima instancia agregada
    // if($('#containerInstancias input:last')[0] != undefined){
    //     ultimaInstancia=$('#containerInstancias input:last')[0].id.slice(-1); //obtiene la id de la [ultima instancia
    // }else{
    //     ultimaInstancia=0;
    // }
    if(ultimaInstancia+1 > $(this).val()){      //Comprueba si debe quitar instancias
        cantidadARemover= Number.parseInt(ultimaInstancia)+1 - Number.parseInt($(this).val());
        for (let i = 0; i < cantidadARemover; i++) {
            $('#containerInstancias input:last')[0].remove();
            $('#containerInstancias select:last')[0].remove();
            $('#containerInstancias select:last')[0].remove();
        }
    }else{  //Si no debe quitar agregar[a las necesarias
        for (let i = 0; i < $(this).val(); i++) { //reitera el valor de la cantidad, que indica cuantas instancias se necesitan
            let identificadorInstancia="#identificador"+i;
            let estadoInstancia="#estado"+i;
            let ubicacionInstancia="#ubicacion"+i;
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
                $('.instancia').append(estado);
                $('.instancia').append(ubicacion);
            }
        }
    }
   
});