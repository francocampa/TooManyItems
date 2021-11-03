var empleados;
var sectores;
function cargarInfo(empleadosn,sectoresn) {
    empleados=empleadosn;
    sectores=sectoresn;
    llenarTabla();
}

var itemTabla=document.getElementsByClassName('item')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item')[0]);

var auditoriaTablaBase=document.getElementsByClassName('item')[0].cloneNode(true);
document.getElementsByClassName('items')[1].removeChild(document.getElementsByClassName('item')[0]);
var informacion=document.getElementsByClassName('informacion')[0].cloneNode(true);
$('.informacion').empty();

function llenarTabla(){
        empleados.forEach(empleado => {
            const empleadoTabla=itemTabla.cloneNode(true);
            const infoEmpleadoTabla=empleadoTabla.childNodes[1];

            infoEmpleadoTabla.id=empleado.ciEmpleado;
            infoEmpleadoTabla.childNodes[1].innerHTML=empleado.ciEmpleado;
            infoEmpleadoTabla.childNodes[3].innerHTML=empleado.nombre+" "+empleado.apellido;
            if(empleado.ciAdministrador != null){
                cargo='Administrador';
            }else if(empleado.ciCoordinador != null){
                cargo='Coordinador';
            }else if(empleado.ciPaniolero != null){
                cargo='Pañolero';
            }else if(empleado.ciDocente != null){
                cargo='Docente';
            }
            infoEmpleadoTabla.childNodes[5].innerHTML=cargo;
            
            document.getElementsByClassName('items')[0].appendChild(empleadoTabla);

            $('#'+empleado.ciEmpleado).on('click', function(){
                cargarAuditorias($(this).prop('id'))
            });
        });
}

function cargarAuditorias(ci){
    $('.informacion').remove();
    $('.division5050').append(informacion.cloneNode(true));
    let tabla = document.getElementsByClassName('items')[1]; 
    let i=0;
    // console.log(empleados.filter(empleado => empleado.ciEmpleado == ci))
    auditorias= empleados.filter(empleado => empleado.ciEmpleado == ci)[0].acciones;
    auditorias.forEach(auditoria => {
        auditoriaTabla=auditoriaTablaBase.cloneNode(true);

        auditoriaTabla.childNodes[1].innerHTML=auditoria.ciEmpleado;
        auditoriaTabla.childNodes[3].innerHTML=auditoria.fecha;
        switch (auditoria.tipo) {
            case 'a':
                tipo='Dio de alta'
                break;
            case 'm':
                tipo='Modificó'
                break;
            case 'b':
                tipo='Dio de baja'
                break;
            default:
                break;
        }
        accion=tipo+" un "+auditoria.tabla;
        auditoriaTabla.childNodes[5].innerHTML=accion;

        tabla.appendChild(auditoriaTabla);
        i++
        if(i == 9){ //7 filas es lo m[aximo que soporta sin overflow
            height=$('.tablaAuditorias').height(); 
        }
    });
    $('.tablaAuditorias').height(height);
}
$('#buscador').on('input', function(){
    const busqueda= $('#buscador').val().toLowerCase();
    showItems();
    for (let i = 0; i < $('.item').length; i++) {
        const nombreItem=$('.item')[i].childNodes[1].childNodes[3].innerHTML.toLowerCase();
        if(!(nombreItem.includes(busqueda))){
            $('.item')[i].style.display='none';
        } 
    }
});
$('#selectorSectores').on('change', function(){
    showItems();
    const busqueda= $(this).val();
    if(busqueda!='todos'){
        for (let i = 0; i < empleados.length; i++) {
            let mostrar=false;
            empleados[i].sectores.forEach(sector => {
                if(sector==busqueda){
                    mostrar=true
                }
            });
            $('.item')[i].style.display= mostrar ? 'gird' : 'none';
        }
    }
});
function showItems(){
    $('.item').css('display','grid');
}