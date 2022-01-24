<?php
  require "../db/db.php";

  class compras{

    public function _construct(){

    }

    public static function getLista(){
      try{
        $query="select c.id, c.subtotal, c.iva, c.total, c.cantidad, p.nombre, pr.nombre as proveedor from compras c, productos p, proveedores pr where p.id=c.producto and c.proveedor=pr.id order by id desc";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }

      return $lista;
    }

    public static function getStock($id){
      $stock=0;
      try{
        $query="select cantidad from productos where id=$id";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $cantidad=$sql->fetch();
        if($cantidad){
          $stock=$cantidad["cantidad"];
        }
      }catch(Exception $ex){

      }

      return $stock;
    }

    public static function insert($subtotal, $iva, $total, $cantidad, $producto, $proveedor){
      try{
        $datos=[
            'subtotal'=>$subtotal,
            'iva'=>$iva,
            'total'=>$total,
            'cantidad'=>$cantidad,
            'producto'=>$producto,
            'proveedor'=>$proveedor
        ];

        $query="insert into compras (fecha, subtotal, iva, total, cantidad, producto, proveedor) values (now(), :subtotal, :iva, :total, :cantidad, :producto, :proveedor)";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    public static function update($stock_nuevo, $id){
      try{
        $query="update productos set cantidad=$stock_nuevo where id=$id";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    public static function getByNombre($nombre){
      try{
        $query="select * from proveedores where nombre='$nombre'";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $proveedor=$sql->fetch();
      }catch(Exception $ex){

      }
      return $proveedor;
    }
  }

?>
