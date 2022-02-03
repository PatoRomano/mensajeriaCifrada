<?php
require('../modelo/User.php');
require('../modelo/config.php');
require('../modelo/Mensaje.php');
session_start();

$opcion = $_GET['tipoDeMensaje'];

// SE RECIBE EL PARAMETRO QUE TOMA EL VALOR ENVIADO/RECIBIDO PARA UTILIZAR LA MISMA FUNCION PARA MOSTRAR MENSAJES

switch ($opcion) {
    case 'enviados':
        $consulta = "SELECT m.descripcion, m.desplazamiento, u.username, m.fecha_envio FROM mensaje m INNER JOIN usuario u ON m.id_destinatario = u.id_usuario WHERE id_autor = '". $_SESSION['usuario']->getId_usuario(). "' ORDER BY m.fecha_envio DESC";
        break;
    case 'recibidos':
        $consulta = "SELECT m.descripcion, m.desplazamiento, u.username, m.fecha_envio FROM mensaje m INNER JOIN usuario u ON m.id_autor = u.id_usuario WHERE id_destinatario = '". $_SESSION['usuario']->getId_usuario(). "' ORDER BY m.fecha_envio DESC";
        break;
    default:
        break;
}

$result = $conn->query($consulta) or die("Ha ocurrido un error en la consulta") . mysqli_error($conn);
$mensajes = array();

while($mensaje = mysqli_fetch_assoc($result)){
    array_push($mensajes, $mensaje);
}

$jsonMensajes = json_encode($mensajes);

$conn->close();

header('Content-Type: application/json');
echo '' . $jsonMensajes;

?>