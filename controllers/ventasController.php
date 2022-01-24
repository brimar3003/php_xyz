<?php

  //Obtiene los datos del input ingresado y los ubica en las cajas de texto
  if(isset($_POST["agregar"])){
    require "../models/productos.php";

    $nombre=$_POST["buscar"];
    $producto=productos::getByNombre($nombre);

    if($producto){
      header("Location: ../views/nuevaVenta.php?producto=".$producto["id"]);
    }else{
      header("Location: ../views/nuevaVenta.php");
    }

  }

  //Envia parametro de busqueda al modelo para que imprima en etiquetas a el resultaado de dicha consulta
  if(isset($_POST["query"])){
    require "../models/productos.php";

    $texto=$_POST["query"];
    $productos=productos::buscar($texto);

    foreach ($productos as $row) {
      echo "<a href='#' class='list-group-item list-group-item-action border-1' style='text-decoration:none;'>".$row["nombre"]."</a>";
    }
  }

  //Guarda la venta
  if(isset($_POST["guardar"])){
    require "../models/ventas.php";

    //Valida si el id del producto es diferente de 0
    if($_POST["id"]!=0){
      $id=$_POST["id"];
      $cantidad=$_POST["cantidad"];
      $precio=$_POST["precio"];
      $subtotal=$cantidad*$precio;
      $iva=$subtotal*0.12;
      $total=$subtotal+$iva;

      //Obtener nuevo y antiguo stock para descontarlo de la tabla
      $stock_antiguo=ventas::getStock($id);
      $stock_nuevo=$stock_antiguo-$cantidad;

      //Valida que hayan productos en stock caso contrario me dara error
      if($stock_antiguo<$cantidad){

          header("Location: ../views/nuevaVenta.php?error=true");
      }else{
          ventas::insert($subtotal, $iva, $total, $cantidad, $id);
          ventas::update($stock_nuevo, $id);

          header("Location: ../views/ventas.php?venta=true");
      }

    }else{
      header("Location: ../views/nuevaVenta.php");
    }
  }

?>
