<?php include("header.php"); ?>

<?php
  require "../models/productos.php";

  $id=0;
  $idp=0;
  $nombre="";
  $tipo="";
  $cantidad="0";
  $precio="0.00";
  $proveedor="";

  if(isset($_GET["producto"])){
    $producto=productos::getById($_GET["producto"]);

    if($producto){
      $id=$producto["id"];
      $nombre=$producto["nombre"];
      $tipo=$producto["tipo"];
      $cantidad="0";
      $precio=0.0;
    }
  }

  if(isset($_GET["proveedor"])){
    $prov=productos::getByIdP($_GET["proveedor"]);

    if($prov){
      $idp=$prov["id"];
      $proveedor=$prov["nombre"];
    }
  }


?>

<section class="wrapper">
<div class="container p-4">
      <div class="row">
          <div class="col-md-12">
              <div class="card card-body p-3">
                <form class="form-inline p-3" action="../controllers/comprasController.php" method="POST">
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
            <form action="../controllers/comprasController.php" method="POST">
                <div class="form-group mb-5">
                    <input autocomplete="off" type="text" name="buscarp" id="buscarp" class="form-control" placeholder="Buscar proveedor..."/>
                    <div class="col-md-5" style="position: relative; margin-top:0px; margin-left:17px;">
                      <div class="list-group" id="lista_proveedores">

                      </div>
                    </div>
                </div>
                <div class="form-group"style="display:none;">
                    <input type="text" name="id" style="" class="form-control" value="<?= $id ?>" placeholder="Nombre" autofocus/>
                </div>
                <div class="form-group"style="display:none;">
                    <input type="text" name="idp" style="" class="form-control" value="<?= $idp ?>" placeholder="Nombre" autofocus/>
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
                <br/>
                <input type="submit" class="btn btn-success btn-block" name="guardar" value="Guardar">
            </form>
          </div>
          </div>

      </div>
</div>
</section>
  <script>
      var menu=document.getElementById("compras");
      menu.className="active";
  </script>
  <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
      $("#buscar").keyup(function(){
        var texto=$(this).val();
        if(texto!==''){
          $.ajax({
            url:'../controllers/comprasController.php',
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
  <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
      $("#buscarp").keyup(function(){
        var texto=$(this).val();
        if(texto!==''){
          $.ajax({
            url:'../controllers/comprasController.php',
            method: 'post',
            data: {query2: texto},
            success: function(response){
              $("#lista_proveedores").html(response);
            }
          });
        }else{
          $('#lista_proveedores').html('');
        }
      });
      $(document).on('click','p',function(){
        $('#buscarp').val($(this).text());
        $('#lista_proveedores').html('');
      });
    });
  </script>
<?php include("footer.php"); ?>
