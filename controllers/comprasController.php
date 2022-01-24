<?php

  if(isset($_POST["agregar"])){
    require "../models/productos.php";

    $nombre=$_POST["buscar"];
    $producto=productos::getByNombre($nombre);

    if($producto){
      header("Location: ../views/nuevaCompra.php?producto=".$producto["id"]);
    }else{
      header("Location: ../views/nuevaCompra.php");
    }

  }

  if(isset($_POST["query"])){
    require "../models/productos.php";

    $texto=$_POST["query"];
    $productos=productos::buscar($texto);

    foreach ($productos as $row) {
      echo "<a href='#' class='list-group-item list-group-item-action border-1' style='text-decoration:none;'>".$row["nombre"]."</a>";
    }
  }

  if(isset($_POST["query2"])){
    require "../models/productos.php";

    $texto=$_POST["query2"];
    $proveedores=productos::buscarProveedor($texto);

    foreach ($proveedores as $row) {
      echo "<p href='#' class='list-group-item list-group-item-action border-1' style='text-decoration:none;'>".$row["nombre"]."</p>";
    }
  }

  if(isset($_POST["guardar"])){
    require "../models/compras.php";

    //Valida si el id del producto es diferente de 0
    if($_POST["id"]!=0){
      $id=$_POST["id"];
      $cantidad=$_POST["cantidad"];
      $precio=$_POST["precio"];
      $subtotal=$cantidad*$precio;
      $iva=$subtotal*0.12;
      $total=$subtotal+$iva;

      //Obtener nuevo y antiguo stock para descontarlo de la tabla
      $stock_antiguo=compras::getStock($id);
      $stock_nuevo=$stock_antiguo+$cantidad;


      $prov=compras::getByNombre($_POST["buscarp"]);
      //Valida que hayan productos en stock caso contrario me dara error
      compras::insert($subtotal, $iva, $total, $cantidad, $id, $prov["id"]);
      compras::update($stock_nuevo, $id);

      header("Location: ../views/compras.php?compra=true");

    }else{
      header("Location: ../views/nuevaCompra.php");
    }
  }

?>
