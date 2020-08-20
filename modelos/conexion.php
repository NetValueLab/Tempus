<?php
    class Conectar {
        public static function conexion(){
            try {
                $conectar = new PDO("mysql:local=localhost;dbname=db_clients","root","",array(PDO::ATTR_PERSISTENT => true));
                $conectar->query("SET NAMES 'utf8'");
                return $conectar;
            } catch (Exception $e) {

                print "Erro na conexão: " . $e->getMessage() . "<br/>";
                die();  	 			
            }
        }       
    }
    //Valida se tem conexão com a base de dados
    /* if(Conectar::conexion()){
          
          echo "conectado";
          
    } else{
          
          echo "error en la conexion";
    } */
?>