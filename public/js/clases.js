var prestamoTablaBase=document.getElementsByClassName('item clase')[0].cloneNode(true);
document.getElementsByClassName('items')[0].removeChild(document.getElementsByClassName('item clase')[0]);

function llenarTabla(clases) {
    clases.forEach(clase => {
        claseTabla=prestamoTablaBase.cloneNode(true);

        claseTabla.childNodes()[1].innerHTML=clase.materia;
        claseTabla.childNodes()[3].innerHTML=clase.grupo;
        claseTabla.childNodes()[5].innerHTML=clase.docente;
        claseTabla.childNodes()[7].innerHTML=clase.fecha;

        document.getElementsByClassName('items')[0].appendChild(claseTabla);
    });
}