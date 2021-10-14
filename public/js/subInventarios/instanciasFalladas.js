var instancias=[];
function inicializar(instanciasr){
    instancias=instanciasr;
    llenarTabla();
}
var itemTabla=document.getElementsByClassName('item')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item')[0]);

function llenarTabla(){
    instancias.forEach(instancia => {
        let insumoTabla=itemTabla.cloneNode(true);
        insumoTabla.childNodes[3].innerHTML=instancia.insumo.nombreInsumo;
        insumoTabla.childNodes[5].innerHTML=instancia.insumo.nombre != null ? instancia.insumo.nombre : 'Sin marca';
        insumoTabla.childNodes[7].innerHTML=instancia.insumo.modelo;
        insumoTabla.childNodes[9].innerHTML=instancia.identificador;
        insumoTabla.childNodes[11].innerHTML=instancia.falla.nombre;
        insumoTabla.childNodes[13].innerHTML=instancia.falla.fechaInicio;
        insumoTabla.childNodes[15].innerHTML='!';
        insumoTabla.childNodes[15].className='btnFalla activa';
        insumoTabla.childNodes[15].value='solucionarFalla/'+instancia.codInstancia+'/'+instancia.codFalla;

        document.getElementsByClassName('items')[0].appendChild(insumoTabla);
    });
    $('.activa').on('click',function(e){
        let falla;
        instancias.forEach(instancia => {
            if($(this).val() === 'solucionarFalla/'+instancia.codInstancia+'/'+instancia.codFalla){
                falla=instancia.falla;
            }
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