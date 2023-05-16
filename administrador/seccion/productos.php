<?php include("../template/cabecera.php");?>
 <?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtfecha=(isset($_POST['txtfecha']))?$_POST['txtfecha']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtimagen=(isset($_FILES['txtimagen']['name']))?$_FILES['txtimagen']['name']:"";
$txtcantidad=(isset($_POST['txtcantidad']))?$_POST['txtcantidad']:"";
$txtprecio=(isset($_POST['txtprecio']))?$_POST['txtprecio']:"";
$txtcategoria=(isset($_POST['txtcategoria']))?$_POST['txtcategoria']:"";
$txtfechaexp=(isset($_POST['txtfechaexp']))?$_POST['txtfechaexp']:"";
$txtdescripcion=(isset($_POST['txtdescripcion']))?$_POST['txtdescripcion']:"";
$txtbeneficios=(isset($_POST['txtbeneficios']))?$_POST['txtbeneficios']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
include("../config/bd.php");

switch($accion){
    case"Agregar":
    $sentenciaSQL=$conexion->prepare("INSERT INTO productos (fecha,nombre,imagen,cantidad,precio,categoria,fechaexp,descripcion,beneficios ) VALUES (:fecha,:nombre,:imagen,:cantidad,:precio,:categoria,:fechaexp,:descripcion,:beneficios);");
    $sentenciaSQL->bindParam(':fecha',$txtfecha);
    $sentenciaSQL->bindParam(':nombre',$txtNombre);

    $fecha=new DateTime();
    $nombreArchivo=($txtimagen!="")?$fecha->getTimestamp()."_".$_FILES["txtimagen"]["name"]:"imagen.jpg";
    
    $tmpimagen=$_FILES["txtimagen"]["tmp_name"];

    if($tmpimagen!=""){
        move_uploaded_file($tmpimagen,"../../img/".$nombreArchivo);
    }

    $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
    $sentenciaSQL->bindParam(':cantidad',$txtcantidad);
    $sentenciaSQL->bindParam(':precio',$txtprecio);
    $sentenciaSQL->bindParam(':categoria',$txtcategoria);
    $sentenciaSQL->bindParam(':fechaexp',$txtfechaexp);
    $sentenciaSQL->bindParam(':descripcion',$txtdescripcion);
    $sentenciaSQL->bindParam(':beneficios',$txtbeneficios);
    $sentenciaSQL->execute();
    header("Location:productos.php");
    break;

    case"Modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE productos SET fecha=:fecha,nombre=:nombre,cantidad=:cantidad,precio=:precio,categoria=:categoria,fechaexp=:fechaexp,descripcion=:descripcion,beneficios=:beneficios WHERE id=:id");
        $sentenciaSQL->bindParam(':fecha',$txtfecha);
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':cantidad',$txtcantidad);
        $sentenciaSQL->bindParam(':precio',$txtprecio);
        $sentenciaSQL->bindParam(':categoria',$txtcategoria);
        $sentenciaSQL->bindParam(':fechaexp',$txtfechaexp);
        $sentenciaSQL->bindParam(':descripcion',$txtdescripcion);
        $sentenciaSQL->bindParam(':beneficios',$txtbeneficios);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

         if($txtimagen!=""){
            $fecha=new DateTime();
            $nombreArchivo=($txtimagen!="")?$fecha->getTimestamp()."_".$_FILES["txtimagen"]["name"]:"imagen.jpg";
            
            $tmpimagen=$_FILES["txtimagen"]["tmp_name"];

            move_uploaded_file($tmpimagen,"../../img/".$nombreArchivo);
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
            if(isset($lista["imagen"])&& ($lista["imagen"]!="imagen.jpg")){
                 
                if(file_exists("../../img/".$lista["imagen"])){
                    unlink("../../img/".$lista["imagen"]);
                }
            }

        $sentenciaSQL= $conexion->prepare("UPDATE productos SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        
         }
         header("Location:productos.php");

    
    break;
    case"Cancelar":
        header("Location:productos.php");
    break;
    case"Seleccionar":
    $sentenciaSQL= $conexion->prepare("SELECT * FROM productos WHERE id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    $txtfecha=$lista['fecha'];
    $txtNombre=$lista['nombre'];
    $txtimagen=$lista['imagen'];
    $txtcantidad=$lista['cantidad'];
    $txtprecio=$lista['precio'];
    $txtcategoria=$lista['categoria'];
    $txtfechaexp=$lista['fechaexp'];
    $txtdescripcion=$lista['descripcion'];
    $txtbeneficios=$lista['beneficios'];
    //echo"Presionado boton Seleccionar";
    break;
    case "Borrar":

        $sentenciaSQL= $conexion->prepare("SELECT imagen FROM productos WHERE id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $lista=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if(isset($lista["imagen"])&& ($lista["imagen"]!="imagen.jpg")){
         
        if(file_exists("../../img/".$lista["imagen"])){
            unlink("../../img/".$lista["imagen"]);
        }
    }

           $sentenciaSQL= $conexion->prepare("DELETE FROM productos WHERE id=:id");
           $sentenciaSQL->bindParam(':id',$txtID);
           $sentenciaSQL->execute();
           header("Location:productos.php");
          
    //echo"Presionado boton Borrar";
           break;
}
$sentenciaSQL=$conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listadeproductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

 ?>

<div class="col-md-7" >
    <div class="card">
        <div class="card-header">
            Datos de productos
        </div>
        <div class="card-body">
        <table >
    <form method="POST" enctype="multipart/form-data">
        <thead>
            <tr>
                <th><div class = "form-group">
    <label for="txtID">ID</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtID?>" name="txtID" id="txtID"  placeholder="Identificacion">
    </div></th>
                <th><div class = "form-group">
    <label for="stark">Fecha de ingreso:</label>
    <input type="date" required class="form-control"  value="<?php echo $txtfecha?>" name="txtfecha" id="txtfecha"  placeholder="Fecha de ingreso">
     </div></th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                
                <th> <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre?> "name="txtNombre" id="txtNombre"  placeholder="Nombre">
    </div></th>
                <th><div class = "form-group">
    <label for="txtimagen">Imagen:</label>

    <?php if($txtimagen!=""){ ?>
            <img class="img-thumbnail rounded" src="../../img/<?php echo $txtimagen?>" width="50" alt="" srcset="">
                
    <?php } ?>

    <input type="file" class="form-control" name="txtimagen" id="txtimamgen"  placeholder="Nombre">
    

    </div></th>
            </tr>
            <tr>
              
                <th><div class = "form-group">
    <label for="txtNombre">Cantidad</label>
    <input type="number" required class="form-control" value="<?php echo $txtcantidad?>" name="txtcantidad" value="1" min="0"max="100" id="txtcantidad"  placeholder="Cantidad">
    </div></th>
                <th><div class = "form-group">
    <label for="txtNombre">Precio del producto:</label>
    <input type="number" required class="form-control" value="<?php echo $txtprecio?>" name="txtprecio"  id="txtprecio"  placeholder="Precio">
    </div></th>
            </tr>
        </tbody>
        <thead>
            <tbody>
                <tr>
                <th><div class = "form-group">
    <label for="txtNombre">Categoria</label>
    <input type="text" required class="form-control" value="<?php echo $txtcategoria?>"name="txtcategoria"  id="txtcategoria"  placeholder="Categoria">
    </div></th>
                    <th><div class = "form-group">
    <label for="stark">Fecha de caducidad</label>
    <input type="date" required class="form-control" value="<?php echo $txtfechaexp?>" name="txtfechaexp"  id="txtfechaexp"  placeholder="fecha">
    </div></th>
    
    </thead>
     </tbody>
     <th><div class = "form-group">
    <label for="txtNombre">Descripción del producto:</label>
    <textarea required class="form-control"  name="txtdescripcion" id="txtdescripcion" rows="5" cols="50" placeholder="Descripción" ></textarea>
    <?php echo $txtdescripcion?>
</div></th>
<th><div class = "form-group">
    <label for="txtNombre">Beneficios del producto:</label>
    <textarea required class="form-control"  name="txtbeneficios" id="txtbeneficios" rows="5" cols="50" placeholder="Beneficios" ></textarea>
    <?php echo $txtbeneficios?>
</div></th>
    </table>

    <div class="btn-group" role="group" aria-label="">
        <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"";?>value="Agregar"class="btn btn-primary">Agregar</button>
        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"";?> value="Modificar"class="btn btn-success">Modificar</button>
        <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"";?>value="Cancelar"class="btn btn-danger">Cancelar</button>
    </div>


    </form>
        </div>
        
    </div>
    
</div>

<div class="col-md-9">
<br><br>
    <table class="table-bordered" id="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de ingreso</Nth>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Cantidad</th>
                <th>Precio del producto</th>
                <th>Categoria</th>
                <th>Fecha de caducidad</th>
                <th>Descripción del producto</th>
                <th>Beneficios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listadeproductos as $producto){?>
            <tr>
                <td><?php echo $producto['id']?></td>
                <td><?php echo $producto['fecha']?></td>
                <td><?php echo $producto['nombre']?></td>

                <td>
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $producto['imagen']?>" width="50" alt="" srcset="">
                </td>
                <td><?php echo $producto['cantidad']?></td>
                <td><?php echo $producto['precio']?></td>
                <td><?php echo $producto['categoria']?></td>
                <td><?php echo $producto['fechaexp']?></td>
                <td><?php echo $producto['descripcion']?></td>
                <td><?php echo $producto['beneficios']?></td>
                <td>
                    
                <form method="POST">
                    <input type="hidden" name="txtID" id="txtID"value="<?php echo $producto["id"]?>"/>
                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-warning"/>
                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
            </form>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>

<script>
    var tabla = document.querySelector("#tabla");
    var dataTable = new DataTable(tabla, {
        perPage:1,
        perPageSelect:[1,3,6,9,12]
    })
</script>

<?php include("../template/pie.php");?>