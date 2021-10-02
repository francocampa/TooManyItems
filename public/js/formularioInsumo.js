//$(document).ready(function(){
	actualizarTipo();
    
    var contador = 1;

    $('#agregarCaracteristica').on('click', function(e) {
        let caracteristica='<input type="text" name="caracteristicaNombre'+contador+'" placeholder="nombre"> <input type="text" name="caracteristicaValor'+contador+'" placeholder="valor">';
        $('.caracteristicasT').append(caracteristica);
        contador++;
    });
    $('#categoria').on('click', function (e) {
        actualizarTipo();
    });

    var currentCat='';
    function actualizarTipo() {
        if(currentCat!=$('#categoria').val()){
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
    }
    var currentSector='';
    $('#sectorInsumo').on('click', function (e){
        if($(this).val()!=currentSector){
            $('#marcas').empty();
            let options=['<option value="-1">Sin marca</option>'];
            marcas[$(this).val()].forEach(marca => {
                options.push('<option value="'+marca.codMarca+'">'+marca.nombre+'</option>');
            });
            $('#marcas').append(options);
            currentSector=$(this).val();
        }
    });
//});
var marcas=[];
function cargarMarcas(marcasR){
    marcas=marcasR;
}