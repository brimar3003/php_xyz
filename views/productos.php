<?php include("header.php"); ?>

<?php

  //Visibilidad de un mensaje dependiendo de lo que obtenga en el metodo get
  $eliminado="display:none";
  $agregado="display:none";
  $modificado="display:none";

  if(isset($_GET["agregado"])){
    $agregado="display:block";
  }else if(isset($_GET["modificado"])){
    $modificado="display:block";
  }else if(isset($_GET["eliminado"])){
    $eliminado="display:block";
  }

?>

<section class="wrapper">
<div class="container p-4">
      <div class="row">
          <div class="col-md-12">
            <div style="<?= $agregado ?>" class="alert alert-success alert-dismissible fade show" role="alert">
              Producto ingresado correctamente
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div style="<?= $modificado ?>" class="alert alert-warning alert-dismissible fade show" role="alert">
              Producto modificado correctamente
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div style="<?= $eliminado ?>" class="alert alert-danger alert-dismissible fade show" role="alert">
              Producto eliminado correctamente
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="card card-body p-3">
                  <form action="../controllers/productosController.php" method="POST">
                      <div class="form-group">
                          <input type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="text" name="tipo" class="form-control" placeholder="Tipo" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="number" name="cantidad_min" class="form-control" placeholder="Cantidad minima" autofocus/>
                      </div>
                      <div class="form-group">
                        <input type="number" step="any" name="precio" class="form-control" placeholder="Precio" autofocus/>
                      </div>
                      <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar">
                  </form>
              </div>
          </div>
          <div class="col-md-12">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Tipo</th>
                          <th>Cantidad</th>
                          <th>Cant. Minima</th>
                          <th>Precio</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                      require "../models/productos.php";

                      $productos=productos::getLista();
                      foreach ($productos as $row) {?>
                        <tr>
                          <td><?php echo $row["nombre"]; ?></td>
                          <td><?php echo $row["tipo"]; ?></td>
                          <td><?php echo $row["cantidad"]; ?></td>
                          <td><?php echo $row["cantidad_min"]; ?></td>
                          <td><?php echo $row["precio"]; ?></td>
                          <td>
                            <div class="row justify-content-center">
                              <a class="btn btn-info rounded" href="producto.php?id=<?= $row["id"] ?>"><i class="fa fa-edit icon"></i></a>
                              <a class="btn btn-danger rounded" href="../controllers/productosController.php?eliminar=<?= $row["id"] ?>"><i class="fa fa-trash icon"></i></a>
                            </div>
                          </td>
                        </tr>
                    <?php
                      }
                    ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</section>

  <script>
      var menu=document.getElementById("productos");
      menu.className="active";
  </script>

<?php include("footer.php"); ?>
