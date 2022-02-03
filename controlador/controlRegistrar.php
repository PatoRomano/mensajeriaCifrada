<?php

// SE CONTROLA EL REGISTRO DE LOS USUARIOS

include("modelo/config.php");
include("modelo/User.php");

date_default_timezone_set('America/Argentina/Buenos_Aires'); // SE ESPECIFICA LA ZONA HORARIA
$errores = array();             
$fecha_registro = date('Y-m-d');    // SE FORMATEA LA FECHA DEL REGISTRO

// SI SE PRESIONA EL BOTON REGISTRAR SE CARGAN LOS DATOS DEL FORMULARIO EN EL OBJETO 
// Y SE UTILIZA EL MISMO PARA VERIFICAR QUE LOS DATOS SEAN CORRECTOS. 

if (isset($_POST['btn-registrar'])) {

    $user = new User("",$_POST['nombre'], $_POST['apellido'], $_POST['username'], $_POST['pass'], $_POST['mail'], $fecha_registro);

    if ($user->getPass() != $_POST['passverification']) {
        array_push($errores, "Las contraseñas no coinciden.");
    }
    
    $existeUsuario = $user->validarRegistro();  // SE VALIDA QUE EL NOMBRE DE USUARIO Y MAIL NO EXISTAN EN LA BD

    if($existeUsuario) {
        array_push($errores, $existeUsuario);
    }

    if (count($errores) == 0) {

        $user->registrar();

    } else {
        echo "<div class=\"alert alert-danger alerta-registro mx-auto\" role=\"alert\">";
            "<p>No se ha podido registrar el usuario por los siguientes errores: </p>";
            for ($i=0; $i < sizeof($errores); $i++) { 
                echo"<p class=\"m-0\">". implode('<br>', $errores[$i]) ."</p>";
            };
        echo "</div>";

    }
}
