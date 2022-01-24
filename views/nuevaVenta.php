<?php include("header.php"); ?>

<?php
  require "../models/productos.php";

  $id=0;
  $nombre="";
  $tipo="";
  $cantidad="0";
  $precio="0.00";
  $visible="display:none;";

  //Obtiene los datos del producto que ha sido buscado con el autocomplete
  if(isset($_GET["producto"])){
    $producto=productos::getById($_GET["producto"]);

    if($producto){
      $id=$producto["id"];
      $nombre=$producto["nombre"];
      $tipo=$producto["tipo"];
      $cantidad="0";
      $precio=$producto["precio"];
    }
  }

  //Visibilidad de un mensaje dependiendo de lo que obtenga en el metodo get
  if(isset($_GET["error"])){
    $visible="display:block;";
  }

?>

<section class="wrapper">
<div class="container p-4">
      <div class="row">
          <div class="col-md-12">
            <div style="<?= $visible ?>" class="alert alert-danger alert-dismissible fade show" role="alert">
              No dispone de suficientes unidades para la venta
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="card card-body p-3">
                <form class="form-inline p-3" action="../controllers/ventasController.php" method="POST">
                  <input autocomplete="off" type="text" name="buscar" id="buscar" class="form-control rounded-0 border-info" style="width:80%;" placeholder="Buscar producto..."/>
                  <input type="submit" value="Agregar" name="agregar" class="btn btn-success rounded-0" style="width:20%; height:39px; margin-top:5px;"/>
                </form>
              </div>
              <div class="col-md-5" style="position: relative; margin-top:-47px; margin-left:17px;">
                <div class="list-group" id="lista_productos">

                </div>
              </div>
          </div>
          <div class="col-md-12 mt-5">
            <div class="card card-body p-3">
            <form action="../controllers/ventasController.php" method="POST">
                <div class="form-group"style="display:none;">
                    <input type="text" name="id" style="" class="form-control" value="<?= $id ?>" placeholder="Nombre" autofocus/>
                </div>
                <div class="form-group">
                    <input type="text" name="nombre" disabled class="form-control" value="<?= $nombre ?>" placeholder="Nombre" autofocus/>
                </div>
                <div class="form-group">
                  <input type="text" name="tipo" disabled class="form-control" value="<?= $tipo ?>" placeholder="Tipo" autofocus/>
                </div>
                <div class="form-group">
                  <input type="number" step="any" name="precio" class="form-control" value="<?= $precio ?>" placeholder="Precio" autofocus/>
                </div>
                <div class="form-group">
                  <input type="number" name="cantidad" class="form-control" value="<?= $cantidad ?>" placeholder="Cantidad" autofocus/>
                </div>

                <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar">
            </form>
          </div>
          </div>
      </div>
</div>
</section>
  <script>
      var menu=document.getElementById("ventas");
      menu.className="active";
  </script>
  <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
      $("#buscar").keyup(function(){
        var texto=$(this).val();
        if(texto!==''){
          $.ajax({
            url:'../controllers/ventasController.php',
            method: 'post',
            data: {query: texto},
            success: function(response){
              $("#lista_productos").html(response);
            }
          });
        }else{
          $('#lista_productos').html('');
        }
      });
      $(document).on('click','a',function(){
        $('#buscar').val($(this).text());
        $('#lista_productos').html('');
      });
    });
  </script>
<?php include("footer.php"); ?>
