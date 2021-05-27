let url = "";
let productosSucursal = [];
this.onmessage = async function(e)
{
    if(e.data !=undefined)
    {
        url = e.data.url;
        
        //buscarFiltroNombre2();
        await cargarProductosSucursal()
        //setTimeout(await cargarProductosSucursal(),500);
        this.postMessage({productos:productosSucursal});
        
    }
}
async function cargarProductosSucursal() {
    let response = "Sin respuesta";
    try {
        response = await fetch(url); //{{session('sucursal')}}`);
        if (response.ok) {
            productosSucursal = await response.json();
            console.log('los productos para la sucursal son', productosSucursal);
            //eturn productosSucursal;
        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
        return null;
    }
    //return response;
}


/*async function buscarProducto(palabra) {
    try {
        //const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        //let contador = 1;
        let departamento = "";

        if (palabraBusqueda.value.length == 0) {
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
            return;
        }

        //if (productosSucursal.length == 0) {

        const contenidoProducto = document.querySelector('#consultaBusqueda');
        const contenidoOriginal = contenidoProducto.innerHTML;
        contenidoProducto.innerHTML =
            `<tr>
        <td colspan="5"><div class="d-flex justify-content-center my-3">
            <button class="btn btn-info" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                CARGANDO PRODUCTOS
            </button>
            </div>
            </td>
            </tr>
            `;
        //if (productos.length == 0)
        //    await cargarProductos();
        await cargarProductosSucursal(palabraBusqueda.value);
        contenidoProducto.innerHTML = contenidoOriginal;
        //}
        //console.log(productosSucursal);
        if (productosSucursal.length == 0) {
            cuerpo = `<tr><td colspan="5" class="text-uppercase">No se encontró ningún producto con ese nombre</td></tr>`;
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
            return;
        }
        for (let x in productosSucursal) {
            //for (let count5 in productos) {
            //if (productos[count5].id === productosSucursal[x].idProducto) {
            //  if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
            for (let d in departamentos) {
                if (productosSucursal[x].idDepartamento === departamentos[d].id)
                    departamento = departamentos[d].nombre;
            }
            cuerpo = cuerpo + `
                        <tr onclick="agregarProducto(` + productosSucursal[x].id + `,'` + productosSucursal[x].codigoBarras + `','` +
                productosSucursal[x].nombre + `',` + 0 + `,` + productosSucursal[x].existencia +
                `,` + productosSucursal[x].precio + `)">
                            <th scope="row">` + productosSucursal[x].id + `</th>
                            <td>` + productosSucursal[x].codigoBarras + `</td>
                            <td class="text-uppercase">` + productosSucursal[x].nombre + `</td>
                            <td>` + productosSucursal[x].existencia + `</td>
                            <td>` + departamento + `</td>
                        </tr>
                        `;
            // }
            //}
            //}

        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        //console.log(cuerpo);
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
};
*/