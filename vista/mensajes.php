<?php
require('controlador/controlSesion.php');
require('modelo/User.php');
session_start();

if (!(isset($_SESSION['usuario']))) {
    header('Location: ./');
    die();
}

?>

<head>
    <script src="./assets/js/script.js"></script>
</head>

<body onload="muestroUsuarios();muestroMensajes();controlarBotonesNavbar()" class="mt-5">

    <section>
        <div class="text-center mt-5">
            <h1 class="display-1 pt-5">Cifrado Cesar</h1>
            <h3 class="display-5 pt-2 mb-5">Bienvenido <?php echo $_SESSION['usuario']->getNombre(); ?>!</h3>
        </div>
    </section>

    <div class="container my-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <button class="nav-link active" id=nav-enviados-tab data-bs-toggle="tab" data-bs-target="#nav-enviados" type="button" role="tab" aria-controls="nav-enviados" aria-selected="true" onclick="muestroMensajes('enviados')">Enviados</button>

                <button class="nav-link" id=nav-recibidos-tab data-bs-toggle="tab" data-bs-target="#nav-recibidos" type="button" role="tab" aria-controls="nav-recibidos" aria-selected="false" onclick="muestroMensajes('recibidos')">Recibidos</button>

                <button class="nav-link" id=nav-contacto2-tab data-bs-toggle="tab" data-bs-target="#nav-contacto2" type="button" role="tab" aria-controls="nav-contacto2" aria-selected="false" onclick="quitarAlertaMensaje()">Nuevo Mensaje</button>

            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active p-3" id="nav-enviados" role="tabpanel" aria-labelledby="nav-enviados-tab">
                <h2>Enviados</h2>
                <table class="table">
                    <thead class="text-light">
                        <tr>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Destinatario</th>
                            <th scope="col">----</th>
                            <th scope="col">Fecha Envio</th>
                        </tr>
                    </thead>
                    <tbody id="mensajes-enviados">

                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade show p-3" id="nav-recibidos" role="tabpanel" aria-labelledby="nav-recibidos-tab">
                <h2>Recibidos</h2>
                <table class="table">
                    <thead class="text-light">
                        <tr>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Emisor</th>
                            <th scope="col">----</th>
                            <th scope="col">Fecha Envio</th>
                        </tr>
                    </thead>
                    <tbody id="mensajes-recibidos">

                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade p-3" id="nav-contacto2" role="tabpanel" aria-labelledby="nav-contacto2-tab">
                <form id="formulario-mensaje">
                    <h2>Redactar Mensaje</h2>
                    <input type="hidden" name="id_autor" id="id_autor" value="<?php echo $_SESSION['usuario']->getId_usuario(); ?>">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="select-usuarios">@</label>
                        <select class="form-select" id="id_destinatario" name="id_destinatario">
                            
                        </select>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Desplazamiento de Cifrado</span>
                        <input required type="number" id="desplazamiento" name="desplazamiento" class="form-control" min="1" max="35" placeholder="Desplazamiento" aria-label="Desplazamiento" aria-describedby="basic-addon1" onkeyup="cifrarMensaje()">
                    </div>
                    <small>Texto de ejemplo:</small> <small id="hola">Hola159</small><small> | Texto cifrado: </small><small id="hola-cifrado"></small>
                    <br> <br>
                    <div class="input-group">
                        <span class="input-group-text">Mensaje</span>
                        <input required class="run form-control" aria-label="Mensaje" maxlength="150" id="descripcion" name="descripcion" onkeyup="cifrarMensaje();contarCaracteres()"/><br>
                    </div>
                    <small>El mensaje tiene un límite de </small><small id="caracteres">150</small> <small> caracteres.</small>
                    <br>
                    <div class="input-group mt-4">
                        <span class="input-group-text">Cifrado</span>
                        <textarea class="form-control" aria-label="Mensaje" id="descripcion-cifrada" name="descripcion-cifrada" readonly></textarea><br>
                    </div>
                    <br>
                    <div id="alerta-mensaje">

                    </div>
                    <div class="text-center">
                        <input type="button" value="Enviar" class="btn btn-primary mt-5 col-4" name="btn-enviar-mensaje" onclick="enviarMensaje();" />
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal" tabindex="-1" id="modal-mensaje">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Mensaje Descifrado</h5>
                    <button type="button" class="btn-close rounded-5 bg-light me-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="p-mensaje-descifrado"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>