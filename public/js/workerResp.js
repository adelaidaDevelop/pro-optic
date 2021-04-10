let productos = [];
let productosSucursal = [];
let palabra = "";
let seleccion = "";
let bajosExis = "";
let depa = "";
let productosList = [];

let opcBajosE = "";
this.onmessage = function(e)
{
    if(e.data !=undefined)
    {
        //console.log(JSON.parse(e.data.palabra));
        
        //console.log(e.data.palabra);
        //console.log(e.data.productos);
        
        productos = e.data.productos;
        productosSucursal = e.data.productosSucursal;
        palabra = e.data.palabra;
        seleccion = e.data.seleccion;
        bajosExis = e.data.bajosExis;
        depa = e.data.depa;
        
        //buscarFiltroNombre2();
        setTimeout(buscarFiltroNombre2(),500);
        this.postMessage({respuesta:productosList,pal:palabra});
        
    }
}

function esperando()
{

}
function buscarFiltroNombre2() {
    productosList = [];
    const palabraBusqueda = palabra;//document.querySelector('#busquedaProducto');
    /*if (!comparar(palabraBusqueda.value)) {
        console.log("No es igual");
        console.log(palabraAux);
        palabraAux = palabraBusqueda.value;
        //const st = setTimeout(buscarFiltroNombre2(),1000);
        buscarFiltroNombre2();
        return;
    }*/
    //let seleccion = seleccion;//document.querySelector("input[name='checkbox2']:checked");
    let opcFolioNombre = seleccion;
    //folioNombreBandera = true;
    //console.log(productos);
    for (let x in productosSucursal) {
        //for(let x=0;x<productosSucursal.length;x++){
        //for (count5 in productos) {
        //if (productos[count5].id === productosSucursal[x].idProducto) {

        //BUSCAR POR FOLIO NOMBRE 
        let producto = productos.find(p => p.id == productosSucursal[x].idProducto);
        if (producto != null) {

            if (opcFolioNombre === 'nombre') {
            //    //$("#idDepartamento").prop('disabled', false);
            //    //$("#bajosExistencia").prop('disabled', false);
                //
                //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRES
                if (producto.nombre.toUpperCase().includes(palabraBusqueda.toUpperCase())) {
                    //BUSCAR POR DEPARTAMENTO
                    //     if (depaBandera == true) { // SI LA OPCION DEPARTAMENTO SE HABILITO 
                    //let depa = depa;//document.querySelector('#idDepartamento');
                    if (depa != "") {
                        if (producto.idDepartamento === parseInt(depa)) {
                            //Cargar datos encontrados filtrado depto, nombre
                            //BUSCAR PRODUCTOS BAJOS DE EXISTENCIA
                            let seleccion = bajosExis;//document.querySelector('input[name="bajosExistencia"]:checked');
                            if (seleccion != null) {
                                opcBajosE = seleccion; //VARIABLE opcBajosE?
                                if (opcBajosE === 'existencia') {
                                    if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                        //PRODUCTOS POR NOMBRE, DEPTO Y BAJOS EXISTENCIA
                                        let departamento = "";
                                        for (count21 in d) {
                                            if (producto.idDepartamento === d[count21].id) {
                                                departamento = d[count21].nombre;
                                            }
                                        }
                                        let id = producto.id;
                                        let productosAdd = {
                                            id: id,
                                            codigoBarras: producto.codigoBarras,
                                            nombre: producto.nombre,
                                            existencia: productosSucursal[x].existencia,
                                            idDepartamento: producto.idDepartamento
                                        };
                                        productosList.push(productosAdd);


                                    }
                                }
                            } else {
                                //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE, DEPTO
                                // buscarFiltroNombre();
                                let departamento = "";
                                for (count21 in d) {
                                    if (producto.idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = producto.id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: producto.codigoBarras,
                                    nombre: producto.nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: producto.idDepartamento
                                };
                                productosList.push(productosAdd);
                            }
                        }
                    } else {
                        //VERIFICAR BAJOS EXISTENCIA 
                        //BUSCAR PRODUCTOS POR NOMBRE, BAJOS DE EXISTENCIA
                        let seleccion = bajosExis;//document.querySelector('input[name="bajosExistencia"]:checked');
                        if (seleccion != null) {
                            opcBajosE = seleccion; //VARIABLE opcBajosE?
                            if (opcBajosE === 'existencia') {
                                if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                    //PRODUCTOS POR NOMBRE Y BAJOS EXISTENCIA
                                    let departamento = "";
                                    for (count21 in d) {
                                        if (producto.idDepartamento === d[count21].id) {
                                            departamento = d[count21].nombre;
                                        }
                                    }
                                    let id = producto.id;
                                    let productosAdd = {
                                        id: id,
                                        codigoBarras: producto.codigoBarras,
                                        nombre: producto.nombre,
                                        existencia: productosSucursal[x].existencia,
                                        idDepartamento: producto.idDepartamento
                                    };
                                    productosList.push(productosAdd);
                                }
                            }
                        } else {
                            //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE
                            /*let departamento = "";
                            for (count21 in d) {
                                if (producto.idDepartamento === d[count21].id) {
                                    departamento = d[count21].nombre;
                                }
                            }*/
                            let id = producto.id;
                            let productosAdd = {
                                id: id,
                                codigoBarras: producto.codigoBarras,
                                nombre: producto.nombre,
                                existencia: productosSucursal[x].existencia,
                                idDepartamento: producto.idDepartamento
                            };
                            productosList.push(productosAdd);
                        }
                    }
                    //  }
                } else {
                    // MENSAJE PRODUCTOS NO ENCONTRADOS
                }
            } else if (opcFolioNombre === 'folio') {
                //$("#idDepartamento").prop('disabled', true);
                //$("#bajosExistencia").prop('disabled', true);
                if (producto.codigoBarras.toUpperCase().includes(palabraBusqueda.toUpperCase())) {
                    let departamento = "";
                    /*for (count21 in d) {
                        if (producto.idDepartamento === d[count21].id) {
                            departamento = d[count21].nombre;
                        }
                    }*/
                    let id = producto.id;
                    let productosAdd = {
                        id: id,
                        codigoBarras: producto.codigoBarras,
                        nombre: producto.nombre,
                        existencia: productosSucursal[x].existencia,
                        idDepartamento: producto.idDepartamento
                    };
                    productosList.push(productosAdd);
                }
            }
        } else {
            //productoNoEncontrado.push(productosSucursal[x]);
            
        }
        //}
    }
    //console.log("Productos no encontrados",productoNoEncontrado);
    //grupos = parseInt(productosList.length / numPorGrupo);
    //pagina = 0;
    //actualizarCabecera();
    //rellenar();
};