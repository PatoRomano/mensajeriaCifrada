<?php

session_start();

if ((isset($_SESSION['usuario']))) {
    header('Location: ./?pag=mensajes');
    die();
}

?>

<body>

    <section class="text-center mt-5">
        <h1 class="display-1 pt-5">Cifrado Cesar</h1>
        <h3 class="display-5 pt-2 mb-5">Bienvenido a nuestra aplicación web de mensajería cifrada.</h3>
        <link rel="stylesheet" href="assets/css/style.css">
    </section>

    <?php
    include('controlador/controlSesion.php');
    ?>

    <section class="sesion container mx-auto">
        <form action="./" method="post">
            <div class="modal-content bg-dark shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Inicio de Sesión</h5>
                </div>
                <div class="modal-body">
                    <label for="modal-name" class="form-label">Nombre de Usuario</label>
                    <input required type="text" class="form-control" name="username" id="modal-name" placeholder="Usuario">
                    <label for="modal-pass" class="form-label mt-3">Contraseña</label>
                    <input required type="password" class="form-control" name="pass" id="modal-pass" placeholder="Contraseña">
                </div>
                <div class="modal-footer">
                    <a class="me-auto" href="./?pag=registrar">No tengo una cuenta</a>
                    <button type="submit" class="btn btn-primary" name="iniciarSesion">Iniciar Sesión</button>
                </div>
            </div>
        </form>
    </section>

</body>