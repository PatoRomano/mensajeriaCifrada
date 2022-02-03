<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap/css/style">
    <title>Cifrado Cesar</title>
    <script src="assets/js/script.js"></script>


</head>

<body class="bg-dark text-light">
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-lg">
            <div class="container-fluid">
                <!-- container fluid hace que estén los elementos alineados horizontalmente, y no uno debajo del otro.  -->
                <a class="navbar-brand ms-2 text-light" href="./">C-Cesar</a>
                <div class="navbar-nav ms-auto">
                    <a id="btn-nav-home" class="nav-link active my-auto" href="./">Home</a>
                    <a id="btn-nav-cerrar-sesion" class="nav-link"></a>
                </div>
            </div>
        </nav>
    </section>

    <?php
    // PARA NAVEGAR ENTRE LAS PAGINAS WEB PRINCIPALES SE UTILIZA UN SWITCH QUE VERIFICA LA VARIABLE pag ENVIADA POR LA URL

    if (isset($_GET['pag'])) {
        switch ($_GET['pag']) {
            case 'registrar':
                require("./vista/registrar.php");
                break;
            case 'mensajes':
                require("./vista/mensajes.php");
                break;
            case 'home':
                require("./vista/home.php");
            default:
                require("./vista/home.php");
                break;
        }
    } else {
        require("./vista/home.php");
    }

    ?>


    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</body>

</html>