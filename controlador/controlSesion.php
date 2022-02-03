<?php

// SE CONTROLA LA SESION EN BASE AL BOTÓN PRESIONADO

if (isset($_POST['iniciarSesion'])) {
    iniciarSesion($_POST['username'], $_POST['pass']);
}
if (isset($_POST['cerrarSesion'])) {
    cerrarSesion();
}


function iniciarSesion($usuario, $pass)
{
    require("./modelo/User.php");

    $user = new User("","", "", $usuario, $pass, "", "");
    $huboError = $user->validarSesion();

    if (!$huboError) {
        session_start();
        $_SESSION['usuario'] = $user;
        header('Location: ./?pag=mensajes');
    } else {
        
        echo "<div class=\"alert alert-danger alerta-registro mx-auto\" role=\"alert\">".
        "<p class=\"m-0\">" . $huboError . "</p>".
        "</div>";
    }
}


function cerrarSesion()
{
    session_start();
    unset($_SESSION);
    session_destroy();
    header('Location: ../');
}
