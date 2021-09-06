var prestamoTablaBase=document.getElementsByClassName('item prestamos')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item prestamos')[0]);

function llenarTabla(prestamos) {
    prestamos.forEach(prestamo => {
        prestamoTabla=prestamoTablaBase.cloneNode(true);

        prestamoTabla.childNodes()[1].innerHTML=prestamo.materia;
        prestamoTabla.childNodes()[3].innerHTML=prestamo.grupo;
        prestamoTabla.childNodes()[5].innerHTML=prestamo.docente;
        prestamoTabla.childNodes()[7].innerHTML=prestamo.fecha;

        document.getElementsByClassName('items')[0].appendChild(prestamoTabla);
    });
}