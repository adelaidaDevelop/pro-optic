let url = "";
let objeto = [];
this.onmessage = async function(e) {
    if (e.data != undefined) {
        url = e.data.url;

        //buscarFiltroNombre2();
        await solicitarDatos();
        //setTimeout(await cargarProductosSucursal(),500);
        this.postMessage({ datos: objeto });

    }
}
async function solicitarDatos() {
    let response = "Sin respuesta";
    try {
        response = await fetch(url); //{{session('sucursal')}}`);
        if (response.ok) {
            objeto = await response.json();
            //console.log('los productos para la sucursal son', productosSucursal);
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