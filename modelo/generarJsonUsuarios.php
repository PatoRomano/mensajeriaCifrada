<?php
require('../modelo/config.php');
require('../modelo/User.php');
session_start();


$consulta = "SELECT * FROM usuario WHERE username != '". $_SESSION['usuario']->getUsername(). "'";
$result = $conn->query($consulta) or die("Ha ocurrido un error en la consulta") . mysqli_error($conn);
$usuarios = array();

while($usuario = mysqli_fetch_assoc($result)){
    array_push($usuarios, $usuario);
}

$jsonUsuarios = json_encode($usuarios);

$conn->close();

header('Content-Type: application/json');
echo '' . $jsonUsuarios;

?>