<?php
  require "../db/db.php";

  class proveedores{

    public function _construct(){

    }

    public static function getLista(){
      try{
        $query="select * from proveedores where estado='A'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }

      return $lista;
    }

    public static function getById($id){
      try{
        $query="select * from proveedores where id='$id'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $producto=$sql->fetch();
      }catch(Exception $ex){

      }
      return $producto;
    }

    public static function insert($nombre){
      try{
        $datos=[
            'nombre'=>$nombre
        ];

        $query="insert into proveedores (nombre, estado) values (:nombre, 'A')";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    public static function update($nombre, $id){
      try{
        $datos=[
            'nombre'=>$nombre,
            'id'=>$id
        ];

        $query="update proveedores set nombre=:nombre where id=:id";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    public static function delete($id){
      try{
        $query="update proveedores set estado='I' where id=$id";
        $sql=db::getCon()->prepare($query);
        $sql->execute();

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

  }

?>
