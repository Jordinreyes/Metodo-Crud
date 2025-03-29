<?php 

class Delete
{
    private $id;
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    public function id($id){
        $this->id = $id;
    }

    public function delete(){
        try{
            $stmt = $this->conexion->prepare("DELETE FROM posts WHERE id = ?");
            $stmt->bind_param("i", $this->id);

            if($stmt->execute()){
                return true;
            }else{
                throw new Exception("No se ha podido hacer el insert");
            }
        }catch(Exception $e){
            return $e->GetMessage();
        }
    }
}