<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
</head>

<body>
<?php
                                // comprobar si tenemos los parametros w1 y w2 en la URL
                                if (isset($_GET["productos"])) {
                                // asignar w1 y w2 a dos variables
                                $productosCompra = $_GET["productos"];
                                // mostrar $phpVar1 y $phpVar2
                                echo "<p>Parameters: " . $productosCompra . "</p>";
                                } else {
                                echo "<p>No parameters</p>";
                                }
                                ?>
    <div class="container-fluid">
        <div class="row mb-2" style="background:#ED4D46">
            <h1 class="font-weight-bold m-4" style="color:#FFFFFF">COMPRAS</h1>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="background:#D5DBDB">
                <h5 class="blockquote text-center"> <strong>Consultar Producto</strong></h5>
            </div>
            <div class="col-md-2"> </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Codigo de Barras</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Costo</th>
                        <th scope="col">% Porcentaje Ganancia</th>
                        <th scope="col">IVA</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Caducidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <main class="container">
            <!-- Button trigger modal -->
            <button id="bm" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Ingresar producto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto"
                                    id="producto">
                            </div>
                            <div class="row" style="height:200px;overflow:auto;" id="resultados">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Agregar Producto</button>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
    
    <script>
    const texto = document.querySelector('#producto');

    function filtrar() {
        //document.getElementById("resultados").innerHTML = "";
        fetch(`/compra/create?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.all.innerHTML = html
            })
        //var arrayJS = ?php echo json_encode($productos);?>;
        const valor = fetch(`/departamento/buscadorProducto?texto=${texto.value}`, {
            method: 'get'
        });
        const valor1 = fetch(`/departamento/buscadorProducto?texto=${texto.value}`, {
            method: 'get'
        });
        //window.location.href = window.location.href + "?p=" + valor;

    }
    texto.addEventListener('keyup', filtrar);
    //filtrar();
    function f() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/departamento/buscadorProducto?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
        }
        f();
    </script>
    
</body>

</html>