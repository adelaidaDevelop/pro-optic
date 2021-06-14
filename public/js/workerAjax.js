let idPedido = null;
let idProducto = null;
let cantidad = null;
let respuesta = null;
let url = null;
let token = null;
this.onmessage = async function (e) {
    if (e.data != undefined) {
        idPedido = e.data.idPedido;
        idProducto = e.data.idProducto;
        cantidad = e.data.cantidad;
        _token = e.data._token;
        url = e.data.url;
        await solicitud();
        //setTimeout(await cargarProductosSucursal(),500);
        this.postMessage({ respuesta: respuesta });

    }
}
async function solicitud() {
    try {
        let response = await fetch(url, {
            method: 'POST', // or 'PUT'
            body:
            {
                idPedido: idPedido,
                idProducto: idProducto,
                cantidad: cantidad,
                _token: _token
            },
        });
        if (response.ok) {
            respuesta = await response.json();
            //eturn productosSucursal;
        }
        
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
        return err.message;
    }
    //return response;
}


