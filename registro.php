<?php include("template/cabecera.php");

include("administrador/config/bd.php");
session_start();
if (isset($_POST['Registrar'])) {
    $email="";
    $password ="";
    $password_repeat="";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password-repeat'];
    
    if($email != "" && $password !="" && $password_repeat != ""){
        if ($password != $password_repeat){
            $mensaje="Error: las contraseñas no coinciden";
        }else {
            $squery = $conexion->prepare("INSERT INTO `cliente`(`email`, `password`) VALUES (:email, :password)");
            $squery->bindParam(':email', $email);
            $squery->bindParam(':password', $password);
            $squery->execute();
            header("Location:login.php");
        }
    } else {
            $mensaje="Error: Los campos estan vacios";
    };
};
?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ganoderma</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="css/Navigation-with-Search.css">
    <link rel="stylesheet" href="css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <section class="register-photo">
        <div class="form-container">
            <div data-aos="flip-left" data-aos-duration="100" data-aos-delay="50" data-aos-once="true"
                class="image-holder" style="background: url(&quot;img/ganoderma_1.jpg&quot;) center / cover no-repeat;">
            </div>
            <form method="post">
                <?php if(isset($mensaje)) {?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $mensaje; ?>
                </div>
                <?php }?>
                <h2 class="text-center"><strong>Crear</strong>&nbsp;una cuenta.</h2>
                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Correo"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Contraseña">
                </div>
                <div class="mb-3"><input class="form-control" type="password" name="password-repeat"
                        placeholder="Contraseña (repeat)"></div>
                <div class="mb-3">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input"
                                type="checkbox">Acepto los terminos de la licencia.</label></div>
                </div>
                <div class="mb-3"><button name="Registrar" class="btn btn-primary d-block w-100"
                        type="submit">Registrarse</button></div><a class="already" href="login.php">Tienes una cuenta? Ingresa
                    aqui.</a>
            </form>
        </div>
    </section>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</body>

</html>
<?php include("template/pie.php");?>