<?php

class Select
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    public function get(){
        try{
            $sql = "SELECT * FROM posts";
            $resultado = $this->conexion->query($sql);
            $filas = $resultado->fetch_all(MYSQLI_ASSOC); 
            
            if(!empty($filas)){
                return $filas;
            }else{
                throw new Exception("No hay registro en la base de datos");
            }
        }catch(Exception $e){
            return $e->GetMessage();
        }
    }
}