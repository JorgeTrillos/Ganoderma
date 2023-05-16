<?php include("template/cabecera.php");?>
<?php 
include("administrador/config/bd.php");
include("administrador/config/config.php");
$sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listadeproductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<?php foreach($listadeproductos as $producto){

 ?>
<div class="col-sm-6 col-md-3">
<div class="card">
    <img class="card-img-top" src="./img/<?php echo $producto['imagen']?>" alt="">
    <div class="card-body">
        <h4 class="card-title"><?php echo $producto['nombre']?></h4>
        <a href ="detalleproductos.php?id=<?php echo $producto['id']; ?>&token=<?php echo hash_hmac('sha1',$producto['id'],KEY_TOKEN); ?>" class="btn btn-primary"role="button">VER</a>
            
            
    </div>
</div>
</div>
<?php } ?>

<?php include("template/pie.php");?>