<?php
session_start();

if ((isset($_SESSION['usuario']))) {
    header('Location: ./?pag=mensajes');
    die();
}

?>

<head>
    <title>Registro</title>
</head>

<body>

    <section class="pt-5" id="registro">
        <div class="container-lg">
            <div class="text-center">
                <h2 class="mt-5">Registro</h2>
                <p class="lead">Gracias por elegir nuestro servicio de mensajería cifrada.</p>

                <?php
                // SE INCLUYE CONTROL REGISTRAR
                include_once("controlador/controlRegistrar.php");
                ?>

            </div>



            <div class="row justify-content-center mb-5">
                <div class="col-lg-6">
                    <form class="row" action="./?pag=registrar" method="post">

                        <div class="col-12">
                            <label for="username" class="form-label mt-3">Nombre de Usuario: </label>
                            <input required type="text" name="username" id="username" class="form-control" placeholder="Usuario">
                        </div>

                        <div class="col-6">
                            <label for="pass" class="form-label mt-3">Contraseña: </label>
                            <input required type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña">
                        </div>

                        <div class="col-6">
                            <label for="passverification" class="form-label mt-3">Confirmar Contraseña: </label>
                            <input required type="password" name="passverification" id="passverification" class="form-control" placeholder="Confirmar Contraseña">
                        </div>

                        <div class="col-6">
                            <label for="nombre" class="form-label mt-3">Nombre: </label>
                            <input required type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                        </div>

                        <div class="col-6">
                            <label for="apellido" class="form-label mt-3">Apellido: </label>
                            <input required type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido">
                        </div>

                        <div class="col-12">
                            <label for="mail" class="form-label mt-3">Correo Electrónico: </label>
                            <input required type="email" name="mail" id="mail" class="form-control" placeholder="email@example.com">
                        </div>

                        
                        <button type="submit" class="btn btn-primary mt-5 col-4 mx-auto shadow" name="btn-registrar">Enviar</button>


                    </form>
                </div>
            </div>
        </div>
    </section>

</body>