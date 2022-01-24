<?php

  require "../models/proveedores.php";

  //Guardar producto haciendo uso de su clase modelo
  if(isset($_POST["guardar"])){
    $nombre=$_POST["nombre"];

    $respuesta=proveedores::insert($nombre);

    header("Location: ../views/proveedores.php?agregado=true");
  }

  if(isset($_POST["actualizar"])){
    $nombre=$_POST["nombre"];
    $id=$_POST["id"];

    proveedores::update($nombre, $id);

    header("Location: ../views/proveedores.php?modificado=true");
  }

  if(isset($_GET["eliminar"])){
    $id=$_GET["eliminar"];

    proveedores::delete($id);

    header("Location: ../views/proveedores.php?eliminado=true");
  }

?>
