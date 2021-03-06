<?php
  require "../db/db.php";

  //Clase ventas
  class ventas{

    public function _construct(){

    }

    //Obtene la suma total de las ventas
    public static function getTotalVentas(){
      $total=0;
      try{
        $query="select sum(total) as total_ventas from ventas ";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        while($row = $sql->fetch()){
          $total=$row["total_ventas"];
        }

      }catch(Exception $ex){
      }
      return $total;
    }

    //Obtiene la lista de las ventas realizadas
    public static function getLista(){
      try{
        $query="select v.id, v.subtotal, v.iva, v.total, v.cantidad, p.nombre from ventas v, productos p where p.id=v.producto order by id desc";
        $sql=db::getCon()->prepare($query);
        $sql->execute();
        $lista=$sql->fetchAll();
      }catch(Exception $ex){

      }

      return $lista;
    }

    //Insert en la tabla de ventas
    public static function insert($subtotal, $iva, $total, $cantidad, $producto){
      try{
        $datos=[
            'subtotal'=>$subtotal,
            'iva'=>$iva,
            'total'=>$total,
            'cantidad'=>$cantidad,
            'producto'=>$producto
        ];

        $query="insert into ventas (fecha, subtotal, iva, total, cantidad, producto) values (now(), :subtotal, :iva, :total, :cantidad, :producto)";
        $sql=db::getCon()->prepare($query);
        $sql->execute($datos);

        return true;
      }catch(Exception $ex){
        return false;
      }
    }

    //Obtiene el stock de un producto
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

    //Actualiza el stock de un producto cuando se registra una venta valida
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

  }

?>
