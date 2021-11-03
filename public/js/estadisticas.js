var marcas=[];
var proveedores=[];
var compras=[];
function cargarDatos(marcasn,proveedoresn){
    marcas=marcasn;
    proveedores=proveedoresn;
    compras=comprasn;
    llenarGraficas();
}

function llenarGraficas(){
    let nombresMarcas = [];
    let fallasMarcas = [];
    let colores = [];
    let colorBase = 'rgba(255,134,';
    let bActual = 55;
    let bordes = [];
    marcas.forEach(marca => {
        nombresMarcas.push(marca.nombre);
        fallasMarcas.push(marca.fallas);
        colores.push(colorBase + bActual + ', 1)');
        bActual += 20;
        bordes.push("#545454");
    });
    let fallasPorMarca = document.getElementById('fallasPorMarcaGraph').getContext('2d');
    let fallasPorMarcaChart = new Chart(fallasPorMarca, {
        type: 'bar',
        data: {
            labels: nombresMarcas,
            datasets: [{
                data: fallasMarcas,
                backgroundColor: colores,
                borderColor: bordes
            }]
        },
    })
    let nombresProveedores = [];
    let fallasProveedores = [];
    colores = [];
    colorBase = 'rgba(255,134,';
    bActual = 55;
    bordes = [];
    proveedores.forEach(proveedor => {
        nombresProveedores.push(proveedor.nombre);
        fallasProveedores.push(proveedor.fallas);
        colores.push(colorBase + bActual + ', 1)');
        bActual += 20;
        bordes.push("#545454");
    });
    let fallasPorProveedor = document.getElementById('fallasPorProveedor').getContext('2d');
    let fallasPorProveedorChart = new Chart(fallasPorProveedor, {
        type: 'bar',
        data: {
            labels: nombresProveedores,
            datasets: [{
                data: fallasProveedores,
                backgroundColor: colores,
                borderColor: bordes
            }]
        },
    })

    let meses=['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    let cantidades=[0,0,0,0,0,0,0,0,0,0,0,0];
    colores = [];
    colorBase = 'rgba(255,134,';
    bActual = 55;
    bordes = [];
    compras.forEach(compra => {
        let mes=compra.fecha.split('-')[1];
        cantidades[mes-1]++;
        colores.push(colorBase + bActual + ', 1)');
        bActual += 20;
        bordes.push("#545454");   
    });

    for (let i = 1; i <= meses.length; i++) {
        
    }
    let comprasPorMes= document.getElementById('comprasMensuales').getContext('2d');
    let comprasPorMesChart= new Chart(comprasPorMes,{
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                data: cantidades,
                backgroundColor: colores,
                borderColor: bordes
            }]
        }
    });
}


