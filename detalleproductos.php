<?php include("template/cabecera.php");?>
<?php 
include("administrador/config/bd.php");
include("administrador/config/config.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listadeproductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<?php foreach($listadeproductos as $producto){
    
$id = isset($_GET['id']) ? $_GET['id']: '';
$token = isset($_GET['token']) ? $_GET['token'] : ' ';



if($id == '' || $token == ''){
echo '<div class="alert alert-warning">
    <strong>Dirección no encontrada!</strong> <a href="productos.php" class="btn btn-warning">REGRESAR</a>
    </div>';
 exit;
} else{
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if($token == $token_tmp){
        $sentenciaSQL=$conexion->prepare("SELECT count(id) FROM productos WHERE id=? ");
        $sentenciaSQL->execute([$id]);
        if($sentenciaSQL->fetchColumn() > 0) {
           
            $sentenciaSQL=$conexion->prepare("SELECT fecha, nombre, imagen, cantidad, precio, categoria, fechaexp, descripcion, beneficios  FROM productos WHERE id=? ");
            $sentenciaSQL->execute([$id]);
            $producto = $sentenciaSQL ->fetch(PDO::FETCH_ASSOC);
            $fecha = $producto['fecha'];
            $nombre = $producto['nombre'];
            $imagen = $producto['imagen'];
            $cantidad = $producto['cantidad'];
            $precio = $producto['precio'];
            $categoria = $producto['categoria'];
            $fechaexp = $producto['fechaexp'];
            $descripcion = $producto['descripcion'];
            $beneficios = $producto['beneficios'];
            
        }
      
    }else {
       echo '<div class="alert alert-warning">
    <strong>Dirección no encontrada!</strong> <a href="productos.php" class="btn btn-warning">REGRESAR</a>
    </div>';
        exit;
    }
}
?>




<?php } ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-1">
            
                <img class="card-img-top" src="./img/<?php echo $producto['imagen']?>" alt="">
                 <div class="card-body-center">
                     <br>
                     <button type="button" class="btn btn-outline-primary btn-md ">COMPRAR</button>
                     <buton type="button" class="btn btn-outline-success btn-block">Añadir al Carrito</button>
                    
                 </div>
            
       </div>
        
       <div class="col-md-6 order-md-3">
           <br>
        <h2><?php echo $producto['nombre']?> <?php echo "(".$producto['categoria'].")"?></h2>
        <h2> <?php echo MONEDA . $precio ." pesos"?></h2>
        <br>
        <tr>
            <td><h5><?php echo "Cantidad disponible: ".$producto['cantidad']?></h5></td>
        </tr>  
        <br>
        <tr>
        <h3>DESCRIPCION </h3>
        <mark> <?php echo $descripcion ?></mark> 
        <br><br>
        <h3>BENEFICIOS</h3>
        <ol><?php echo $producto['beneficios']?></ol>
        </tr>
        
        <tr>       
           <h6><?php echo "Fecha de ingreso: ".$producto['fecha']?></h6>
            
        </tr>   
        <tr>
            <h6><?php echo " Fecha de vencimiento: " .$producto['fechaexp']?></h6>
        </tr>
        <tr>
            
        </tr>
       </div>
    </div>
 <?php include("template/pie.php");?>