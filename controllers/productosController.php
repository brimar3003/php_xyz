<?php

  require "../models/productos.php";

  //Guardar producto haciendo uso de su clase modelo
  if(isset($_POST["guardar"])){
    $nombre=$_POST["nombre"];
    $tipo=$_POST["tipo"];
    $cantidad=$_POST["cantidad"];
    $cantidad_min=$_POST["cantidad_min"];
    $precio=$_POST["precio"];

    $respuesta=productos::insert($nombre, $tipo, $cantidad, $cantidad_min, $precio);

    header("Location: ../views/productos.php?agregado=true");
  }

  //Eliminar producto haciendo uso de su clase modelo
  if(isset($_GET["eliminar"])){
    $id=$_GET["eliminar"];

    productos::delete($id);

    header("Location: ../views/productos.php?eliminado=true");
  }

  //Modifica producto haciedo uso de su clase modelo
  if(isset($_POST["actualizar"])){
    $nombre=$_POST["nombre"];
    $tipo=$_POST["tipo"];
    $cantidad=$_POST["cantidad"];
    $cantidad_min=$_POST["cantidad_min"];
    $precio=$_POST["precio"];
    $id=$_POST["id"];

    productos::update($nombre, $tipo, $cantidad, $cantidad_min, $precio, $id);

    header("Location: ../views/productos.php?modificado=true");
  }

?>
