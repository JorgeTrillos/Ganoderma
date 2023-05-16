
<!DOCTYPE html>
<html lang="en">

<?php

include("administrador/config/bd.php");
session_start();
if (isset($_POST['iniciar_sesion'])) {

    
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $query = $conexion->prepare("SELECT * FROM cliente WHERE email=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        $mensaje="Error: No se encontro ningun usuario con este email.";
    } else {
        if ($password == $result['password']) {
            header("Location:index.php");
        }else{
            $mensaje = "Error: Error en los datos.";
        }
    }
}




?>
<?php include("template/cabecera.php");?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="css/Login-Form-Clean.css">
    <link rel="stylesheet" href="css/styles.css">
    
</head>

<body>
    <section class="login-clean">
        <div class="card-body">
            

            <form data-aos="fade-right" data-aos-duration="300" data-aos-delay="200" method="post"
                style="border-radius: 15px;">
                <?php if(isset($mensaje)) {?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $mensaje; ?>
                </div>
                <?php }?>
                <h2 class="visually-hidden">Login Form</h2>
                <div class="illustration" style="font-size: 54px;margin: 3px;height: 107.8px;"><label
                        class="form-label bounce animated"
                        style="font-size: 40px;font-weight: bold;color: rgb(255,133,44);height: 72px;width: 104.012px;padding: 0px;margin: 0px;border-radius: 0px;transform: scale(1);">Gano</label><label
                        class="form-label jello animated"
                        style="font-size: 40px;color: rgb(88,88,88);font-weight: bold;">derma</label></div>
                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Correo"
                        style="border-radius: 20px;height: 46px;border-width: 3px;"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Contraseña"
                        style="border-radius: 20px;height: 46px;border-width: 3px;"></div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" name="iniciar_sesion" type="submit"
                        style="background: rgb(255,133,44);border-radius: 22px;filter: contrast(99%);">Ingresar</button>
                </div><a class="forgot" href="#">¿Ha olvidado su correo electronico o contraseña?</a>
                <a href="registro.php" style="color: rgb(0,0,0);font-size: 10px;text-align: center;transform: translate(244px) scale(0.74);margin: 51px;" bs-cut="1">No tienes cuenta? Ingresa Aqui</a>
                <a href="administrador/index.php" style="color: rgb(0,0,0);font-size: 10px;text-align: center;transform: translate(244px) scale(0.74);margin: 85px;" bs-cut="1">Admnistrador</a>
            </form>
           
    </section>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>
<?php include("template/pie.php");?>