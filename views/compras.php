<?php include("header.php"); ?>

<?php

  $compra="display:none";

  if(isset($_GET["compra"])){
    $compra="display:block";
  }

?>

  <section class="wrapper">
    <div class="container p-4">
      <div class="row">
        <div class="col-md-12">
          <div style="<?= $compra ?>" class="alert alert-success alert-dismissible fade show" role="alert">
            Venta ingresada correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <nav class="navbar navbar-light bg-light">
            <h4></h4>
            <form class="form-inline">
              <a class="btn btn-success my-2 my-sm-0" href="nuevaCompra.php">Ingresar</a>
            </form>
          </nav>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Compra</th>
                        <th>Producto</th>
                        <th>Proveedor</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Iva</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    require "../models/compras.php";

                    $compras=compras::getLista();
                    foreach ($compras as $row) {?>
                      <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["nombre"]; ?></td>
                        <td><?php echo $row["proveedor"]; ?></td>
                        <td><?php echo $row["cantidad"]; ?></td>
                        <td>$<?php echo $row["subtotal"]; ?></td>
                        <td>$<?php echo $row["iva"]; ?></td>
                        <td>$<?php echo $row["total"]; ?></td>
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
      var menu=document.getElementById("compras");
      menu.className="active";
  </script>
<?php include("footer.php"); ?>
