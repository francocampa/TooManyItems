var empleados;

function cargarInfo(empleadosn) {
    empleados=empleadosn;
    llenarTabla();
}

var itemTabla=document.getElementsByClassName('item')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item')[0]);
function llenarTabla(){
    empleados.forEach(empleado => {
        const empleadoTabla=itemTabla.cloneNode(true);
        const infoEmpleadoTabla=empleadoTabla.childNodes[1];

        infoEmpleadoTabla.childNodes[1].innerHTML=empleado.ciEmpleado;
        infoEmpleadoTabla.childNodes[3].innerHTML=empleado.nombre+" "+empleado.apellido;
        infoEmpleadoTabla.childNodes[5].innerHTML='';

        document.getElementsByClassName('items')[0].appendChild(empleadoTabla);
    });
}