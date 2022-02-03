<?php
require('../modelo/User.php');
require('../modelo/Mensaje.php');

//// SE RECIBEN LOS ATRIBUTOS DEL MENSAJE, QUE SON ENVIADOS MEDIANTE UNA PETICION CON AJAX PARA CREAR EL OBJETO MENSAJE
//// Y UTILIZARLO EN LA FUNCION ENVIAR MENSAJE

$mensaje = new Mensaje($_GET['descripcion'],$_GET['id_autor'],$_GET['id_destinatario'],$_GET['desplazamiento']);

User::enviarMensaje($mensaje);

?>