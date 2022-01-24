<?php

  $nombre="";

  //Obtiene los datos del producto seleccionado a traves del id por el metodo get
  if(isset($_GET["id"])){
    require "../models/proveedores.php";

    $producto=proveedores::getById($_GET["id"]);

    $nombre=$producto["nombre"];
    $id=$producto["id"];
  }

?>

<?php include("header.php"); ?>

<section class="wrapper">
<div class="container p-4">
      <div class="row">
          <div class="col-md-12">
              <div class="card card-body p-3">
                  <form action="../controllers/proveedoresController.php" method="POST">
                    <div class="form-group" style="display:none;">
                        <input type="text" name="id" value="<?= $id; ?>" class="form-control" placeholder="Id" autofocus/>
                    </div>
                      <div class="form-group">
                          <input type="text" name="nombre" value="<?= $nombre; ?>" class="form-control" placeholder="Nombre" autofocus/>
                      </div>
                      <input type="submit" class="btn btn-success btn-block" name="actualizar" value="Actualizar">
                  </form>
              </div>
          </div>
        </div>
      </div>
    </section>

    <script>
        var menu=document.getElementById("proveedores");
        menu.className="active";
    </script>

  <?php include("footer.php"); ?>
