<?php
  require "../db/db.php";

  //Clase productos
  class productos{

    public function _construct(){

    }

    //Obtiene la lista de los productos si sus estado es activo
    public static function getLista(){
      try{
        $query="select * from productos where estado='A'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }

      return $lista;
    }

    //Devuelve una lista con todos los productos que contengan los caracteres que le son enviados
    public static function buscar($texto){
      try{
        $query="select * from productos where nombre like '%$texto%' and estado='A'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }
      return $lista;
    }

    //Obtinene el producto por su nombre
    public static function getByNombre($nombre){
      try{
        $query="select * from productos where nombre='$nombre'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $producto=$sql->fetch();
      }catch(Exception $ex){

      }
      return $producto;
    }

    //Obtiene un produco por su id
    public static function getById($id){
      try{
        $query="select * from productos where id='$id'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $producto=$sql->fetch();
      }catch(Exception $ex){

      }
      return $producto;
    }

    //Insert en la tabla de productos
    public static function insert($nombre, $tipo, $cantidad, $cantidad_min, $precio){
      try{
        $datos=[
            'nombre'=>$nombre,
            'tipo'=>$tipo,
            'cantidad'=>$cantidad,
            'cantidad_min'=>$cantidad_min,
            'precio'=>$precio
        ];

        $query="insert into productos (nombre, tipo, cantidad, cantidad_min, precio, estado) values (:nombre, :tipo, :cantidad, :cantidad_min, :precio, 'A')";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    //Update en la tabla de productos
    public static function update($nombre, $tipo, $cantidad, $cantidad_min, $precio, $id){
      try{
        $datos=[
            'nombre'=>$nombre,
            'tipo'=>$tipo,
            'cantidad'=>$cantidad,
            'cantidad_min'=>$cantidad_min,
            'precio'=>$precio,
            'id'=>$id
        ];

        $query="update productos set nombre=:nombre, tipo=:tipo, cantidad=:cantidad, cantidad_min=:cantidad_min, precio=:precio where id=:id";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    //Cambia el estado del producto a inactivo
    public static function delete($id){
      try{
        $query="update productos set estado='I' where id=$id";
        $sql=db::getCon()->prepare($query);
        $sql->execute();

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    public static function getProveedores(){
      try{
        $query="select * from proveedores where estado='A'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }

      return $lista;
    }

    public static function buscarProveedor($texto){
      try{
        $query="select * from proveedores where nombre like '%$texto%' and estado='A'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }
      return $lista;
    }

    public static function getByNombreP($nombre){
      try{
        $query="select * from proveedores where nombre='$nombre'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $proveedor=$sql->fetch();
      }catch(Exception $ex){

      }
      return $proveedor;
    }

    public static function getByIdP($id){
      try{
        $query="select * from proveedores where id='$id'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $proveedor=$sql->fetch();
      }catch(Exception $ex){

      }
      return $proveedor;
    }

  }

?>
