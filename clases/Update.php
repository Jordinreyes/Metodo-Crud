<?php 

class Update
{
    private $id;
    private $title;
    private $description;
    private $publicationDate;
    private $publication;
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function id($id){
        $this->id = $id;
    }

    public function datos($title, $description, $publicationDate, $publication)
    {
        $this->title=$title;
        $this->description=$description;
        $this->publicationDate = $publicationDate;
        $this->publication = $publication;
    }

    public function update()
    {
        try{
            $stmt = $this->conexion->prepare("UPDATE posts SET
                title = ?,
                description = ?,
                publication_date = ?,
                publication = ?
                WHERE id = ?"
            );

            $stmt->bind_param("ssssi", $this->title, $this->description, $this->publicationDate, $this->publication, $this->id);

            if($stmt->execute()){
                return true;
            }else{
                throw new Exception("No se ha podido actualizar");
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}