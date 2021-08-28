$(document).ready(function(){
	var contador = 1;

    $('#agregarCaracteristica').on('click', function(e) {
        let caracteristica='<input type="text" name="caracteristicaNombre'+contador+'" placeholder="nombre"> <input type="text" name="caracteristicaValor'+contador+'" placeholder="valor">';
        $('.caracteristicasT').append(caracteristica);
        contador++;
    });
});