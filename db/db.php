<?php
  class db{

    private static $con;

    public function _construct(){

    }

    //Obtener la conexion con la base de datos
    public static function getCon(){
      try{
        self::$con=new PDO("mysql:host=localhost;dbname=actividad1","bri3003", "3003Joker");
      }catch(Exception $ex){

      }
      return self::$con;
    }

  }

?>
