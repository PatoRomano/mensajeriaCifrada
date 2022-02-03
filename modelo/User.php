<?php



class User
{

    private $id_usuario;
    private $nombre;
    private $apellido;
    private $username;
    private $pass;
    private $mail;
    private $fecha_registro;


    public function __construct($id_usuario, $nombre, $apellido, $username, $pass, $mail, $fecha_registro)
    {   
        $this->setId_usuario($id_usuario);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setUsername($username);
        $this->setPass($pass);
        $this->setMail($mail);
        $this->setFecha_registro($fecha_registro);
    }



    public function validarRegistro()
    {

        require("./modelo/config.php");

        $errors = array();


        $user_check_query = "SELECT * FROM usuario WHERE username='" . $this->getUsername() . "' OR mail='" . $this->getMail() . "'";
        $result = $conn->query($user_check_query) or die("Hubo un error al ejecutar la consulta <br>" . mysqli_error($conn));
        $user = mysqli_fetch_assoc($result);
        $conn->close();


        if ($user) { // si el usuario existe
            if ($user['username'] == $this->getUsername()) {
                array_push($errors, "El nombre de usuario ya está tomado.");
            }

            if ($user['mail'] == $this->getMail()) {
                array_push($errors, "Ya existe una cuenta asociada a este email.");
            }
        }

        if (count($errors) == 0) {
            return false;
        }

        return $errors;
    }


    public function validarSesion()
    {
        require("./modelo/config.php");

        $password = md5($this->getPass());

        $user_check_query = "SELECT * FROM usuario WHERE username='" . $this->getUsername() . "'";
        $result = $conn->query($user_check_query) or die("Hubo un error al ejecutar la consulta <br>" . mysqli_error($conn));
        $user = mysqli_fetch_assoc($result);
        $conn->close();

        if ($user == null || $user == "") { // si el usuario no existe
            return "El usuario no está registrado. <a href=\"./?pag=registrar\" class=\"alert-link\">¿Desea registrarse?</a>";
        } else {
            if ($user['pass'] != $password) {
                return "La contraseña no es correcta.";
            }
        }
        $this->setId_usuario($user['id_usuario']);
        $this->setNombre($user['nombre']);
        $this->setApellido($user['apellido']);
        $this->setMail($user['mail']);
        $this->setFecha_registro($user['fecha_registro']);


        return false;
    }




    public function registrar()
    {

        require("./modelo/config.php");

        $pass = md5($this->getPass()); //almacenamos la contraseña encriptada en la BD


        $sql = "INSERT INTO usuario (nombre, 
        apellido, username, pass, mail, fecha_registro) VALUES
        ('" . $this->getNombre() .  "', 
         '" . $this->getApellido() . "',
         '" . $this->getUsername() . "',
         '" . $pass . "',
        '" . $this->getMail() . "',
        '" . $this->getFecha_registro() . "')";

        $conn->query($sql) or die("Hubo un error al ingresar datos <br>" . mysqli_error($conn));
        $conn->close();

        echo "<div class=\"alert alert-success alerta-registro mx-auto\" role=\"alert\">" .
            "<h4 class=\"alert-heading\">Usuario Registrado Exitosamente!</h4>" .
            "<p>Por favor, diríjase a <a href=\"./\" class=\"alert-link\">Home</a> para iniciar su sesión.</p>" .
            "<hr>" .
            "<p class=\"mb-0\">Gracias por utilizar nuestro sistema de mensajería cifrada.</p>" .
            "</div>";

    }


    public static function enviarMensaje($mensaje)
    {
        require("config.php");

        $sql = "INSERT INTO mensaje (descripcion, 
        id_autor, id_destinatario, desplazamiento) VALUES
        ('" . $mensaje->getDescripcion() .  "', 
         '" . $mensaje->getIdAutor() . "',
         '" . $mensaje->getIdDestinatario() . "',
         '" . $mensaje->getDesplazamiento() . "')";

        $conn->query($sql) or die("Hubo un error al enviar el mensaje <br>" . mysqli_error($conn));
        $conn->close();

    }


    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }


    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getPass()
    {
        return $this->pass;
    }


    public function setPass($pass)
    {
        $this->pass = $pass;
    }


    public function getMail()
    {
        return $this->mail;
    }


    public function setMail($mail)
    {
        $this->mail = $mail;
    }


    public function getFecha_registro()
    {
        return $this->fecha_registro;
    }


    public function setFecha_registro($fecha_registro)
    {
        $this->fecha_registro = $fecha_registro;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
}
