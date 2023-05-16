
<?php include("template/cabeceras.php");

include("config/bd.php");
session_start();
if (isset($_POST['login'])) {
 
    $user = $_POST['username'];
    $password = $_POST['password'];
 
    $query = $conexion->prepare("SELECT * FROM usuario_admin WHERE user=:user");
    $query->bindParam("user", $user, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if ($user!=$result){
        $mensaje="Error: El usuario es incorrecto";
        
    }
    
    if($password!=$result) {
        $mensaje="Error: Contraseña es incorrecta";
        
    }if(!$result) {
        $mensaje="Error: El usuario y contraseña son incorrectos";
    }else {
        if ($password == $result['password']) {
            $_SESSION['usuario'] = $result['Admin'];
            $_SESSION['name'] = $result['Nombre'];
            header("Location:inicio.php");
        }
    }
};
 
?>

<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <br>
                <div class="card">
                    <div class="card-header"  >
                        <b>Login Administrador</b>
                        <img class="card-img-top" src="../img/ganoderma_1.jpg" alt="">
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje)) {?>
                        <div class="alert alert-warning" role="alert">


                            <?php echo $mensaje; ?>
                        </div>
                        <?php }?>
                        <form method="POST">
                            <div class="form-group">
                                <label><b>ADMINISTRADOR</b></label>

                                <input type="text" class="form-control" name="username"
                                    placeholder="Nombre Administrador"class="form-controllar" required>
                            </div>

                            <div class="form-group">
                                <label><b>CONTRASEÑA</b></label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Contraseña"class="form-controllar" required>
                            </div>

                            <button name="login" class="btn btn-success" style="text-aling:center;"><b>Ingresar</b></button>
                            <a href='../productos.php'class="btn btn-danger"><b>Cancelar</b></a>

                        </form>


                    </div>

                </div>

            </div>

        </div>
    </div>
</body>


</html>
<?php include("template/pie.php");?>

