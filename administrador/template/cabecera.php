<?php
session_start();
if(isset($_SESSION['usuario'])){
  if($_SESSION['usuario'] == 0){
    header("Location:../index.php");
  }else{
    $name = $_SESSION['name'];
  }
}else{
  echo "Usted no esta autorizado";
  die();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>ADMINISTRADOR</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
  
      <?php $url="http://".$_SERVER['HTTP_HOST']?>

      <nav class="navbar navbar-expand navbar-expand-lg navbar-light bg-light"style="background-color: #e3f2fd;" >
      <div class="nav navbar-nav">
          <a class="nav-item nav-link active" href="#">Administrador de sitio web <span class="sr-only"></span></a>
          <a class="nav-item nav-link" href="<?php echo $url."/administrador/inicio.php"?>">Inicio</a>
          <a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/productos.php"?>">Productos</a>
          <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver sitio web</a>
          <a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/cerrar.php"?>">Cerrar sesión</a>
      </div>
  </nav>

<div class="container">
    <br>
    <div class="row">