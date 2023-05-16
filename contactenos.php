<?php include("template/cabecera.php");?>
<div class="jumbotron text-center">
    <h1 class="display-3">Contactenos</h1>
    <p class="lead">Por favor diligencie el formulario</p>

    <!doctype html>
<html lang="es">
    <!--
        Formulario de contacto con PHP
       
    -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">
        <meta name="description" content="Contacto">
        <meta name="author" content="Parzibyte">
        
        <!-- Cargar el CSS de Boostrap-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body> 
        <!-- Termina la definición del menú -->
       
        <main role="main" class="container">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="contacto.php">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" required type="text" id="nombre"
                                class="form-control" placeholder="Tu nombre completo">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico</label>
                            <input name="correo" required type="email" id="correo"
                                class="form-control" placeholder="Tu correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea required placeholder="Escribe tu mensaje"
                                class="form-control" name="mensaje" id="mensaje"
                                cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn-success btn" type="submit">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
</div>
<?php include("template/pie.php");?>