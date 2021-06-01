<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pdfs.css') }}" rel="stylesheet">
</head>
<!--EMPIEZA-->

<body class="container">
    <header>
        <div class="row mx-2 position-relative">
            <img class=" text-left mt-3" src="{{ asset('img\farmaciagilogo.png') }}" alt="Editar" height="50px">
            <div class="row w-100  mt-3 mx-auto text-center position-absolute">
                <p class="row h4 text-uppercase text-center mx-auto  my-auto"> Farmacias Gi S.A. de C.V.</p>
            </div>
        </div>
    </header>

    <main>
        <div class="col p-4 mx-4 " id="impDiv">
            <div class="col text-center mt-4">
                <h2 class=""> COMPROBANTE DE ENTREGA</h2>
            </div>
            <br /><br /><br /><br />
            <div class="col mb-4">
                <h3 class="text-left"> ESTIMADO CLIENTE:</h3>
                <p class="h3" style="text-align:justify"> FARMACIAS GI ZIMATLAN, AGRADECE SU PREFERENCIA. A CONTINUACION, SE
                    DETALLA INFORMACION DE SU PAQUETE.</p>
            </div>
            <br />
            <div class="col h4 mt-4 border border-secondary rounded">
                <p class=""> NUMERO DE GUIA</p>
                <p>FECHA GENERADO PAQUETE</p>
                <p>FECHA PROGRAMADO DE ENTREGA</p>
                <p>FECHA DE ENTREGA</p>
                <p>RECIBIO</p>
                <p> DIRECCION DE ENTREGA</p>
            </div>
            <br /><br />
            <div class="col text-center mt-4 h4 text-center">
                <p class="h3">ATENTAMENTE</p>
                <br /><br />
                <p> FARMACIAS GI SA DE C.V ZIMATLAN</p>
                <p>direccion</p>
                <p>telefono</p>
                <p>linkPagina</p>
                <p>farmaciasgizimatlan.epizy.com</p>
                <a href="">farmaciasgizimatlan.epizy.com</a>
            </div>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>
<!--ACABA-->
<script>
 
    document.addEventListener("DOMContentLoaded", () => {
        // Escuchamos el click del botón
        // const $boton = document.querySelector("#imp");
        // $boton.addEventListener("click", () => {
        const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: 1,
                filename: 'seguimiento.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a2",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
    });
</script>

</html>