<?php

  $nombre="";
  $tipo="";
  $cantidad=0;
  $cantidad_min=0;
  $precio=0;
  $id=0;

  //Obtiene los datos del producto seleccionado a traves del id por el metodo get
  if(isset($_GET["id"])){
    require "../models/productos.php";

    $producto=productos::getById($_GET["id"]);

    $nombre=$producto["nombre"];
    $tipo=$producto["tipo"];
    $cantidad=$producto["cantidad"];
    $cantidad_min=$producto["cantidad_min"];
    $precio=$producto["precio"];
    $id=$producto["id"];
  }

?>

<?php include("header.php"); ?>

<section class="wrapper">
<div class="container p-4">
      <div class="row">
          <div class="col-md-12">
              <div class="card card-body p-3">
                  <form action="../controllers/productosController.php" method="POST">
                    <div class="form-group" style="display:none;">
                        <input type="text" name="id" value="<?= $id; ?>" class="form-control" placeholder="Id" autofocus/>
                    </div>
                      <div class="form-group">
                          <input type="text" name="nombre" value="<?= $nombre; ?>" class="form-control" placeholder="Nombre" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="text" name="tipo" value="<?= $tipo; ?>" class="form-control" placeholder="Tipo" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="number" name="cantidad" value="<?= $cantidad; ?>" class="form-control" placeholder="Cantidad" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="number" name="cantidad_min" value="<?= $cantidad_min; ?>" class="form-control" placeholder="Cantidad minima" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="number" step="any" name="precio" value="<?= $precio; ?>" class="form-control" placeholder="Precio" autofocus/>
                      </div>
                      <input type="submit" class="btn btn-success btn-block" name="actualizar" value="Actualizar">
                  </form>
              </div>
          </div>
        </div>
      </div>
    </section>

    <script>
        var menu=document.getElementById("productos");
        menu.className="active";
    </script>

  <?php include("footer.php"); ?>
