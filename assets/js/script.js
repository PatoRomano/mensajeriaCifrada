////////////////////////////////////////////////////
//////////////// F U N C I O N E S /////////////////
////////////////////////////////////////////////////



function ObtenerXHR() {
    req = false;
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else {
        if (window.ActiveXObject) {
            req = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return req;
}

function muestroUsuarios() {
    var peticion = ObtenerXHR();
    peticion.open("GET", "./modelo/generarJsonUsuarios.php", true);
    peticion.onreadystatechange = cargoUsuarios;
    peticion.send(null);

    function cargoUsuarios() {
        var parrafo = document.getElementById("id_destinatario");
        if (peticion.readyState == 4) {
            if (peticion.status == 200) {
                usuarios = "";
                jsonUsuarios = JSON.parse(peticion.responseText);
                var count = Object.keys(jsonUsuarios).length;  //anteriormente, en el Integrador 3, funcionaba directamente utilizando jsonUsuarios.lenght pero tuvo que ser reemplazado por la línea de codigo en cuestión, para que no de "Undefined".
                for (i = 0; i < count; i++) {
                    usuarios += "<option value=" + jsonUsuarios[i].id_usuario + ">" + jsonUsuarios[i].nombre + " " + jsonUsuarios[i].apellido + " - " + jsonUsuarios[i].username + "</option>";
                }
                parrafo.innerHTML = usuarios;
            }
        }
    }

}

function muestroMensajes(tipoDeMensaje) {
    if (tipoDeMensaje == null) {
        tipoDeMensaje = 'enviados';
    }
    var peticion = ObtenerXHR();
    peticion.open("GET", "./modelo/generarJsonMensajes.php?tipoDeMensaje=" + tipoDeMensaje, true);
    peticion.onreadystatechange = cargoMensajes;
    peticion.send(null);


    function cargoMensajes() {
        if (tipoDeMensaje == "enviados") {
            var parrafo = document.getElementById("mensajes-enviados");
        } else if (tipoDeMensaje == "recibidos") {
            var parrafo = document.getElementById("mensajes-recibidos");
        }

        if (peticion.readyState == 4) {
            if (peticion.status == 200) {
                mensaje = "";
                jsonMensajes = JSON.parse(peticion.responseText);
                var count = Object.keys(jsonMensajes).length;  //anteriormente, en otros casos, funcionaba directamente utilizando jsonMensajes.lenght pero tuvo que ser reemplazado por la línea de codigo en cuestión, para que no devuelva "Undefined".
                for (i = 0; i < count; i++) {

                    mensaje += "<tr class=\"text-light\">" +
                        "<td>" + jsonMensajes[i].descripcion + "</td>" +
                        "<td>" + jsonMensajes[i].username + "</td>" +
                        "<td><button class=\"btn btn-outline-primary shadow-sm\" onclick=\"leerMensaje('" + jsonMensajes[i].descripcion + "'," + jsonMensajes[i].desplazamiento + ")\">Leer</button></td>" +
                        "<td>" + jsonMensajes[i].fecha_envio + "</td>" +
                        "</tr>";
                }
                parrafo.innerHTML = mensaje;
            }
        }
    }

}


function controlarBotonesNavbar() {
    botonCerrarSesion = document.getElementById("btn-nav-cerrar-sesion");
    botonCerrarSesion.innerHTML = "<form action=\"controlador/controlSesion.php\" method=\"post\">" +
        "<button type=\"submit\" class=\"btn btn-primary my-auto mx-auto shadow\" name=\"cerrarSesion\">Cerrar Sesión</button>" +
        "</form>";

    botonHome = document.getElementById("btn-nav-home");
    botonHome.setAttribute('class', 'd-none');
}


function cifrarMensaje(mAux, dAux) {

    var letras = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
    var cantLetras = letras.length;
    var desplazamientoMax = cantLetras - 1;

    
    // obtengo el campo de descripción cifrada
    var descripcionCifrada = document.getElementById('descripcion-cifrada');

    //
    // Métodos
    //


    if (mAux != null && dAux != null) {
        cesar();
    }


    function desplazarCaracter(char, desplazamiento) {

        // Obtener el índice del caracter a cifrar en el vector letras
        var i = letras.indexOf(char.toLowerCase());


        // si no es un caracter contenido en el vector letras, se retorna sin desplazar
        if (i < 0) {
            return char;
        }

        // obtener el índice desplazado
        var iDesplazado = parseInt(desplazamiento) + parseInt(i);

        // si el índice desplazado es mayor que el desplazamiento máximo, comenzar al inicio
        if (iDesplazado > desplazamientoMax) {
            iDesplazado = iDesplazado - cantLetras;
        }

        // si el índice desplazado es menor que cero, comenzar al final
        if (iDesplazado < 0) {
            iDesplazado = iDesplazado + cantLetras;
        }

        // devuelve el caracter desplazado
        return letras[iDesplazado];

    };

    // se recibe el mensaje y el desplazamiento, se divide el mensaje caracter por caracter, se desplaza cada uno y se vuelven a unir
    function desplazarMensaje(mensaje, desplazamiento) {
        return mensaje.split('').map(function (char) {
            return desplazarCaracter(char, desplazamiento);
        }).join('');
    };

// Se encripta el mensaje

    function cesar() {

        // Obtengo el valor de desplazamiento
        var desplazamiento = document.getElementById('desplazamiento').value;


        hola = document.getElementById('hola').innerHTML;
        holaCifrado = desplazarMensaje(hola, desplazamiento);
        document.getElementById('hola-cifrado').innerHTML = holaCifrado;

        //Si la funcion recibió parámetros de entrada, se asignan los valores recibidos al mensaje y el desplazamiento
        var descripcion = document.getElementById('descripcion').value;
        if (dAux != null & mAux != null) {
            desplazamiento = dAux;
            descripcion = mAux;
        }

        // Encripto el mensaje y lo almaceno en una variable
        var mensajeCifrado = desplazarMensaje(descripcion, desplazamiento);


        // Se analiza si se quiere encriptar o desencriptar un mensaje, si la función cifrarMensaje NO ha recibido parámetros, se encriptará el mensaje
        // si la funcion cifrarMensaje ha recibido parametros, se aplicará el cifrado a la inversa, para descifrar el mensaje otorgado
        if (desplazamiento == dAux && descripcion == mAux) {
            document.getElementById('p-mensaje-descifrado').innerHTML = mensajeCifrado;
        } else {
            descripcionCifrada.value = mensajeCifrado;
        }
    };

    cesar();

}


function contarCaracteres() {
    limite = 150;
    caracteres = document.getElementById('caracteres');
    texto = document.getElementById('descripcion').value.length;
    cantidadActual = limite - texto;
    caracteres.innerHTML = cantidadActual;
}


function enviarMensaje() {
    id_autor = document.getElementById('id_autor').value;
    id_destinatario = document.getElementById('id_destinatario').value;
    descripcion = document.getElementById('descripcion-cifrada').value;
    desplazamiento = document.getElementById('desplazamiento').value;

    mensaje = document.getElementById('descripcion').value;

    if (desplazamiento == null || desplazamiento == "") {
        document.getElementById('alerta-mensaje').innerHTML = "<div class=\"alert alert-danger mx-auto\" role=\"alert\">" +
        "<p class=\"alert-heading\">Debes indicar un desplazamiento.</p>" +
        "</div>";
    } else if (mensaje == null || mensaje == ""){
        document.getElementById('alerta-mensaje').innerHTML = "<div class=\"alert alert-danger mx-auto\" role=\"alert\">" +
        "<p class=\"alert-heading\">Debes redactar un mensaje.</p>" +
        "</div>";
    } else {
        var peticion = ObtenerXHR();
        peticion.open("POST", "./controlador/controlMensajes.php?id_autor=" + id_autor + "&id_destinatario=" + id_destinatario + "&descripcion=" + descripcion + "&desplazamiento=" + desplazamiento, true);
        peticion.onreadystatechange = verificarEnvioMensaje;
        peticion.send(null);
    }

    function verificarEnvioMensaje() {

        if (peticion.readyState == 4) {
            if (peticion.status == 200) {
                limpiarCampos();
                mostrarAlertaMensaje();
            }
        }
    }
}


function quitarAlertaMensaje() {
    document.getElementById('alerta-mensaje').innerHTML = "";
}


function limpiarCampos() {
    formularioMensaje = document.getElementById('formulario-mensaje');
    formularioMensaje.reset();
    document.getElementById('hola-cifrado').innerHTML = "";
    document.getElementById('caracteres').innerHTML = 150;
}

function mostrarAlertaMensaje() {
    document.getElementById('alerta-mensaje').innerHTML = "<div class=\"alert alert-success mx-auto\" role=\"alert\">" +
        "<p class=\"alert-heading\">Mensaje Enviado!</p>" +
        "</div>";
}

function leerMensaje(mensaje, desplazamiento) {
    cajitaMensaje = document.getElementById('p-mensaje-descifrado');
    cifrarMensaje(mensaje, desplazamiento * (-1));
    $("#modal-mensaje").modal('show');

}